<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\Service;

class ServiceIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search; 

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $services = Service::where('name','LIKE','%'.$this->search.'%')
                        ->orderBy('type_id')
                        ->paginate(10);

        return view('livewire.admin.service-index', compact('services'));
    }
}
