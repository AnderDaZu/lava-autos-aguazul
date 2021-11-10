<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\Mark;

class MarkIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search; 

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $marks = Mark::where('name','LIKE','%'.$this->search.'%')
                        ->latest('id')
                        ->paginate(10); 
        return view('livewire.admin.mark-index', compact('marks'));
    }
}
