<?php

use App\Http\Controllers\Api\UserController as UserApiV1;
use App\Http\Controllers\Api\v1\user\AppointmentController;
use App\Http\Controllers\Api\v1\user\VehicleController;
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

    Route::apiResource('v1/vehicles', VehicleController::class)->only(['index', 'store', 'update']);

    Route::apiResource('v1/appointments', AppointmentController::class)->only(['index', 'store']);

});