<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AgendaRequest;
use App\Models\Admin\Agenda;
use App\Models\Admin\Horario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use strtotime;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.agendas.index')->only('index');
        $this->middleware('can:admin.agendas.create')->only('create', 'store');
        $this->middleware('can:admin.agendas.edit')->only('edit', 'update');
        $this->middleware('can:admin.agendas.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.agendas.index');
    }

    public function create()
    {
        $users = User::select('users.id', 'users.name', 'users.last_name')
            ->join('states', 'states.id', '=', 'users.state_id')
            ->where('states.name', 'Activo')
            ->role('employee')
            ->get();
        
        $ultAgenda = Agenda::select('start_date', 'end_date', 'employee_id')->latest('end_date')->take(1)->get();
        // return $ultAgenda[0]['end_date'];
            // $users_night = User::select('users.id', 'users.name', 'horarios.start_hour')
            //                 ->join('horarios','horarios.id','=','users.horario_id')
            //                 ->join('states','states.id','=','users.state_id')
            //                 ->where('horarios.start_hour', '19:00')
            //                 ->where('states.name', 'Activo')
            //                 ->role('employee')
            //                 ->get();
        // $users = [$users_day, $users_night];

        $fechaActual = date('Y-m-d', strtotime(now()));
        $ultFechaAgenda = date("Y-m-d", strtotime($ultAgenda[0]['end_date']));
        
        if ($ultFechaAgenda <= $fechaActual) {
            $fechaFin = date("Y-m-d", strtotime($fechaActual."+ 20 days"));
        } else {
            $fechaFin = date("Y-m-d", strtotime($ultAgenda[0]['end_date'] . "+ 20 days"));
        }
        
        $fechaInicioF = date("Y-m-d", strtotime($fechaActual."+ 2 days"));

        $horaInicio = "00:00:00";
        $horaFin = "23:59:59";

        $horarios = Horario::select('id', 'start_hour', 'end_hour')->get();
        // $horarios = Horario::pluck('start_hour','id');

        // $users2 = User::select('id','name')
            //                 ->latest('id')
            //                 ->take(5)
            //                 ->get();
        // return $users;

        return view('admin.agendas.create', compact('users', 'horarios', 'fechaActual', 'fechaFin', 'fechaInicioF'));
        // return sizeof($users);

    }

    public function store(Request $request)
    {
        $start = $request['start_date'];
        $end = $request['end_date'];
        $fechaActual = date('Y-m-d', strtotime(now()));

        $ultFechas = Agenda::select('start_date', 'end_date', 'employee_id')->latest('end_date')->take(3)->get();
        $ultAgenda = Agenda::select('start_date', 'end_date', 'employee_id')->latest('end_date')->take(1)->get();
        $ultFechaAgenda = date("Y-m-d", strtotime($ultAgenda[0]['end_date']));

        // ultFechaAgenda -> corresponde a la última fecha registrada en la tabla de agendas
        if ($ultFechaAgenda <= $fechaActual) {
            // fechaUltAgenda -> corresponde a la fecha límite que podrá seleccionar el usuario al crear una agenda nuevo
            $fechaUltAgenda = date("Y-m-d", strtotime($fechaActual . "+ 20 days"));
        
        } else {
            $fechaUltAgenda = date("Y-m-d", strtotime($ultAgenda[0]['end_date'] . "+ 20 days"));
        }

        $nameEmp = User::select('name','last_name')->where('id',$request['employee_id'])->get();

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'horario_id' => 'required|exists:horarios,id',
            'employee_id' => 'required|exists:users,id'
        ]);
        
        if ($start >= $fechaUltAgenda || $end > $fechaUltAgenda) {
            return back()->with('info', "Debes crear una agenda antes de ".$fechaUltAgenda." para: ".$nameEmp[0]['name']." ".$nameEmp[0]['last_name']);
        }

        if ($start >= $end) {
            return back()->with('info', "Debes crear una agenda donde fecha inicio sea menor a fecha fin para: ".$nameEmp[0]['name']." ".$nameEmp[0]['last_name']);
        }

        $fechaActual = date('Y-m-d', strtotime(now()));

        if ($start < $fechaActual || $end < $fechaActual) {
            return back()->with('info', "Fecha inicio y/o fin deben ser mayores a la fecha actual");
        }

        for ($i=0; $i < sizeof($ultFechas); $i++) { 
            if ($start <= $ultFechas[$i]['end_date'] && $request['employee_id'] == $ultFechas[$i]['employee_id']) {
                return back()->with('info', "Debes crear una agenda después de ".$ultFechas[$i]['end_date']." para: ".$nameEmp[0]['name']." ".$nameEmp[0]['last_name']);
            }
        }
        
        $request['name'] = strtotime($request['start_date'])+$request['employee_id'];

        $agenda = Agenda::create($request->only('name','start_date','end_date','horario_id','employee_id','admin_id'));
        $name = $agenda->employee->name." ".$agenda->employee->last_name;
        Alert::success("Agenda de empleado: $name", 'Ha sido creada correctamente');

        return redirect()->route('admin.agendas.index');
    }

    public function edit(Agenda $agenda)
    {
        $fechaActual = date('Y-m-d', strtotime(now()));
        $minFecha = date("Y-m-d", strtotime($agenda->start_date. "+ 2 days"));
        return view('admin.agendas.edit', compact('agenda', 'fechaActual', 'minFecha'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $fechaActual = date('Y-m-d', strtotime(now()));
        $minFecha = date("Y-m-d", strtotime($agenda->start_date. "+ 2 days"));

        $request->validate([
            'end_date' => 'required',
        ]);

        if($request['end_date'] <= $agenda->end_date && $request['end_date'] >= $minFecha){
            $agenda->update($request->only('end_date'));
            $name = $agenda->employee->name." ".$agenda->employee->last_name;
            Alert::success("Agenda de empleado: $name", 'Ha sido actualizada correctamente');
        }else if($request['end_date'] > $agenda->end_date){
            return back()->with('info', "Debes actualizar la agenda antes del ".$agenda->end_date);
        }else if($request['end_date'] < $minFecha){
            return back()->with('info', "Debes actualizar la agenda después del ".$minFecha);
        }
        
        return redirect()->route('admin.agendas.index');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('admin.agendas.index');
    }
}
