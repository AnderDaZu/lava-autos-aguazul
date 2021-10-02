<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

   public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:services',
            'price' => 'required|numeric|min:1000'
        ]);
        $service = Service::create($request->only('name', 'price'));
        $name =  $service->name;
        Alert::success("Servicio $name", 'Ha sido creado correctamente');
        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => "required|unique:services,name,$service->id",
            'price' => 'required|numeric|min:1000'
        ]);
        $service->update($request->only('name', 'price'));
        $name = $service->name;
        toast("Servicio $name, ha sido actualizado correctamente",'success');
        return redirect()->route('admin.services.edit', compact('service'));
    }

    public function destroy(Service $service)
    {
        $name = $service->name;
        $service->delete();
        Alert::info("Servicio $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.services.index');
    }
}
