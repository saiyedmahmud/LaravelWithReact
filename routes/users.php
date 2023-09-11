<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['role:user']], function(){
    Route::get('user', [UserController::class, 'users']);
    Route::get('user/{id}', [UserController::class, 'user']);
    Route::post('user', [UserController::class, 'store']);
    Route::put('user/update/{id}', [UserController::class, 'update']);
    Route::delete('user/delete/{id}', [UserController::class, 'delete']);
});