<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Admin\Duration;
use App\Models\Admin\Service;
use App\Models\Admin\Type;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.services.index')->only('index');
        $this->middleware('can:admin.services.create')->only('create', 'store');
        $this->middleware('can:admin.services.edit')->only('edit', 'update');
        $this->middleware('can:admin.services.destroy')->only('destroy');
    }

    public function index() 
    {
        $services = Service::orderBy('type_id')->get();
        return view('admin.services.index', compact('services'));
    }

   public function create()
    {
        $durations = Duration::pluck('duration', 'id');
        $types = Type::pluck('name', 'id');

        return view('admin.services.create', compact('durations', 'types'));
    }

    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->only('name', 'price', 'duration_id', 'type_id'));
        $name =  $service->name;
        Alert::success("Servicio $name", 'Ha sido creado correctamente');
        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        $durations = Duration::pluck('duration', 'id');
        $types = Type::pluck('name', 'id');
        return view('admin.services.edit', compact('service', 'durations', 'types'));
    }

    public function update(ServiceRequest $request, Service $service)
    {   
        // return $request;
        $service->update($request->only('name', 'price', 'duration_id', 'type_id'));
        $name = $service->name;
        toast("Servicio $name, ha sido actualizado correctamente",'success');
        return redirect()->route('admin.services.index');
    }

    public function destroy(Service $service)
    {
        $name = $service->name;
        $service->delete();
        Alert::info("Servicio $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.services.index');
    }

}
