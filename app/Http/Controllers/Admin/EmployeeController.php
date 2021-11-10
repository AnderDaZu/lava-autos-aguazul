<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UserRequest;
use App\Models\Admin\Horario;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.employees.index')->only('index');
        $this->middleware('can:admin.employees.create')->only('create', 'store');
        $this->middleware('can:admin.employees.edit')->only('edit', 'update');
        $this->middleware('can:admin.employees.destroy')->only('destroy');
    }

    public function index()
    {
        $employees = User::role('employee')->latest('id')->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(UserRequest $request)
    {

        $password = bcrypt($request['password']);
        $request['password'] = $password;
        
        $employee = User::create($request->only('user_name','name','last_name','birthdate','identification','phone','email','password','state_id','user_id'));
        $employee->roles()->sync(4);
        $name =  $employee->name;

        Alert::success("Empleado $name", 'Ha sido creado correctamente');

        return redirect()->route('admin.employees.index');

    }

    public function edit(User $employee)
    {
        // $start = $employee->horario->start_hour;
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        $year = date("Y", strtotime(now('Y')."- 15 years"));
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'birthdate' => "required|date|after:1960-12-31|before:$year-12-31",
            'identification' => "required|min:7|unique:users,identification,$employee->id",
            'phone' => 'required|min:10|max:10',
            'email' => "required|email|unique:users,email,$employee->id",
            'state_id' => 'required|exists:states,id',
        ]);

        $employee->update($request->only('name','last_name','birthdate','identification','phone','email','state_id'));

        $name = $employee->name;

        toast("Empleado $name, ha sido actualizado correctamente",'success');

        return redirect()->route('admin.employees.index');
    }

    public function destroy(User $employee)
    {
        
        $name =  $employee->name;
        $employee->delete();
        Alert::info("Empleado $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.employees.index');
    }
}
