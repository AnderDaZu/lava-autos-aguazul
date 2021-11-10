<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UserIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    { 
        $users = User::role('user')
                        ->where('name','LIKE','%'.$this->search.'%')
                        ->latest('id')
                        ->paginate(10);

        return view('livewire.admin.user-index', compact('users'));
    }
}
