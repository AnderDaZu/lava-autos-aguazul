<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\UserController;

Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::resource('employees', EmployeeController::class)->names('admin.employees');

Route::resource('administrators', AdministratorController::class)->names('admin.administrators');

Route::resource('users', UserController::class)->names('admin.users');