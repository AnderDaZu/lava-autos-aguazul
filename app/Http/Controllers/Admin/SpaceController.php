<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Space;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class SpaceController extends Controller
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spaces = Space::where('horario_id', 1)->where('duration_id', 1)->get();
        return view('admin.spaces.index', compact('spaces'));
    }

    public function update()
    {
        $spaces = Space::where('horario_id', 1)->where('duration_id', 1)->get();
        
        foreach ($spaces as $space) {
            $space->update(['times_taken' => 0] );
        }

        return redirect()->route('admin.spaces.index', compact('spaces'));
    }

}
