<?php

namespace App\Http\Controllers\Api\v1\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\AppointmentResource;
use App\Models\Admin\Agenda;
use App\Models\Admin\Service;
use App\Models\Api\v1\Appointment;
use App\Models\Api\v1\Vehicle;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user.appointments.index')->only('index', 'show');
        $this->middleware('can:user.appointments.create')->only('store');
        $this->middleware('can:user.appointments.edit')->only('update');

    }

    public function index()
    {
        $appointments = Appointment::select('date', 'hour', 'agendas.start_date', 'agendas.end_date', 'horarios.start_hour', 'horarios.end_hour', 'users.name', 'users.last_name', 'services.duration')
            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
            ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
            ->join('users', 'users.id', '=', 'agendas.employee_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->where('appointments.client_id', '=', auth()->user()->id)
            ->latest('date')
            ->latest('hour')
            ->get();

        // $employee = Agenda::select('users.id')
        //     ->join('users', 'users.id', '=', 'agendas.employee_id')
        //     ->where('agendas.id', '=', 4)
        //     ->get();
        // $emploeyee_id = $employee[0]['id'];

        // $date_today = date('Y-m-d');

        // $employee_appointments = Appointment::select('date', 'hour', 'appointments.id', 'agendas.start_date', 'agendas.end_date', 'horarios.start_hour', 'horarios.end_hour', 'users.name', 'users.last_name', 'services.duration', 'states.name as service')
        //     ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
        //     ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
        //     ->join('users', 'users.id', '=', 'agendas.employee_id')
        //     ->join('services', 'services.id', '=', 'appointments.service_id')
        //     ->join('states', 'states.id', '=', 'appointments.state_id')
        //     ->where([['users.id', '=', $emploeyee_id], ['appointments.date', '>=', $date_today], ['states.name', '=', 'Activo'], ['appointments.client_id', '!=', null]])
        //     ->get();

        return response()->json(['citas' => $appointments], 200);

    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'hour' => 'required',
            'agenda_id' => 'required|exists:agendas,id',
            'service_id' => 'required|exists:services,id',
            'vehicle_id' => 'required|exists:vehicles,id'
        ]);
        $request['state_id'] = 1;

        // traer el empleado que tiene asignado la agenda con id agenda_id
        $employee = Agenda::select('users.id')
            ->join('users', 'users.id', '=', 'agendas.employee_id')
            ->where('agendas.id', '=', $request['agenda_id'])
            ->get();
        $emploeyee_id = $employee[0]['id'];

        // traer todas las citas del empleado
        $date_today = date('Y-m-d');
        $employee_appointments = Appointment::select('date', 'hour', 'appointments.id', 'agendas.start_date', 'agendas.end_date', 'horarios.start_hour', 'horarios.end_hour', 'users.name', 'users.last_name', 'services.duration', 'states.name as service')
            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
            ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
            ->join('users', 'users.id', '=', 'agendas.employee_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('states', 'states.id', '=', 'appointments.state_id')
            ->where([['users.id', '=', $emploeyee_id], ['appointments.date', '>=', $date_today], ['states.name', '=', 'Activo']])
            ->get();

        // calcula la dururación del servicio elegido
        $duration = Vehicle::select('services.duration')
            ->join('modelcars', 'modelcars.id', '=', 'vehicles.modelcar_id')
            ->join('types', 'types.id', '=', 'modelcars.type_id')
            ->join('services', 'services.type_id', '=', 'types.id')
            ->where([['vehicles.id', '=', $request['vehicle_id']], ['services.id', '=', $request['service_id']]])
            ->get();
        $duration_service = $duration[0]['duration'];
        $request_hour_end = date('H:i:s', strtotime($request['hour']."+ $duration_service minute"));

        // Trae la agenda seleccionada
        $agenda = Agenda::select('agendas.start_date', 'agendas.end_date', 'horarios.start_hour', 'horarios.end_hour')
            ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
            ->where('agendas.id', '=', $request['agenda_id'])
            ->get();
        
        // Trae las citas ya agendadas
        $appointments = Appointment::select('appointments.agenda_id', 'appointments.date', 'appointments.hour', 'agendas.start_date', 'agendas.end_date', 'horarios.start_hour', 'horarios.end_hour', 'services.duration')
            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
            ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            // ->where('appointments.date', '>=', $request['date'])
            ->where([['appointments.date', '>=', $request['date']], ['appointments.client_id', '!=', null]])
            ->orderBy('hour')
            ->get();
        // return $appointments;

        $count_appointments = 0;
        $information =[];

        if ( $agenda[0]['start_hour'] === '07:00:00' ) {
            
            for ($i = 0; $i < sizeof($appointments) ; $i++) { 

                // if ( ( $request['agenda_id'] === $appointments[$i]['agenda_id'] ) ) {
                    // duración de las citas agendadas
                    $dur = $appointments[$i]['duration'];
                    $appointment_end = date('H:i:s', strtotime($appointments[$i]['hour']." + $dur minute"));
        
                    if ( ( ( $request['hour'] >= $appointments[$i]['hour'] ) && ( $request['hour'] < $appointment_end ) ) || ( ( $request_hour_end > $appointments[$i]['hour'] ) && ( $request['hour'] < $appointments[$i]['hour'] ) ) ) {
                        $count_appointments++;
                    }
        
                    $information[$i] = ['hora inicio' => $request['hour'], 'hora fin' => $request_hour_end, "id agenda" => $appointments[$i]['agenda_id'],"inicio cita $i" => $appointments[$i]['hour'], "fin cita $i" => $appointment_end, 'contador' => $count_appointments];
            
                // }
            }
            // return $appointments;

        }else if( $agenda[0]['start_hour'] === '19:00:00' ){

            for ($i = 0; $i < sizeof($appointments) ; $i++) { 

                // if ( ( $request['agenda_id'] === $appointments[$i]['agenda_id'] ) ) {
                    
                    // duración de las citas agendadas
                    $dur = $appointments[$i]['duration'];
                    $appointment_end = date('H:i:s', strtotime($appointments[$i]['hour']." + $dur minute"));

                    if( ( $appointments[$i]['hour'] < $appointment_end ) && ( ( $request['hour'] < $request_hour_end ) && ( $request['date'] === $appointments[$i]['date'] ) ) ){

                        if ( ( $request['hour'] >= $appointments[$i]['hour'] && $request['hour'] < $appointment_end ) || ( $request['hour'] < $appointments[$i]['hour'] && ( ( $request_hour_end > $appointments[$i]['hour'] ) || ( $request['hour'] > $request_hour_end ) ) ) || ( $request_hour_end > $appointments[$i]['hour'] && $request_hour_end <= '07:00:00' && ( ( $request['hour'] > $request_hour_end ) || ( $request['hour'] < $appointments[$i]['hour'] ) ) ) ) {
                            
                            $count_appointments++;
                        
                        }

                    }else if( ( $appointments[$i]['hour'] > $appointment_end ) && ( ( $request['hour'] > $request_hour_end && $request['date'] === $appointments[$i]['date'] ) || ( ( $request['hour'] < $request_hour_end && $request_hour_end > $appointment_end ) && ( $request['date'] === $appointments[$i]['date'] ) ) || ( ( $request['hour'] >= '00:00:00' ) && ( $request_hour_end <= '07:00:00' ) && ( $request['date'] === date('Y-m-d', strtotime($appointments[$i]['date']."+ 1 day")) ) ) ) ){

                        if ( ( ( $request['hour'] <= $appointments[$i]['hour'] ) && ( $request['hour'] > $appointment_end ) && ( ( $request_hour_end > $appointments[$i]['hour'] ) || ( $request_hour_end >= '00:00:00' && $request_hour_end <= '07:00:00' ) ) ) || ( ( $request['hour'] >= $appointments[$i]['hour'] ) && ( $request['hour'] > $appointment_end ) && ( ( $request_hour_end > $appointments[$i]['hour'] ) || ( $request_hour_end >= '00:00:00' && $request_hour_end <= '07:00:00' ) ) ) || ( ( $request['hour'] < $appointment_end ) && ( $request_hour_end <= '07:00:00' ) ) ) {
                            
                            $count_appointments++;
                        
                        }

                    }

                    $information[$i] = ['hora inicio' => $request['hour'], 'hora fin' => $request_hour_end, "id agenda" => $appointments[$i]['agenda_id'],"inicio cita $i" => $appointments[$i]['hour'], "fin cita $i" => $appointment_end, 'contador' => $count_appointments];

                // }
                
            }

        }

        // return $count_appointments;

        // Devuelve si ya hay dos o más citas agendadas en el mismo día y horario
        if ($count_appointments >= 2) {
            
            return response()->json(['message' => 'No puedes agendar más citas en este horario', 'contador' => $count_appointments, $information]);
        }
        // else{
        //     return ["Algo paso", $information];
        // }

        // Valida que la fecha sea igual o mayor a la fecha actual
        $time_now = date('H:i:s');
        if ( ( $request['date'] >= $date_today ) ) {
            
            // Valida que las fechas de la agenda sean validas para agendar una cita
            if ( ( ( $agenda[0]['start_date'] <= $date_today ) && ( $agenda[0]['end_date'] >= $date_today ) ) || ( ( $request['date'] >= $date_today ) && ( $agenda[0]['start_date'] <= $request['date'] && $agenda[0]['end_date'] >= $request['date'] ) ) ) {

                // Valida que la fecha este dentro del rango de la fecha inicio y fin de la agenda 
                if ( ( $request['date'] >= $agenda[0]['start_date'] ) && ( $request['date'] <= $agenda[0]['end_date'] ) ) {

                    // Valida si el horario de la agenda es el de mañana
                    if ( ( $agenda[0]['start_hour'] === '07:00:00' ) ) {

                        // Valida que la hora inicio y fin del servicio este dentro del rango horario de la agenda 
                        if ( ( $request['hour'] >= $agenda[0]['start_hour'] ) && ( $request_hour_end <= $agenda[0]['end_hour'] ) && ( ( $request['hour'] > $time_now ) || ( $request['date'] > $date_today && ( $request['hour'] >= $agenda[0]['start_hour'] && $request_hour_end <= $agenda[0]['end_hour'] ) ) ) ) {

                            // si ya hay citas agendadas
                            if($employee_appointments->count() > 0){

                                $estado = [];
                                $citas = [];
                                $can_assign = 0;

                                for ($i=0; $i < sizeof($employee_appointments); $i++) {
                                            
                                    $appointment_hour_start = $employee_appointments[$i]['hour'];
                                    $appointment_duration = $employee_appointments[$i]['duration'];
                                    $appointment_hour_end = date('H:i:s', strtotime($appointment_hour_start."+ $appointment_duration minute"));     

                                    // Valida si la cita a asignar esta en el rango horario de otra cita 
                                    // if ( ( $request['date'] === $employee_appointments[$i]['date'] ) ) {
                                        
                                    if ( ( ( $request['hour'] >= $employee_appointments[$i]['hour'] ) && ( $request['hour'] < $appointment_hour_end ) ) || ( ( $request_hour_end > $appointment_hour_start ) && ( $request['hour'] < $appointment_hour_start ) ) ) {
                            
                                        $can_assign++;

                                        $estado[$i] = ['hora inicio' => $request['hour'], 'hora fin' =>  $request_hour_end, 'fecha' => $request['date'],'cita hora inicio' => $employee_appointments[$i]['hour'], 'cita hora fin' => $appointment_hour_end, 'cita fecha' => $employee_appointments[$i]['date'] ];
                                    } 

                                    // }                                   
                                
                                }

                                if ( $can_assign > 0 ) {
                                
                                    $estado[$i] = "No puedes agendar cita, ya hay una cita agendadá en este horario para este empleado";
                                
                                }else{
                                
                                    // $estado[$i] = "Si puedes agendar cita en este horario";
                                    $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));
                                    return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);
                                
                                }
                                
                                return ['message' => $estado, 'citas asignadas en ese horario' => $can_assign];

                            }else{

                                $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));

                                return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);
                            
                            }

                        }else{

                            return response()->json(['message' => 'No puedes crear una cita con esa hora', 'hora inicial cita' => $request['hour'], 'hora final cita' => $request_hour_end, 'hora inicio agenda' => $agenda[0]['start_hour'], 'hora final agenda' => $agenda[0]['end_hour']]);
                        
                        }

                    // Valida que el horario de la agenda es el de noche
                    }else if( ( $agenda[0]['start_hour'] === '19:00:00' ) ){

                        // Valida que la hora inicio y fin de la cita a asignar este en el rango de horas de la agenda
                        // if ( ( ( $request['hour'] >= $agenda[0]['start_hour'] && $request['hour'] <= '23:59:59' ) ) || ( ( $request['hour'] >= '00:00:00' ) && ( $request_hour_end <= $agenda[0]['end_hour'] ) ) ) {
                        if ( ( $request['hour'] >= $agenda[0]['start_hour'] && ( $request_hour_end > $request['hour_start'] || ( $request_hour_end <= '07:00:00' ) ) ) || ( $request_hour_end <= '07:00:00' ) ) {

                            if ( ( $request['date'] === $date_today && $request['hour'] > $time_now ) || ( $request['date'] > $date_today ) ) {

                                // Verifica si la fecha de la cita corresponde a la fecha fin de la agenda
                                if (  $request['date'] === $agenda[0]['end_date'] ) {

                                    // Valida si la hora final de la agenda es menor o igual a las 12 AM
                                    // if ( ( ( $request['hour'] > '00:00:00' ) && ( $request_hour_end > $request['hour'] ) ) || ( ( $request['hour'] > '00:00:00' ) && ( $request_hour_end === '00:00:00' ) ) ) {
                                    if ( ( $request['hour'] >= $agenda[0]['start_hour'] ) && ( ( $request_hour_end > $request['hour'] ) || ( $request_hour_end === '00:00:00' ) ) ) {

                                        $employee_appointments_mid_night = Appointment::select('date', 'hour', 'horarios.start_hour', 'horarios.end_hour', 'users.name', 'users.last_name', 'services.duration', 'states.name as service')
                                            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
                                            ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
                                            ->join('users', 'users.id', '=', 'agendas.employee_id')
                                            ->join('services', 'services.id', '=', 'appointments.service_id')
                                            ->join('states', 'states.id', '=', 'appointments.state_id')
                                            ->where([['users.id', '=', $emploeyee_id], ['appointments.date', '=', $request['date']], ['states.name', '=', 'Activo']])
                                            ->get();

                                        // if($employee_appointments->count() > 0){
                                        if ( $employee_appointments_mid_night->count() > 0 ){

                                            $estado2 = [];
                                            $can_assign2 = 0;
                                            // $information = [];

                                            // return 'si entra en el count';

                                            for ($i=0; $i < sizeof($employee_appointments_mid_night); $i++) { 
                                                
                                                $appointment_hour_start_nigth = $employee_appointments_mid_night[$i]['hour'];
                                                $appointment_duration_nigth = $employee_appointments_mid_night[$i]['duration'];
                                                $appointment_hour_end_nigth = date('H:i:s', strtotime($appointment_hour_start_nigth."+ $appointment_duration_nigth minute"));

                                                if ( ( ( $request['hour'] >= $appointment_hour_start_nigth ) && ( $request['hour'] < $appointment_hour_end_nigth ) ) || ( ( $request['hour'] < $appointment_hour_start_nigth ) && ( ( $request_hour_end > $appointment_hour_start_nigth ) || ( $request_hour_end === '00:00:00' ) ) ) || ( $request['hour'] <= $appointment_hour_start_nigth && ( $request_hour_end > $appointment_hour_start_nigth || $request['hour'] > $request_hour_end ) ) ) {
                                                    
                                                    $can_assign2++;
                                                    $information[$i] = [$employee_appointments_mid_night];

                                                }

                                                // $information[$i] = [$employee_appointments_mid_night];

                                            }

                                            // return ['especial nùmero de citas agendadas' => $employee_appointments_mid_night->count(), 'asignadas' => $can_assign2, $information];

                                            if ( $can_assign2 > 0 ) {
                                        
                                                $estado2[$i] = "No puedes agendar cita, ya hay una cita agendadá en este horario para este empleado";
                                            
                                            }else{
                                                
                                                $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));
                                                return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);

                                            }
                                                // $estado2[$i] = "Si puedes agendar cita en este horario";
                                            // return ['nùmero de citas agendadas' => $employee_appointments_mid_night->count(), 'asignadas' => $can_assign2];
                                            return ['message' => $estado2, 'citas asignadas en ese horario' => $can_assign2];

                                            
                                        }else{

                                            $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));
                                            return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);

                                        }
                                        // return ["horario apenas", $agenda, 'hora inicial' => $request['hour'], 'hora final' => $request_hour_end];
                                
                                    }else{
                                        return ["supero horario", $agenda, 'hora inicial' => $request['hour'], 'hora final' => $request_hour_end];
                                    }
                                
                                }else {

                                    if($employee_appointments->count() > 0){

                                        $estado2 = [];
                                        $can_assign2 = 0;
                                        $information = [];

                                        for ($i=0; $i < sizeof($employee_appointments); $i++) { 
                                                    
                                            $appointment_hour_start_nigth = $employee_appointments[$i]['hour'];
                                            $appointment_duration_nigth = $employee_appointments[$i]['duration'];
                                            $appointment_hour_end_nigth = date('H:i:s', strtotime($appointment_hour_start_nigth."+ $appointment_duration_nigth minute"));   

                                            if( $appointment_hour_start_nigth < $appointment_hour_end_nigth && ( $request['date'] === $employee_appointments[$i]['date'] ) ){

                                                // cambio fecha cita y fecha registros
                                                if ( ( $request['hour'] >= $appointment_hour_start_nigth && $request['hour'] < $appointment_hour_end_nigth ) || ( $request['hour'] < $appointment_hour_start_nigth && ( ( $request_hour_end > $appointment_hour_start_nigth ) || ( $request['hour'] > $request_hour_end ) ) ) || ( $request_hour_end > $appointment_hour_start_nigth && $request_hour_end <= '07:00:00' && ( ( $request['hour'] > $request_hour_end ) || ( $request['hour'] < $appointment_hour_start_nigth ) ) ) ) {
                                                    
                                                    $can_assign2++;
                                                    $information[$i] = [$employee_appointments, $can_assign2, 'a'];
                                                
                                                }

                                            }else if( $appointment_hour_start_nigth > $appointment_hour_end_nigth && ( ( ( $request['hour'] > $request_hour_end ) && ( $request['date'] === $employee_appointments[$i]['date'] ) ) || ( ( $request['hour'] < $appointment_hour_end_nigth ) && ( $request['date'] === date('Y-m-d', strtotime($employee_appointments[$i]['date']."+ 1 day") ) ) ) ) ){

                                                // $request_hour_end = date('H:i:s', strtotime($request['hour']."+ $duration_service minute"));

                                                if ( ( ( $request['hour'] <= $appointment_hour_start_nigth ) && ( $request['hour'] > $appointment_hour_end_nigth ) && ( ( $request_hour_end > $appointment_hour_start_nigth ) || ( $request_hour_end >= '00:00:00' && $request_hour_end <= '07:00:00' ) ) ) || ( ( $request['hour'] >= $appointment_hour_start_nigth ) && ( $request['hour'] > $appointment_hour_end_nigth ) && ( ( $request_hour_end > $appointment_hour_start_nigth ) || ( $request_hour_end >= '00:00:00' && $request_hour_end <= '07:00:00' ) ) ) || ( ( $request['hour'] < $appointment_hour_end_nigth ) && ( $request_hour_end <= '07:00:00' ) ) ) {
                                                    
                                                    $can_assign2++;
                                                    $information[$i] = [$employee_appointments[$i], $can_assign2, 'b'];

                                                }

                                            }      
                                                                                    
                                        }

                                        if ( $can_assign2 > 0 ) {
                                        
                                            $estado2[$i] = "No puedes agendar cita, ya hay una cita agendadá en este horario para este empleado";
                                        
                                        }else{
                                        
                                            // $estado2[$i] = "Si puedes agendar cita en este horario";
                                            $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));
                                            return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);
                                        
                                        }
                                        
                                        return ['message' => $estado2, 'citas asignadas en ese horario' => $can_assign2, $information];

                                    }else{

                                        $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));
                                        return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);

                                    }
                                }
                            
                            }else{

                                return response()->json(['message' => 'Hora debe ser mayor a la hora actual para la cita', 'hora cita' => $request['hour'], 'hora actual' => $time_now]);

                            }

                        }else{

                            return response()->json(['message' => 'No puedes crear una cita con esa hora', 'hora inicial cita' => $request['hour'], 'hora final cita' => $request_hour_end, 'hora inicio agenda' => $agenda[0]['start_hour'], 'hora final agenda' => $agenda[0]['end_hour']]);
                        
                        }

                    }

                    
                }else{
                    return response()->json(['message' => 'La fecha elegida no esta dentro del rango de la agenda seleccionada']);
                }
            }else{
                return response()->json(['message' => 'Fechas de agenda no son validas para agendar la cita']);
            }
        }else{
            return response()->json(['message' => 'La fecha no es valida']);
        }
        
    }

    public function show(Appointment $appointment)
    {
        $appointment_query = Appointment::select('vehicles.plate', 'users.name', 'users.last_name', 'services.price')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('vehicles', 'vehicles.id', '=', 'appointments.vehicle_id')
            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
            ->join('users', 'users.id', '=', 'employee_id')
            ->where('appointments.id', '=', $appointment['id'])
            ->get();
        $appointment_client = [
            'date' => $appointment['date'],
            'hour' => $appointment['hour'],
            'plate' => $appointment_query[0]['plate'],
            'employee' => $appointment_query[0]['name']." ".$appointment_query[0]['last_name'],
            'price' => $appointment_query[0]['price'],
        ];
        return response()->json($appointment_client, 200);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id'
        ]);
        if ( $appointment['state_id'] === 1 ) {
            $appointment->update($request->only('state_id'));
            return response()->json(['message' => 'Se cancelo la cita correctamente'], 200);
        }else{
            return response()->json(['message' => 'No se pudo actualizar cita']);
        }
    }

}
