<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\UserController as UserApiV1;
use App\Http\Controllers\Api\v1\user\AppointmentMorningController;
use App\Http\Controllers\Api\v1\user\VehicleController;
use App\Http\Controllers\Api\v1\yardManager\AppointmentController;
use App\Http\Controllers\Api\v1\yardManager\TaskController;
use App\Http\Controllers\Api\v1\yardManager\UnscheduledTaskController;
use App\Http\Controllers\Api\v1\yardManager\VehicleController as YardManagerVehicleController;
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [UserApiV1::class, 'register']);
Route::post('login', [UserApiV1::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('user', [UserApiV1::class, 'getAuthenticatedUser']);
    Route::get('logout', [UserApiV1::class, 'logout']);

    // Route::apiResource('v1/appointments-user', AppointmentController::class)->names('user.appointments')->only(['index', 'store', 'show', 'update']);

    // Route::apiResource('v1/appointments-yard-manager', YardManagerAppointmentController::class)->names('yard.appointments')->only(['index', 'store', 'show', 'update']);

    // Route::apiResource('v1/vehicles-yard-manager', YardManagerVehicleController::class)->names('yard.vehicles')->only(['index', 'store', 'update']);


    // Route::get('v1/items-appointment/vehicle/{modelcar}', [ItemAppointmentController::class, 'index']);

    // Route::get('v1/items-appointment/service/{service}', [ItemAppointmentController::class, 'freeTime']);

    // Client

    Route::apiResource('v1/vehicles-user', VehicleController::class)->names('user.vehicles')->only(['index', 'store', 'show', 'update']);

    Route::get('v1/appointment-morning', [AppointmentMorningController::class, 'index']);

    Route::get('v1/appointment-morning/check-vehicles', [AppointmentMorningController::class, 'checkVehicles']);

    Route::get('v1/appointment-morning/select-services/{vehicle}', [AppointmentMorningController::class, 'listServices']);

    Route::get('v1/appointment-morning/check-spaces/{vehicle}/{service}', [AppointmentMorningController::class, 'checkSpaces']);

    Route::get('v1/appointment-morning/check-employees/{vehicle}/{service}/{space}', [AppointmentMorningController::class, 'checkEmployees']);

    Route::post('v1/appointment-morning/create-appointment', [AppointmentMorningController::class, 'store']);

    // Jefe de Patio 

    Route::get('v1/appointments-scheduled', [AppointmentController::class, 'index']);

    Route::apiResource('v1/tasks', TaskController::class)->names('yard.tasks')->only(['index', 'show', 'store', 'update']);
    
    Route::get('v1/unscheduled-appointments', [UnscheduledTaskController::class, 'index']);

    Route::get('v1/unscheduled-appointments/types', [UnscheduledTaskController::class, 'types']);

    Route::get('v1/unscheduled-appointments/services/{type}', [UnscheduledTaskController::class, 'servicesAndEmployees']);
    
    Route::get('v1/unscheduled-appointments/{unscheduledTask}', [UnscheduledTaskController::class, 'show']);
    
    Route::post('v1/unscheduled-appointments/', [UnscheduledTaskController::class, 'store']);
});

Route::get('v1/test', [TestController::class, 'index']);

Route::get('v1/posts', [PostController::class, 'index']);

Route::get('v1/posts/{post}', [PostController::class, 'show']);
// Route::get('v1/appointment-morning/select-services/{vehicle}', [AppointmentMorningController::class, 'listServices']);

// Route::apiResource('v1/tasks', TaskController::class)->names('yard.tasks')->only(['index', 'store']);

// Route::get('v1/tasks/check-appointments');