<?php

use App\Models\Product;
use App\Models\Order;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    $data = Product::latest()->with('orders', 'suppliers')->get();

     return response()
        ->json($data);
    dd($data);
});

    /* Product Routes */
    $model_name = 'product';
    $controller_name = 'App\Http\Controllers\ProductController';
    Route::get("$model_name/", '' . $controller_name . '@index');
    Route::post("$model_name/store", '' . $controller_name . '@store');
    Route::post("$model_name/update", '' . $controller_name . '@update');
    Route::post("$model_name/destroy/{id}", '' . $controller_name . '@destroy');
    Route::post("$model_name/edit/{id}", '' . $controller_name . '@edit');
