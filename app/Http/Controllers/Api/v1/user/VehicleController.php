<?php

namespace App\Http\Controllers\Api\v1\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\VehicleResource;
use App\Models\Admin\Color;
use App\Models\Admin\Modelcar;
use App\Models\Api\v1\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:user.vehicles.index')->only('index', 'show');
        $this->middleware('can:user.vehicles.create')->only('store');
        $this->middleware('can:user.vehicles.edit')->only('update');

    }

    public function index()
    {
        $id = auth()->user()->id;
        $vehicles = Vehicle::where('client_id', $id)->get();
        return response()->json([
            'success' => true,
            'vehicles' => VehicleResource::collection($vehicles)
        ]);
    }

    public function dataHelp(){

        $colors = Color::all();
        $models = Modelcar::all();
        $data_model = [];
        $data_color = [];

        foreach ($models as $model) {
            $data_model[] = [
                'id' => $model->id,
                'model' => $model->name." - ".$model->mark->name
            ];
        }

        foreach ($colors as $color) {
            $data_color[] = [
                'id' => $color->id,
                'color' => $color->name,
            ];
        }

        return response()->json([
            'success' => true,
            'colors' => $data_color,
            'models' => $data_model
        ]);
    }

    public function store(Request $request)
    { 
        $request->validate([
            'plate' => 'required|max:6',
            'color_id' => 'required|exists:colors,id',
            'modelcar_id' => 'required|exists:modelcars,id'
        ]);

        $vehicle = Vehicle::create($request->only('plate','color_id','modelcar_id','client_id'));

        return response()->json([
            'success' => true,
            'message'=>'Vehículo creado correctamente'
        ], 201);
    }

    public function show(Vehicle $vehicles_user)
    {   
        return response()->json(["vehicle" => $vehicles_user], 200);
    }

    public function update(Request $request, Vehicle $vehicles_user)
    {
        $request->validate([
            'plate' => 'required|max:8',
            'color_id' => 'required|exists:colors,id',
            'modelcar_id' => 'required|exists:modelcars,id'
        ]);

        $vehicles_user->update($request->only('plate', 'color_id', 'modelcar_id'));

        return response()->json([
            'success' => true,
            'message'=>'Vehículo actualizado correctamente'
        ], 200);

    }

}
