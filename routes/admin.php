<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\YardManagerController;

Route::get('', [HomeController::class, 'index'])->name('admin.home')->middleware('active');

Route::resource('administrators', AdministratorController::class)->names('admin.administrators');

Route::resource('employees', EmployeeController::class)->names('admin.employees')->middleware('active'); 

Route::resource('yardManagers', YardmanagerController::class)->names('admin.yardManagers')->middleware('active');

Route::resource('users', UserController::class)->names('admin.users')->middleware('active'); 