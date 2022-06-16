<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ResultEmployeeController extends Controller
{
    public function index()
    {
        $employees = User::role('employee')->get();
        
        return view('admin.result_employees.index', compact('employees'));
    }

    public function show(User $employee)
    {
        return view('admin.result_employees.show', compact('employee'));
    }
}
