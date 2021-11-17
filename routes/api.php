<?php

use App\Http\Controllers\Api\UserController as UserApiV1;
use App\Http\Controllers\Api\v1\user\AppointmentController;
use App\Http\Controllers\Api\v1\user\ItemAppointmentController;
use App\Http\Controllers\Api\v1\user\VehicleController;
use App\Http\Controllers\Api\v1\yardManager\AppointmentController as YardManagerAppointmentController;
use App\Http\Controllers\Api\v1\yardManager\TaskController;
use App\Http\Controllers\Api\v1\yardManager\VehicleController as YardManagerVehicleController;
use App\Models\Api\v1\Appointment;
use Illuminate\Http\Request;
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

    Route::apiResource('v1/vehicles-user', VehicleController::class)->names('user.vehicles')->only(['index', 'store', 'show', 'update']);

    Route::apiResource('v1/appointments-user', AppointmentController::class)->names('user.appointments')->only(['index', 'store', 'show', 'update']);

    Route::apiResource('v1/appointments-yard-manager', YardManagerAppointmentController::class)->names('yard.appointments')->only(['index', 'store', 'show', 'update']);

    Route::apiResource('v1/vehicles-yard-manager', YardManagerVehicleController::class)->names('yard.vehicles')->only(['index', 'store', 'update']);

    Route::apiResource('v1/tasks-yard-manager', TaskController::class)->names('yard.tasks')->only(['index', 'store']);

    Route::get('v1/items-appointment/vehicle/{modelcar}', [ItemAppointmentController::class, 'index']);

    Route::get('v1/items-appointment/service/{service}', [ItemAppointmentController::class, 'freeTime']);

});