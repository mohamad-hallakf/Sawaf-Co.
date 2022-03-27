<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
$model_name = 'order';
$controller_name = 'App\Http\Controllers\OrderController';
Route::get("$model_name/", '' . $controller_name . '@index');
Route::post("$model_name/store", '' . $controller_name . '@store');
Route::post("$model_name/update", '' . $controller_name . '@update');
Route::post("$model_name/destroy/{id}", '' . $controller_name . '@destroy');
Route::post("$model_name/edit/{id}", '' . $controller_name . '@edit');
