<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Api\v1\Appointment;

class AppointmentIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    } 

    public function render()
    {
        $appointments = Appointment::select('appointments.id', 'appointments.date', 'appointments.hour', 'users.name', 'users.last_name', 'services.name as service', 'services.duration', 'states.name as state', 'appointments.agenda_id')
            ->join('agendas', 'agendas.id', '=', 'agenda_id')
            ->join('users', 'users.id', '=', 'employee_id')
            ->join('services', 'services.id', '=', 'service_id')
            ->join('states', 'states.id', '=', 'appointments.state_id')
            ->latest('date')
            ->latest('hour')
            ->where('appointments.date','LIKE','%'.$this->search.'%')
            ->orWhere('users.name','LIKE','%'.$this->search.'%')
            ->paginate(15);
        return view('livewire.admin.appointment-index', compact('appointments'));
    }
}
