<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    //All secure URL's
    Route::get('data', [DummyController::class, 'getData']);
    Route::get('list/{id?}', [CarController::class, 'list']);
    Route::post('add', [CarController::class, 'store']);
    Route::put('update', [CarController::class, 'update']);
    Route::get('search/{model}', [CarController::class, 'search']);
    Route::delete('delete/{id}', [CarController::class, 'delete']);
    Route::post('save', [CarController::class, 'testData']);
});




Route::post("login",[UserController::class,'index']);
Route::post("upload",[UserController::class,'upload']);