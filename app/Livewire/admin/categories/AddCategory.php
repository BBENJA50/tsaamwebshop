<?php

namespace App\Livewire\admin\categories;

use App\Models\Category;
use Livewire\Component;

class AddCategory extends Component
{
    public $name;

    /**
     * Functie om een nieuwe categorie op te slaan.
     */
    public function saveCategory()
    {
        // Valideer de invoer
        $this->validate([
            'name' => 'required', // De naam is verplicht
        ]);

        try {
            // Maak een nieuwe categorie aan
            Category::create([
                'name' => $this->name,
            ]);

            // Redirect naar de categorieën pagina na succesvolle creatie
            return $this->redirect('/admin/categorie', navigate: true);
        } catch (\Exception $e) {
            // Vang eventuele fouten op en dump deze voor debugging
            dd($e);
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        return view('livewire.admin.categories.add-category');
    }
}
