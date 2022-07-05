<?php

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

//CURRENCIES ROUTES
Route::get('/',[App\Http\Controllers\CurrenciesController::class, 'currencyIndex'])->name('currencies-index');
Route::post('store-currency',[App\Http\Controllers\CurrenciesController::class, 'storeCurrencyInformation'])->name('store-currency');
Route::get('/edit-list-of-currency/{listOfCurrency}',[App\Http\Controllers\CurrenciesController::class, 'editListOfCurrency'])->name('edit-list-of-currency');
Route::put('/update-list-of-currency/{listOfCurrency}',[App\Http\Controllers\CurrenciesController::class, 'updateCurrencyInformation'])->name('update-list-of-currency');
Route::get('/delete-list-of-currency/{id}',[App\Http\Controllers\CurrenciesController::class, 'deleteCurrency'])->name('delete-list-of-currency');

