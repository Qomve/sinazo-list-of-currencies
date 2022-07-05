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


//We also need to edit our routes/api.php for, you guessed it, our API between the Laravel backend and Vue.
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/stocks', 'StockController@index');
Route::post('/stock/create', 'StockController@store');
Route::get('/stock/edit/{id}', 'StockController@edit');
Route::post('/stock/update/{id}', 'StockController@update');
Route::delete('/stock/delete/{id}', 'StockController@destroy');
