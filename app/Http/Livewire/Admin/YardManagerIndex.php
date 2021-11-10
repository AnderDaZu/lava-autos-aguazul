<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class YardManagerIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $yardManagers = User::role('yard_manager')
            ->where('name','LIKE','%'.$this->search.'%')
            ->latest('id')
            ->paginate(10);

        return view('livewire.admin.yard-manager-index', compact('yardManagers'));
    }
} 
