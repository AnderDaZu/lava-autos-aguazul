<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class EmployeeIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $employees = User::role('employee')
            ->where('name','LIKE','%'.$this->search.'%')
            ->latest('id')
            ->paginate(10);

        return view('livewire.admin.employee-index', compact('employees'));
    }
} 
