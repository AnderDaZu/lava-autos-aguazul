<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Admin\Service;
use App\Models\Admin\Type;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Timer\Duration;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.services.index')->only('index');
        $this->middleware('can:admin.services.create')->only('create', 'store');
        $this->middleware('can:admin.services.edit')->only('edit', 'update');
        $this->middleware('can:admin.services.destroy')->only('destroy');
    }

    private $durations = [
        // '15' => '15 min',
        // '30' => '30 min',
        '45' => '45 min',
        // '60' => '60 min',
        // '75' => '75 min',
        '90' => '90 min',
        // '105' => '105 min',
        // '120' => '120 min',
        '135' => '135 min',
        // '150' => '150 min',
        // '165' => '165 min',
        '180' => '180 min',
        // '195' => '195 min',
        // '210' => '210 min',
        '225' => '225 min',
        // '240' => '240 min',
        // '255' => '255 min',
        '270' => '270 min',
    ];

    public function index()
    {
        $services = Service::orderBy('type_id')->get();
        return view('admin.services.index', compact('services'));
    }

   public function create()
    {
        $durations = $this->durations;
        $types = Type::pluck('name', 'id');

        return view('admin.services.create', compact('durations', 'types'));
    }

    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->only('name', 'price', 'duration', 'type_id'));
        $name =  $service->name;
        Alert::success("Servicio $name", 'Ha sido creado correctamente');
        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        $durations = $this->durations;
        $types = Type::pluck('name', 'id');
        return view('admin.services.edit', compact('service', 'durations', 'types'));
    }

    public function update(ServiceRequest $request, Service $service)
    {   
        $service->update($request->only('name', 'price', 'duration', 'type_id'));
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
