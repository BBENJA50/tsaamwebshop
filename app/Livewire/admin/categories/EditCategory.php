<?php

namespace App\Livewire\admin\categories;

use App\Models\Category;
use Livewire\Component;

class EditCategory extends Component
{
    public $category_id; // Variabele om het ID van de te bewerken categorie op te slaan

    public Category $category; // Variabele om de categorie object op te slaan
    public $name; // Variabele om de naam van de categorie op te slaan

    /**
     * Functie die wordt uitgevoerd bij het mounten van de component.
     * Haalt de categorie gegevens op basis van het opgegeven ID.
     *
     * @param int $id - Het ID van de te bewerken categorie
     */
    public function mount($id)
    {
        $this->category_id = $id; // Sla het categorie ID op
        $this->category = Category::where('id', $id)->first(); // Haal de categorie op
        $this->name = $this->category->name; // Sla de naam van de categorie op
    }

    /**
     * Functie om de categorie bij te werken.
     */
    public function update()
    {
        // Validatie van de invoer
        $this->validate([
            'name' => 'required',
        ]);

        // Bewerk de categoriegegevens
        try {
            Category::where('id', $this->category_id)->update([
                'name' => $this->name
            ]);
            // Redirect naar de categorieën pagina na succesvolle update
            $this->redirect('/admin/categorie', navigate: true);
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
        return view('livewire.admin.categories.edit-category', ['category' => Category::find(request('id'))]);
    }
}
