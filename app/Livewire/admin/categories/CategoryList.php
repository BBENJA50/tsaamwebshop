<?php

namespace App\Livewire\admin\categories;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public $all_categories; // Variabele om alle categorieën op te slaan

    /**
     * Functie die wordt uitgevoerd bij het mounten van de component.
     * Haalt alle categorieën op uit de database.
     */
    public function mount()
    {
        $this->all_categories = Category::all(); // Haal alle categorieën op
    }

    /**
     * Functie om een categorie te verwijderen.
     * @param int $id - Het ID van de te verwijderen categorie
     */
    public function delete($id)
    {
        try {
            // Verwijder de categorie met het opgegeven ID
            Category::where('id', $id)->delete();
            // Redirect naar de categorieën pagina na succesvolle verwijdering
            return $this->redirect('/admin/categorie', navigate: true);
        } catch (\Exception $th) {
            // Vang eventuele fouten op en dump deze voor debugging
            dd($th);
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        return view('livewire.admin.categories.category-list',
            [
                'categories' => Category::paginate(15), // Pagineer de categorieën
            ]);
    }
}
