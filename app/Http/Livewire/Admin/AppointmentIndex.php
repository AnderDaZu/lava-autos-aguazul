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
        $appointments = Appointment::select('appointments.id', 'appointments.date', 'appointments.hour_start', 'appointments.hour_end', 'users.name', 'users.last_name', 'services.name as service', 'durations.duration', 'states.name as state')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('durations', 'durations.id', '=', 'services.duration_id')
            ->join('states', 'states.id', '=', 'appointments.state_id')
            ->join('users', 'users.id', '=', 'appointments.employee_id')
            ->latest('date')
            ->latest('hour_start')
            ->where('appointments.date','LIKE','%'.$this->search.'%')
            ->orWhere('users.name','LIKE','%'.$this->search.'%')
            ->paginate(15);
        // return view('livewire.admin.appointment-index', compact('appointments'));
        // $appointments = Appointment::all();
        return view('livewire.admin.appointment-index', compact('appointments')); 
    }
}
