<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Type;
use App\Models\Admin\Mark;
use App\Models\Admin\Modelcar;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ModelcarController extends Controller
{
    public function index()
    {
        return view('admin.modelcars.index');
    }

    public function create()
    {
        $marks =  Mark::pluck('name','id');
        $types = Type::pluck('name','id');
        return view('admin.modelcars.create', compact('marks', 'types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:modelcars',
            'mark_id' => 'required|integer',
            'type_id' => 'required|integer'
        ]);
        $modelcar =  Modelcar::create($request->only('name','mark_id','type_id'));
        $name = $modelcar->name;
        Alert::success("Línea vehículo $name", 'Ha sido creada correctamente');
        return redirect()->route('admin.modelcars.index');
    }

    public function edit(Modelcar $modelcar)
    {
        $marks =  Mark::pluck('name','id');
        $types = Type::pluck('name','id');
        // return $marks.$types.$linecar;
        return view('admin.modelcars.edit', compact('modelcar', 'marks', 'types'));

    }

    public function update(Request $request, Modelcar $modelcar)
    {
        $request->validate([
            'name' => "required|unique:modelcars,name,$modelcar->id",
            'mark_id' => 'required|integer',
            'type_id' => 'required|integer'
        ]);
        $modelcar->update($request->only('name','mark_id','type_id'));

        $name =  $modelcar->name;
        toast("Línea vehículo $name, ha sido actualizada correctamente",'success');

        return redirect()->route('admin.modelcars.edit', compact('modelcar'));

    }

    public function destroy(Modelcar $modelcar)
    {
        $name =  $modelcar->name;
        $modelcar->delete();
        Alert::info("Línea de vehículo $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.modelcars.index');
    } 
}
