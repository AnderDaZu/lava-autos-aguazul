<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Modelcar;
use Livewire\Component;
use Livewire\WithPagination;

class ModelcarIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search; 

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {        
        $modelcars = Modelcar::where('name','LIKE','%'.$this->search.'%')
                        ->latest('id')
                        ->paginate(10);
        
        return view('livewire.admin.modelcar-index', compact('modelcars')); 
    }
}
