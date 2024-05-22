<?php

namespace App\Livewire\children;

use App\Models\Child;
use Livewire\Component;

class ChildList extends Component
{
    public $all_children;
    public $is_active;

    public function mount()
    {
        $this->all_children = Child::withTrashed()->get();
        $this->is_active = 1;
    }

    public function delete($id)
    {
        try {
            //set is_active to 0
            Child::where('id', $id)->update(['is_active' => 0]);
            //delete user
            Child::where('id', $id)->delete();;

            return $this->redirect('/kinderen', navigate: true);
    } catch (\Exception $th) {
            dd($th);
        }
    }

    public function restore($id)
    {
        try {
            Child::where('id', $id)->restore();
            //set is_active to 1
            Child::where('id', $id)->update(['is_active' => 1]);
            return $this->redirect('/kinderen', navigate: true);
        } catch (\Exception $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.children.child-list',
            [
                'children' => Child::withTrashed()->paginate(15),
            ]);
    }
}
