<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api\v1\Task;
use App\Models\Api\v1\UnscheduledTask;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ResultEmployeeController extends Controller
{
    protected $paginationTheme = 'bootstrap';

    public function index()
    {
        $employees = User::role('employee')->paginate(15);
        
        $employeesNS = User::groupBy('user_name', 'name', 'last_name', 'users.id')
        ->selectRaw('count(tasks.id) as total, user_name, name, last_name, users.id')
        ->join('appointments', 'appointments.employee_id', '=', 'users.id')
        ->join('tasks', 'tasks.appointment_id', '=', 'appointments.id')
        ->orderBy('total', 'desc')
        ->get();
        
        $employeesS = User::groupBy('user_name', 'name', 'last_name', 'users.id')
        ->selectRaw('count(unscheduled_tasks.id) as total, user_name, name, last_name, users.id')
        ->join('unscheduled_tasks', 'unscheduled_tasks.employee_id', '=', 'users.id')
        ->orderBy('total', 'desc')
        ->get();

        $employeesActive = User::role('employee')
        ->where('state_id', 1)
        ->count();

        $employeesMorning = User::role('employee')
        ->where('state_id', 1)
        ->where('horario_id', 1)
        ->count();

        $employeesEvening = User::role('employee')
        ->where('state_id', 1)
        ->where('horario_id', 2)
        ->count();

        $total = array();

        foreach ($employeesNS as $employee) {
            $total[$employee['id']] = [
                'total' => $employee['total']
            ];
        }

        foreach ($employeesS as $employee) {
            if ( isset($total[$employee['id']]) ) {
                $total[$employee['id']] = [
                    'total' => $total[$employee['id']]['total'] + $employee['total']
                ];
            }else{
                $total[$employee['id']] = [
                    'total' => $employee['total']
                ];
            }
        }

        return view('admin.result_employees.index', compact('employees', 'total', 'employeesActive', 'employeesMorning', 'employeesEvening'));
    }

    public function show(User $employee)
    {
        $day_cstm =  date('Y-m-d', strtotime('-7 day'));
        $month_cstm = date('Y-m-d', strtotime('-1 month'));

        // tasksS -> tasks scheduled
        $tasks = Task::select('tasks.id', 'tasks.finished as date', 's.name as service', 'v.plate as plate', 't.name as type')
            ->join('appointments as a', 'a.id', '=', 'tasks.appointment_id')
            ->join('services as s', 's.id', '=', 'a.service_id')
            ->join('vehicles as v', 'v.id', '=', 'a.vehicle_id')
            ->join('modelcars as m', 'm.id', '=', 'v.modelcar_id')
            ->join('types as t', 't.id', '=', 'm.type_id')
            ->where('a.employee_id', $employee->id)
        ->get();

        // total tasks
        $tasksT = Task::join('appointments as a', 'a.id', 'tasks.appointment_id')
            ->join('users as u', 'u.id', 'a.employee_id')
            ->where('u.id', $employee->id)
        ->count();
        
        // total tasks last month
        $tasksMonth = Task::join('appointments as a', 'a.id', 'tasks.appointment_id')
            ->join('users as u', 'u.id', 'a.employee_id')
            ->where('u.id', $employee->id)
            ->where('tasks.started', '>=', $month_cstm)
        ->count();
        
        // total tasks last week
        $tasksDays = Task::join('appointments as a', 'a.id', 'tasks.appointment_id')
            ->join('users as u', 'u.id', 'a.employee_id')
            ->where('u.id', $employee->id)
            ->where('tasks.started', '>=', $day_cstm)
        ->count();
        
        // tasksNS -> tasks unscheduled
        $tasksNS = UnscheduledTask::select('unscheduled_tasks.id', 'unscheduled_tasks.finished as date', 's.name as service', 'unscheduled_tasks.plate as plate', 't.name as type')
            ->join('services as s', 's.id', '=', 'unscheduled_tasks.servicio_id')
            ->join('types as t', 't.id', '=', 'unscheduled_tasks.type_id')
            ->where('employee_id', $employee->id)
        ->get();
        
        // total unscheduled tasks
        $UTasksT = UnscheduledTask::where('unscheduled_tasks.employee_id', $employee->id)
        ->count();
        
        // total unscheduled tasks last month
        $UTasksMonth = UnscheduledTask::where('unscheduled_tasks.employee_id', $employee->id)
            ->where('unscheduled_tasks.finished', '>=', $month_cstm)
        ->count();
        // total unscheduled tasks last week
        $UTasksDays = UnscheduledTask::where('unscheduled_tasks.employee_id', $employee->id)
            ->where('unscheduled_tasks.finished', '>=', $day_cstm)
        ->count();

        $totalServicesDay = $UTasksDays + $tasksDays;
        $totalServicesMonth = $UTasksMonth + $tasksMonth;

        $total = count($tasks->merge($tasksNS));
        $tasksS = $this->paginate($tasks->merge($tasksNS), 15, null, [], $employee);
        
        return view('admin.result_employees.show', compact('tasksS', 'employee', 'total', 'totalServicesDay', 'totalServicesMonth'));
    }

    public function paginate($items, $perPage = 2, $page = null, $options = [], User $employee)
    {
        $path = "/admin/result/employees/".$employee->user_name;
        $options['path'] = $path;
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options,);
    }
}
