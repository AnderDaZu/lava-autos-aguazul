<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ScheduledSpace;
use Illuminate\Http\Request;

class ScheduledSpacesController extends Controller
{

    public function index()
    {
        $date = ScheduledSpace::select('date', 'ranges.start', 'ranges.end')
            ->join('ranges', 'ranges.id', '=', 'scheduled_spaces.range_id')
            ->where('appointment_id', '=', null)
            ->orderby('date')
            ->orderby('ranges.start')
            ->get();
        $date_now = date('Y-m');
        return $date;
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(ScheduledSpace $scheduledSpace)
    {
        //
    }

    public function edit(ScheduledSpace $scheduledSpace)
    {
        //
    }

    public function update(Request $request, ScheduledSpace $scheduledSpace)
    {
        //
    }

    public function destroy(ScheduledSpace $scheduledSpace)
    {
        //
    }
}
