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
     // return $ultAgenda[0]['end_date'];
            // $users_night = User::select('users.id', 'users.name', 'horarios.start_hour')
            //                 ->join('horarios','horarios.id','=','users.horario_id')
            //                 ->join('states','states.id','=','users.state_id')
            //                 ->where('horarios.start_hour', '19:00')
            //                 ->where('states.name', 'Activo')
            //                 ->role('employee')
            //                 ->get();
        // $users = [$users_day, $users_night];
        // $fechaFin = date("Y-m-d", strtotime($fechaActual."+ 20 days"));

    public function index()
    {
        $appointments = Appointment::select('date', 'hour', 'agendas.start_date', 'agendas.end_date', 'horarios.start_hour', 'horarios.end_hour', 'users.name', 'users.last_name', 'services.duration')
                ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
                ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
                ->join('users', 'users.id', '=', 'agendas.employee_id')
                ->join('services', 'services.id', '=', 'appointments.service_id')
                // ->where('client_id', auth()->user()->id)
                ->get();

        $employee = Agenda::select('users.id')
            ->join('users', 'users.id', '=', 'agendas.employee_id')
            ->where('agendas.id', '=', 4)
            ->get();
        $emploeyee_id = $employee[0]['id'];

        $date_today = date('Y-m-d');

        $employee_appointments = Appointment::select('date', 'hour', 'agendas.start_date', 'agendas.end_date', 'horarios.start_hour', 'horarios.end_hour', 'users.name', 'users.last_name', 'services.duration', 'agendas.id', 'states.name as state')
            ->join('agendas', 'agendas.id', '=', 'appointments.agenda_id')
            ->join('horarios', 'horarios.id', '=', 'agendas.horario_id')
            ->join('users', 'users.id', '=', 'agendas.employee_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('states', 'states.id', '=', 'appointments.state_id')
            ->where([['users.id', '=', $emploeyee_id], ['appointments.date', '>=', $date_today], ['states.name', '=', 'Activo']])
            ->get();

        return $employee_appointments;

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
            ->where('appointments.date', '>=', $request['date'])
            ->orderBy('hour')
            ->get();
        // return $appointments;

        $count_appointments = 0;
        $information =[];

        for ($i = 0; $i < sizeof($appointments) ; $i++) { 

            // duración de las citas agendadas
            $dur = $appointments[$i]['duration'];
            $appointment_end = date('H:i:s', strtotime($appointments[$i]['hour']." + $dur minute"));

            if ( ( ( $request['hour'] >= $appointments[$i]['hour'] ) && ( $request['hour'] < $appointment_end ) ) || ( ( $request_hour_end > $appointments[$i]['hour'] ) && ( $request['hour'] < $appointments[$i]['hour'] ) ) ) {
                $count_appointments++;
            }

            $information[$i] = ['hora inicio' => $request['hour'], 'hora fin' => $request_hour_end, "id agenda" => $appointments[$i]['agenda_id'],"inicio cita $i" => $appointments[$i]['hour'], "fin cita $i" => $appointment_end, 'contador' => $count_appointments];
            
        }


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
            if ( ( $agenda[0]['start_date'] <= $date_today ) && ( $agenda[0]['end_date'] >= $date_today ) ) {

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
                                    if ( ( $request['date'] === $employee_appointments[$i]['date'] ) ) {
                                        
                                        if ( ( ( $request['hour'] >= $employee_appointments[$i]['hour'] ) && ( $request['hour'] < $appointment_hour_end ) ) || ( ( $request_hour_end > $employee_appointments[$i]['hour'] ) && ( $request['hour'] < $employee_appointments[$i]['hour'] ) ) ) {
                                
                                            $can_assign++;
    
                                            $estado[$i] = ['hora inicio' => $request['hour'], 'hora fin' =>  $request_hour_end, 'fecha' => $request['date'],'cita hora inicio' => $employee_appointments[$i]['hour'], 'cita hora fin' => $appointment_hour_end, 'cita fecha' => $employee_appointments[$i]['date'] ];
                                        } 

                                    }                                   
                                
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
                        if ( ( ( $request['hour'] >= $agenda[0]['start_hour'] && $request['hour'] <= '23:59:59' ) ) || ( ( $request['hour'] >= '00:00:00' ) && ( $request_hour_end <= $agenda[0]['end_hour'] ) ) ) {

                            // Verifica si la fecha de la cita corresponde a la fecha fin de la agenda
                            if (  $request['date'] === $agenda[0]['end_date'] ) {

                                // Valida si la hora final de la agenda es menor o igual a las 12 AM
                                if ( ( ( $request['hour'] > '00:00:00' ) && ( $request_hour_end > $request['hour'] ) ) || ( ( $request['hour'] > '00:00:00' ) && ( $request_hour_end === '00:00:00' ) ) ) {

                                    if($employee_appointments->count() > 0){



                                    }else{

                                        $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));
                                        return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);

                                    }
                                    return ["horario apenas", $agenda, 'hora inicial' => $request['hour'], 'hora final' => $request_hour_end];
                            
                                }else{
                                    return ["supero horario", $agenda, 'hora inicial' => $request['hour'], 'hora final' => $request_hour_end];
                                }
                            
                            }else {

                                if($employee_appointments->count() > 0){

                                    $estado2 = [];
                                    $can_assign2 = 0;

                                    for ($i=0; $i < sizeof($employee_appointments); $i++) { 
                                                
                                        $appointment_hour_start_nigth = $employee_appointments[$i]['hour'];
                                        $appointment_duration_nigth = $employee_appointments[$i]['duration'];
                                        $appointment_hour_end_nigth = date('H:i:s', strtotime($appointment_hour_start_nigth."+ $appointment_duration_nigth minute"));   
                                        
                                        if ( ( $appointment_hour_start_nigth >= $agenda[0]['start_hour'] ) && ( $appointment_hour_start_nigth < $appointment_hour_end_nigth ) ) {
                                            
                                            // citas para antes de las 00:00
                                            if ( ( $request['hour'] >= $agenda[0]['hour_start'] && $request_hour_end <= $appointment_hour_start_nigth ) || ( $request['hour'] >= $appointment_hour_end_nigth && $request['hour'] < $request_hour_end ) ) {
                                                
                                            }else{
                                                return response()->json(['message' => 'Espacio horario no alcanza para agendar cita en este horario']);
                                            }

                                        }else if ( ( $appointment_hour_start_nigth > $appointment_hour_end_nigth ) && ( ( $appointment_hour_start_nigth >= '19:00:00' ) & ( $appointment_hour_end_nigth <= '07:00:00' ) ) ) {
                                            
                                            // citas que estan en el horario intermedio
                                            

                                        }else if ( ( $appointment_hour_start_nigth < $agenda[0]['end_hour'] ) && ( $appointment_hour_end_nigth <= $agenda[0]['end_hour'] ) ) {
                                            
                                            // citas que estan a partir de las 00:00

                                        }

                                        // Valida si la cita a asignar esta en el rango horario de otra cita 
                                        // if ( ( $request['date'] === $employee_appointments[$i]['date'] ) ) {
                                            
                                        //     if ( ( ( $request['hour'] >= $employee_appointments[$i]['hour'] ) && ( $request['hour'] < $appointment_hour_end_nigth ) ) || ( ( $request_hour_end > $employee_appointments[$i]['hour'] ) && ( $request['hour'] < $employee_appointments[$i]['hour'] ) ) ) {
                                    
                                        //         $can_assign2++;
        
                                        //         $estado2[$i] = ['hora inicio' => $request['hour'], 'hora fin' =>  $request_hour_end, 'fecha' => $request['date'],'cita hora inicio' => $employee_appointments[$i]['hour'], 'cita hora fin' => $appointment_hour_end_nigth, 'cita fecha' => $employee_appointments[$i]['date'] ];
                                        //     } 

                                        // }                                   
                                    
                                    }

                                    if ( $can_assign2 > 0 ) {
                                    
                                        $estado2[$i] = "No puedes agendar cita, ya hay una cita agendadá en este horario para este empleado";
                                    
                                    }else{
                                    
                                        // $estado2[$i] = "Si puedes agendar cita en este horario";
                                        $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));
                                        return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);
                                    
                                    }
                                    
                                    return ['message' => $estado2, 'citas asignadas en ese horario' => $can_assign2];

                                }else{

                                    $new_appointment = Appointment::create($request->only('date', 'hour', 'agenda_id', 'service_id', 'vehicle_id', 'client_id', 'state_id'));
                                    return response()->json(['message' => "cita con fecha: ".$new_appointment['date']." y hora: ".$new_appointment['hour']." ha sido registrada correctamente"], 201);

                                }
                                return ["fecha intermedia", $agenda, 'hora inicial' => $request['hour'], 'hora final' => $request_hour_end];
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
        //
    }

    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    public function destroy(Appointment $appointment)
    {
        //
    }
}
