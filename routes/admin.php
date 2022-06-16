<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\AmountController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\MarkController;
use App\Http\Controllers\Admin\ModelcarController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ResultEmployeeController;
use App\Http\Controllers\Admin\ResultServiceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SpaceController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\YardManagerController;

Route::get('main', [HomeController::class, 'index'])->name('admin.main')->middleware('active');

// Route::get('', [HomeController::class, 'index'])->name('admin.home');

Route::resource('administrators', AdministratorController::class)->names('admin.administrators');

Route::resource('employees', EmployeeController::class)->names('admin.employees')->middleware('active'); 

Route::resource('yardManagers', YardmanagerController::class)->names('admin.yardManagers')->middleware('active');

Route::resource('users', UserController::class)->names('admin.users')->middleware('active'); 

Route::resource('marks', MarkController::class)->names('admin.marks')->middleware('active');

Route::resource('types', TypeController::class)->names('admin.types')->middleware('active');

Route::resource('services', ServiceController::class)->names('admin.services')->middleware('active');

Route::resource('modelcars', ModelcarController::class)->names('admin.modelcars')->middleware('active');

Route::resource('appointments', AppointmentController::class)->names('admin.appointments')->middleware('active');

Route::resource('amounts', AmountController::class)->only('index', 'edit', 'update')->names('admin.amounts')->middleware('active');

Route::get('spaces', [SpaceController::class, 'index'])->name('admin.spaces.index')->middleware('active');

Route::put('spaces', [SpaceController::class, 'update'])->name('admin.spaces.update')->middleware('active');

Route::resource('posts', PostController::class)->names('admin.posts')->middleware('active'); 

Route::get('result/tasks', [ResultServiceController::class, 'index'])->name('admin.result_tasks');

Route::get('result/tasks/{task}', [ResultServiceController::class, 'show'])->name('admin.result_task');

Route::get('result/unscheduled-tasks', [ResultServiceController::class,'indexUnscheduledTask'])->name('admin.result_unscheduled_tasks');

Route::get('result/unscheduled-tasks/{task}', [ResultServiceController::class,'showUnscheduledTask'])->name('admin.result_unscheduled_task');

Route::get('result/employees', [ResultEmployeeController::class, 'index'])->name('admin.result_employees');

Route::get('result/employees/{employee}', [ResultEmployeeController::class, 'show'])->name('admin.result_employee');