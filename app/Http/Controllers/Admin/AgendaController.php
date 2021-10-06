<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::all();
        return view('admin.agendas.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agendas.create');
    }

    public function store(Request $request)
    {
        $request['admin_id'] = auth()->user()->id;
        return $request;
        return redirect()->route('admin.agendas.index');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        return redirect()->route('admin.agendas.edit', compact('agenda'));
    }

    public function destroy(Agenda $agenda)
    {
        return redirect()->route('admin.agendas.index');
    }
}
