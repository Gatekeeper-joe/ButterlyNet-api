<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\GetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\Auth\RegisterController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request, User $user) {
//     return $request->user();
// });

Auth::routes();

Route::group(['middleware' => 'api'], function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/registUser', [RegisterController::class, 'registUser']);
    Route::post('/registURL', [RegisterController::class, 'registURL']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/getUpdated', [GetController::class, 'getUpdated']);
    Route::post('/getRecord', [GetController::class, 'getRecord']);
    Route::post('/updateFlag', [UpdateController::class, 'updateFlag']);
    Route::post('/create', [UpdateController::class, 'save']);
    Route::post('/delete', [deleteController::class, 'execute']);
});
