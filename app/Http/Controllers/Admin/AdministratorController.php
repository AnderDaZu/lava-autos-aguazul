<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdministratorController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.administrators.index')->only('index');
        $this->middleware('can:admin.administrators.create')->only('create', 'store');
        $this->middleware('can:admin.administrators.edit')->only('edit', 'update');
        $this->middleware('can:admin.administrators.destroy')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::role('admin')->latest('id')->get();
        // $users = User::doesntHave('roles')->get();
        
        return view('admin.administrators.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'birthdate' => "required|date|after:1960-12-31|before:2003-12-31",
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        
        $administrator = User::create($request->all());
        $administrator->roles()->sync(2);

        $name =  $administrator->name;
        // return $administrator;
        return redirect()->route('admin.administrators.index')->with('info', 'Administrador: '.$name.' se creo correctamente');
    }


    public function edit(User $administrator)
    {
        return view('admin.administrators.edit', compact('administrator'));
    }

    public function update(Request $request, User $administrator)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'birthdate' => "required|date|after:1960-12-31|before:2003-12-31",
            'email' => "required|email|unique:users,email,$administrator->id",
        ]);
        $administrator->update($request->all());
        $name = $administrator->name;
        // return redirect()->route('admin.administrators.index')->with('info','La información del administrador: '.$name.', se actualizo correctamente ');
        return redirect()->route('admin.administrators.edit', $administrator)->with('info','La información del administrador: '.$name.', se actualizo correctamente ');
    }

    public function destroy($id)
    {
        //
    }
}
