<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\VendorController;
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
Route::group(['middleware' => ['role:vendor']], function(){
    Route::get('vendors', [VendorController::class, 'vendors']);
    Route::get('vendor/{id}', [UserController::class, 'vendor']);
    Route::post('vendor', [VendorController::class, 'store']);
    Route::put('vendor/update/{id}', [VendorController::class, 'update']);
    Route::delete('vendor/delete/{id}', [VendorController::class, 'delete']);
});
