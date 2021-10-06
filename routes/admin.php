<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LinecarController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\ModelcarController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\YardManagerController;

Route::get('', [HomeController::class, 'index'])->name('admin.home')->middleware('active');

Route::resource('administrators', AdministratorController::class)->names('admin.administrators');

Route::resource('employees', EmployeeController::class)->names('admin.employees')->middleware('active'); 

Route::resource('yardManagers', YardmanagerController::class)->names('admin.yardManagers')->middleware('active');

Route::resource('users', UserController::class)->names('admin.users')->middleware('active'); 

Route::resource('marks', MarkController::class)->names('admin.marks');

Route::resource('types', TypeController::class)->names('admin.types');

Route::resource('services', ServiceController::class)->names('admin.services');

// Route::resource('linescar', LinecarController::class)->names('admin.linescar');

Route::resource('modelcars', ModelcarController::class)->names('admin.modelcars');