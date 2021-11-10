<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UserRequest;

class YardManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.yardManagers.index')->only('index');
        $this->middleware('can:admin.yardManagers.create')->only('create', 'store');
        $this->middleware('can:admin.yardManagers.edit')->only('edit', 'update');
        $this->middleware('can:admin.yardManagers.destroy')->only('destroy');
    }

    public function index()
    {
        $yardManagers = User::role('yard_manager')->latest('id')->get();
        return view('admin.yardManagers.index', compact('yardManagers'));
    }

    public function create()
    {
        return view('admin.yardManagers.create');
    }

    public function store(UserRequest $request)
    {

        $password = bcrypt($request['password']);
        $request['password'] = $password;

        $yard_user = User::create($request->only('user_name','name','last_name','birthdate','identification','phone','email','password','state_id','user_id'));
        $yard_user->roles()->attach(3);
        $name = $yard_user->name;

        Alert::success("Jefe de patio $name", 'Ha sido creado correctamente');

        return redirect()->route('admin.yardManagers.index');
    }

    public function edit(User $yardManager)
    {   
        $status = $yardManager->status;
        return view('admin.yardManagers.edit', compact('yardManager', 'status'));
    }

    public function update(Request $request, User $yardManager)
    {
        $year = date("Y", strtotime(now('Y')."- 15 years"));
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'birthdate' => "required|date|after:1960-12-31|before:$year-12-31",
            'identification' => "required|min:7|unique:users,identification,$yardManager->id",
            'phone' => 'required|min:10|max:10',
            'email' => "required|email|unique:users,email,$yardManager->id",
            'state_id' => 'required|integer|exists:states,id'
        ]);
        
        $yardManager->update($request->only('name', 'last_name', 'birthdate', 'identification', 'phone', 'email', 'state_id'));
        $name = $yardManager->name;

        toast("Jefe de patio $name, ha sido actualizado correctamente",'success');

        return redirect()->route('admin.yardManagers.edit', compact('yardManager'));
    }

    public function destroy(User $yardManager)
    {
        $name = $yardManager->name;
        $yardManager->delete();
        Alert::info("Jefe de patio $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.yardManagers.index');
    }
} 
