<?php

namespace App\Livewire\admin\products;

use App\Models\Category;
use App\Models\Product;
use App\Models\Studiekeuze;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductList extends Component
{
    use WithPagination; // Gebruik paginering

    public $child; // Kind model
    public $category_id; // Geselecteerde categorie ID
    public $sortField = 'name'; // Veld om op te sorteren
    public $sortDirection = 'asc'; // Sorteerrichting
    public $search = ''; // Zoekterm

    /**
     * Sorteer producten op basis van het opgegeven veld.
     *
     * @param string $field
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /**
     * Verwijder een product op basis van het ID.
     *
     * @param int $id
     */
    public function delete($id)
    {
        try {
            Product::where('id', $id)->delete();
            return redirect('/admin/producten');
        } catch (Exception $th) {
            dd($th);
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        try {
            $query = Product::query();

            // Zoek op naam of beschrijving
            if ($this->search) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            }

            // Sorteer op het geselecteerde veld en richting
            $query->orderBy($this->sortField, $this->sortDirection);

            // Controleer of de gebruiker een admin rol heeft
            if (auth()->user()->hasRole('admin')) {
                $products = $query->paginate(15); // Pagineer de producten
                $categories = Category::whereHas('products')->get(); // Haal categorieën op die producten hebben

                return view('livewire.admin.products.product-list', [
                    'studiekeuzes' => Studiekeuze::all(), // Haal alle studiekeuzes op
                    'products' => $products, // Haal de producten op
                    'categories' => $categories, // Haal de categorieën op
                ]);
            }
        } catch (Exception $e) {
            logger()->error('Error in ProductList component: ' . $e->getMessage());
            session()->flash('error', 'Er is een fout opgetreden. Probeer het opnieuw.');
            return redirect('/producten');
        }
    }
}
