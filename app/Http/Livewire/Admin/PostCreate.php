<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Service;
use App\Models\Admin\Type;
use Livewire\Component;

class PostCreate extends Component
{
    public $types;
    public $services;

    public $selectedType = null;
    public $selectedService = null;

    public function mount()
    {
        $this->types = Type::pluck('name', 'id');
        $this->services = collect();
    }

    public function updatedSelectedType($type)
    {
        $this->services = Service::select('name', 'id')->where('type_id', $type)->latest('id')->get();
        $this->selectedService = null;
    }

    public function render()
    {
        return view('livewire.admin.post-create');
    }
}
