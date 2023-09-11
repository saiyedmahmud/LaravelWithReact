<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => ['role:vendor|admin']], function(){
    Route::get('products', [ProductController::class, 'products']);
    Route::get('product/{id}', [ProductController::class, 'product']);
    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/update/{id}', [ProductController::class, 'update']);
    Route::delete('product/delete/{id}', [ProductController::class, 'delete']);
});
