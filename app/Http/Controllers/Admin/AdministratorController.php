<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UserRequest;


class AdministratorController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.administrators.index')->only('index');
        $this->middleware('can:admin.administrators.create')->only('create', 'store');
        $this->middleware('can:admin.administrators.edit')->only('edit', 'update');
        $this->middleware('can:admin.administrators.destroy')->only('destroy');
    }

    public function index()
    {

        // $users = User::role('admin')->latest('id')->get();
        // $users = User::doesntHave('roles')->get();

        return view('admin.administrators.index');
    }

    public function create()
    {
        $status = [1,2];
        return view('admin.administrators.create', compact('status'));
    }

    public function store(UserRequest $request)
    {

        $password = bcrypt($request['password']);
        $request['password'] = $password;
        
        $administrator = User::create($request->only('user_name','name','last_name','birthdate','identification','phone','email','password','status','user_id'));
        
        $administrator->roles()->sync(2);
        $name =  $administrator->name;

        Alert::success("Administrador $name", 'Ha sido creado correctamente');

        return redirect()->route('admin.administrators.index');
    }

    public function edit(User $administrator)
    {
        $status = $administrator->status;
        return view('admin.administrators.edit', compact('administrator', 'status'));
    }

    public function update(Request $request, User $administrator)
    {
        
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'birthdate' => "required|date|after:1960-12-31|before:2003-12-31",
            'identification' => "required|min:7|unique:users,identification,$administrator->id",
            'phone' => 'required|min:10|max:10',
            'email' => "required|email|unique:users,email,$administrator->id",
            'status' => 'required|integer|min:1|max:2'
        ]);

        // $request['password'] = $administrator->password;
        // $request['user_id'] = $administrator->user_id;

        $administrator->update($request->only('name','last_name','birthdate','identification','phone','email','status'));
        $name = $administrator->name;

        toast("Administrador $name, ha sido actualizado correctamente",'success');
    
        return redirect()->route('admin.administrators.edit', $administrator);
    }

    public function destroy(User $administrator)
    {
        $name =  $administrator->name;
        $administrator->delete();
        Alert::info("Administrador $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.administrators.index');
    }
}
