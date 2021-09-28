<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('can:admin.home')->only('index');
    }

    public function index()
    {
        return view('admin.index');
    }
}
