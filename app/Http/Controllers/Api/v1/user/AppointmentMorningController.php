<?php

namespace App\Http\Controllers\Api\v1\user;

use App\Http\Controllers\Controller;
use App\Models\Admin\Amount;
use App\Models\Admin\Service;
use App\Models\Admin\Space;
use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentMorningController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:user.appointments.index')->only('index');
        $this->middleware('can:user.appointments.vehicles')->only('checkVehicles');
        $this->middleware('can:user.appointments.services')->only('listServices');
        $this->middleware('can:user.appointments.spaces')->only('checkSpaces');
        $this->middleware('can:user.appointments.employees')->only('checkEmployees');
        $this->middleware('can:user.appointments.store')->only('store');
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $appointments = Appointment::select('appointments.id', 'appointments.date', 'appointments.hour_start', 'appointments.hour_end', 'users.name', 'users.last_name', 'services.name as service', 'services.price', 'durations.duration', 'states.name as state', 'vehicles.plate', 'marks.name as mark', 'modelcars.name as model', 'tasks.stocktaking')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('durations', 'durations.id', '=', 'services.duration_id')
            ->join('states', 'states.id', '=', 'appointments.state_id')
            ->join('users', 'users.id', '=', 'appointments.employee_id')
            ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
            ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
            ->join('marks', 'marks.id', '=', 'modelcars.mark_id')
            ->leftjoin('tasks', 'tasks.appointment_id', '=', 'appointments.id')
            ->where('appointments.client_id', $user_id)
            ->latest('date')
            ->latest('hour_end')
            ->get();

        return response()->json([
            'success' => true,
            "citas" => $appointments
        ], 200);
    }
    
    public function checkVehicles()
    {
        $user_id = auth()->user()->id;
        $vehicles = Vehicle::where('client_id', $user_id)->get();
        $data = [];
        foreach ($vehicles as $vehicle) {
            $data[] = [
                'id' => $vehicle->id,
                'plate' => $vehicle->plate,
                'color' => $vehicle->color->name,
                'mark' => $vehicle->modelcar->mark->name,
                'model' => $vehicle->modelcar->name,
                'client' => $vehicle->client->name." ".$vehicle->client->last_name,
                'client_id' => $vehicle->client_id,
            ];
        }
        return response()->json([
            'success' => true,
            'cantidad' => count($vehicles), 
            'vehicles' => $data
        ], 200);
    }

    public function listServices(Vehicle $vehicle)
    {
        // $hour_now = date('H:i:s');
        $hour_now = date('H:i:s', strtotime('08:00:00'));
        // $available = date('H:i:s', strtotime('+10 minute', strtotime('23:44:00')));
        $available = date('H:i', strtotime('+10 minute', strtotime($hour_now)));

        // ********************************************************
        if ( $hour_now > '18:05:00' ) {
            return response()->json([
                'success' => false,
                'message' => "Para agendar citas, hasta mañana desde las 00:00"
            ], 200);
        }
        
        $services = Vehicle::select('services.id', 'services.name', 'services.price')
            ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
            ->join('types', 'types.id', '=', 'modelcars.type_id')
            ->join('services', 'services.type_id', '=', 'types.id')
            ->where('vehicles.id', $vehicle->id)
            ->get();

        $data = [
            'id' => $vehicle->id,
            'plate' => $vehicle->plate,
            'color' => $vehicle->color->name,
            'mark' => $vehicle->modelcar->mark->name,
            'model' => $vehicle->modelcar->name,
            'client' => $vehicle->client->name." ".$vehicle->client->last_name,
            'client_id' => $vehicle->client_id,
        ];

        return response()->json([
            'success' => true,
            'vehicle' => $data, 
            'service' => $services
        ], 200);
    }

    public function checkSpaces(Vehicle $vehicle, Service $service)
    {
        $amounts = Amount::where('active', true)->first();

        // $hour_now = date('H:i:s');
        $hour_now = date('H:i:s', strtotime('08:00:00'));
        // $available = date('H:i:s', strtotime('+10 minute', strtotime('23:44:00')));
        $available = date('H:i', strtotime('+10 minute', strtotime(date($hour_now))));

        if ( $hour_now > '18:05:00' ) {
            return response()->json([
                'success' => false,
                'message' => "Para agendar citas, hasta mañana desde las 00:00"
            ], 200);
        }

        // $appointmentsVehicle = Appointment::where('vehicle_id', $vehicle->id)
        // // ->where('date', date('Y-m-d'))
        // ->get();
        // return $appointmentsVehicle;

        // arreglo donde se agregan los espacios disponibles
        $spaces_available = [];
        $cont_spaces = 0;       

        // espacios para el servicio seleccionado
        $spaces = Space::select('id', 'start_hour', 'end_hour', 'group', 'times_taken', 'horario_id', 'duration_id')
            ->where('duration_id', $service->duration_id)
            ->where('start_hour', '>=', $available)
            ->where('horario_id', 1)
            ->get();

        // numero de rangos del servicio seleccionado
        $num_ranges = $service->duration->duration / 45;
        $ranges_available = 0;    

        // espacios base, son los que maracan los rangos de 45 en 45
        $spaces_base = Space::select('id', 'start_hour', 'end_hour', 'times_taken', 'horario_id', 'horario_id')
            ->where('duration_id', 1)
            ->where('horario_id', 1)
            ->where('start_hour', '>=', $available)
            ->get();

        foreach ($spaces as $space) {

            foreach ($spaces_base as $space_base) {

                if ( $space_base['start_hour'] >= $space['start_hour'] && $space_base['end_hour'] <= $space['end_hour'] && $space_base['times_taken'] < $amounts->num ) {
                    $ranges_available++;
                }
            }

            if ( $ranges_available == $num_ranges ) {
                // $spaces_available[$cont_spaces] = $space;
                $spaces_available[$cont_spaces] = [
                    'id' => $space['id'],
                    'start_hour' => date('H:i', strtotime($space['start_hour'])),
                    'end_hour' => date('H:i', strtotime($space['end_hour'])),
                    'group' => $space['group'],
                    'times_taken' => $space['times_taken'],
                    'horario_id' => $space['horario_id'],
                    'duration_id' => $space['duration_id'],
                ];
                $cont_spaces++;            
            }

            $ranges_available = 0;
  
        }

        $data_service = [
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->price,
        ];

        $data_vehicle = [
            'id' => $vehicle->id,
            'plate' => $vehicle->plate,
            'color' => $vehicle->color->name,
            'mark' => $vehicle->modelcar->mark->name,
            'model' => $vehicle->modelcar->name,
            'client' => $vehicle->client->name." ".$vehicle->client->last_name,
            'client_id' => $vehicle->client_id,
        ];

        return response()->json([
            'vehicle' => $data_vehicle,
            'service' => $data_service, 
            'amount' => count($spaces_available),
            'spaces' => $spaces_available
        ], 200);
    }

    public function checkEmployees(Vehicle $vehicle, Service $service, Space $space)
    {
        $today = date('Y-m-d');
        $today = date('Y-m-d', strtotime('2022-07-14'));
        // $hour_now = date('H:i:s');
        $hour_now = date('H:i:s', strtotime('08:00:00'));

        if ( $hour_now > '18:05:00' ) {
            return response()->json([
                'success' => false,
                'response' => "Para agendar citas, hasta mañana desde las 00:00"
            ], 200);
        }

        // trae horario del espacio y duracion del servicio
        $horario = $space['horario_id'];
        $serviceDuration = $service->duration->duration;

        // trae los empleados activos de acuerdo al horario del espacio seleccionado
        $employees = User::select('id', 'name', 'last_name')
            ->role('employee')
            ->where('state_id', 1)
            ->where('horario_id', $horario)
            ->get();

        // trae todas las citas agendadas en el día y horario seleccionado
        $appointments = Appointment::select('date', 'hour_start', 'hour_end', 'service_id', 'vehicle_id', 'employee_id', 'horario_id')
        ->where('horario_id', $horario)
        ->where('appointments.date', $today)
        ->get();

        // contador para citas que concuerdan con empleado y/o vehículo        
        $cont_aux = 0;

        // guarda los empleados que estan disponibles para el espacio seleccionado
        $available_employees = [];
        // contador auxiliar para empleados disponibles
        $ava_emp = 0;

        if ( count($appointments) > 0 ) {

            foreach ($employees as $employee) {

                for ($i=0; $i < count($appointments); $i++) { 

                    if ( ( $appointments[$i]['hour_start'] < $space['end_hour'] && $appointments[$i]['hour_end'] > $space['start_hour'] ) && ( $appointments[$i]['employee_id'] == $employee['id'] || $appointments[$i]['vehicle_id'] == $vehicle['id'] ) ) {
                        $cont_aux++;
                    }
                }

                if ( $cont_aux == 0 ) {
                    if ( !in_array($employee, $available_employees) ) {
                        $available_employees[$ava_emp] = $employee;
                        $ava_emp++;
                    }
                }
                $cont_aux = 0;
            }

        } else {

            foreach ($employees as $employee) {
                $available_employees[$ava_emp] = $employee;  
                $ava_emp++;  
            }
        }

        if ( count($available_employees) == 0 ) {
            return response()->json([
                'success' => false,
                'response' => "Debes seleccionar otro espacio, este espacio no cuenta con empleados disponibles o tu vehículo ya tiene asignada una cita dentro del rango de la cita que intentas agendar"
            ], 200);
        }

        $data_service = [
            'id' => $service->id,
            'name' => $service->name,
            'price' => $service->price,
        ];

        $data_vehicle = [
            'id' => $vehicle->id,
            'plate' => $vehicle->plate,
            'color' => $vehicle->color->name,
            'mark' => $vehicle->modelcar->mark->name,
            'model' => $vehicle->modelcar->name,
            'client' => $vehicle->client->name." ".$vehicle->client->last_name,
            'client_id' => $vehicle->client_id,
        ];

        return response()->json([
            'success' => true,
            'vehicle' => $data_vehicle, 
            'service' => $data_service, 
            'space' => $space, 
            'employees' => $available_employees
        ], 200);
        
    }

    public function store(Request $request)
    {
        $amounts = Amount::where('active', true)->first();

        $request->validate([
            'hour_start' => 'required',
            'hour_end' => 'required',
            'service_id' => 'required|exists:services,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'employee_id' => 'required|exists:users,id',
        ]);

        // $today = date('Y-m-d');
        $today = date('Y-m-d', strtotime('2022-07-14'));
        // $hour_now = date('H:i:s');
        $hour_now = date('H:i:s', strtotime('08:00:00'));
        $available = date('H:i:s', strtotime('+10 minute', strtotime($hour_now)));
        // $available = date('H:i:s', strtotime('+15 minute', strtotime("08:00:00")));
        // $available_date = date('Y-m-d H:i:s', strtotime($available));

        if ( $hour_now > '18:05:00' ) {
            return response()->json([
                'success' => false,
                'response' => "Para agendar citas, hasta mañana desde las 00:00"
            ], 200);
        }

        // trae los datos del espacio a ocupar por la cita
        $space = Space::select('id', 'start_hour', 'end_hour', 'group', 'horario_id', 'duration_id', 'times_taken')
        ->where([ [ 'spaces.start_hour', $request->hour_start ], [ 'spaces.end_hour', $request->hour_end ] ])
        ->first();

        $horario = $space['horario_id'];

        if ( $space['start_hour'] < $available ) {
            return response()->json([
                'success' => false,
                'response' => "Este espacio ya no esta disponible, elige otro"
            ], 200);      
        }

        $spaces_base = Space::where('horario_id', 1)
            ->where('start_hour', '>=', $space['start_hour'])
            ->where('end_hour', '<=', $space['end_hour'])
            ->where('duration_id', 1)
        ->get();

        $num_ranges = count($spaces_base);
        $count_ranges = 0;

        foreach ($spaces_base as $space_base) {

            if( $space_base['times_taken'] < $amounts->num ){
                $count_ranges++;
            }
        }

        if ( $count_ranges == $num_ranges ) {

            $appointments = Appointment::select('appointments.date', 'appointments.hour_start', 'appointments.hour_end', 'appointments.vehicle_id', 'appointments.employee_id', 'appointments.service_id')
                ->where('appointments.date', $today)
                ->where('appointments.horario_id', $horario)
                ->get();

            // return $appointments;
            if ( count($appointments) > 0 ) {
                foreach ($appointments as $appointment) {
                    if ( $appointment['hour_start'] < $space['end_hour'] && $appointment['hour_end'] > $space['start_hour'] && ( $appointment['employee_id'] == $request['employee_id'] || $appointment['vehicle_id'] == $request['vehicle_id'] ) ) {
                        return response()->json([
                            'success' => false,
                            'response' => "Debes seleccionar otro espacio, este espacio no cuenta con empleados disponibles o tu vehículo ya tiene asignada una cita dentro del rango de la cita que intentas agendar"
                        ], 200);
                    }
                }
            }

            $date = $today;
            
            $appointment = Appointment::create([
                'date' => $date,
                'hour_start' => $request['hour_start'],
                'hour_end' => $request['hour_end'],
                'horario_id' => 1,
                'service_id' => $request['service_id'],
                'vehicle_id' => $request['vehicle_id'],
                'employee_id' => $request['employee_id'],
                'state_id' => 2,
            ]);

            foreach ($spaces_base as $space_base) {
                $space_base->update(['times_taken' => $space_base['times_taken'] + 1]);
            }

            return response()->json([
                'success' => true,
                'response' => 'La cita se creo correctamente', 
                // 'appointment' => $appointment
            ], 201);
        
        }else {
            return response()->json([
                'success' => false,
                'response' => "Este espacio ya no esta disponible, elige otro"
            ], 200);
        }
    }
}
