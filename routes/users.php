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


Route::post('user', [UserController::class, 'store'])->name('user.store')->middleware('auth:sanctum');
Route::post('user/login', [UserController::class, 'login'])->name('user.login')->middleware('auth:sanctum');
Route::get('user/logout', [UserController::class, 'logout'])->name('user.logout')->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum', 'role:admin|user']], function(){
    Route::get('users', [UserController::class, 'users']);
    Route::get('user/{id}', [UserController::class, 'user']);
    Route::put('user/update/{id}', [UserController::class, 'update']);
    Route::delete('user/delete/{id}', [UserController::class, 'delete']);
});