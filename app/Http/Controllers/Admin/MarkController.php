<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Mark;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.marks.index')->only('index');
        $this->middleware('can:admin.marks.create')->only('create', 'store');
        $this->middleware('can:admin.marks.edit')->only('edit', 'update');
        $this->middleware('can:admin.marks.destroy')->only('destroy');
    }

    public function index()
    {
        $marks = Mark::all();
        return view('admin.marks.index', compact('marks'));
    }

    public function create()
    {
        return view('admin.marks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:marks'
        ]);
        $mark = Mark::create($request->only('name'));
        $name = $mark->name;

        Alert::success("Marca $name", 'Ha sido creada correctamente');

        return redirect()->route('admin.marks.index');
    }

    public function edit(Mark $mark)
    {   
        return view('admin.marks.edit', compact('mark'));
    }

    public function update(Request $request, Mark $mark)
    {
        $request->validate([
            'name' => "required|unique:marks,name,$mark->id"
        ]);
        $mark->update($request->only('name'));
        $name = $mark->name;

        toast("Marca $name, ha sido actualizada correctamente",'success');

        return redirect()->route('admin.marks.edit', compact('mark'));
    }

    public function destroy(Mark $mark)
    {
        $name = $mark->name;
        $mark->delete();
        Alert::info("Marca $name", "Se ha eleminado correctamente");
        return redirect()->route('admin.marks.index');
    }
}
