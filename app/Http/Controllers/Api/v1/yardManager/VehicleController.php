<?php

namespace App\Http\Controllers\Api\v1\yardManager;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\YardVehicleResource;
use App\Models\Api\v1\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:yard.vehicles.index')->only('index');
        $this->middleware('can:yard.vehicles.create')->only('store');
        $this->middleware('can:yard.vehicles.edit')->only('update');

    }

    public function index()
    {
        $vehicles = Vehicle::where('client_id', '=', null)->get();
        return YardVehicleResource::collection($vehicles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate' => 'required|max:6',
            'color_id' => 'required|exists:colors,id',
            'modelcar_id' => 'required|exists:modelcars,id'
        ]);

        $vehicle = Vehicle::create($request->only('plate','color_id','modelcar_id'));

        return response()->json(['message'=>'Vehículo creado correctamente'], 201);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'plate' => 'required|max:6',
            'color_id' => 'required|exists:colors,id',
            'modelcar_id' => 'required|exists:modelcars,id'
        ]);
        $vehicle->update($request->only('plate', 'color_id', 'modelcar_id'));
        
        return response()->json(['message'=>'Vehículo actualizado correctamente'], 201);
    }

}
