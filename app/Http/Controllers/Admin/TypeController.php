<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Type;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.types.index')->only('index');
        $this->middleware('can:admin.types.create')->only('create', 'store');
        $this->middleware('can:admin.types.edit')->only('edit', 'update');
        $this->middleware('can:admin.types.destroy')->only('destroy');
    }

    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:types'
        ]);
        $type = Type::create($request->only('name'));
        $name =  $type->name;
        Alert::success("Tipo vehículo $name", 'Ha sido creado correctamente');
        return redirect()->route('admin.types.index');
    }

    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => "required|unique:types,name,$type->id"
        ]);
        $type->update($request->only('name'));
        $name =  $type->name;
        toast("Tipo vehículo $name, ha sido actualizado correctamente",'success');
        return redirect()->route('admin.types.edit', compact('type'));
    }

    public function destroy(Type $type)
    {
        $name =  $type->name;
        $type->delete();
        Alert::info("Tipo vehículo $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.types.index');
    }
}
