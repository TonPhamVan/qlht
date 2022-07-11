<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('layouts/master');
});



Route::get('/login',[LoginController::class,'login']);
Route::post('/postLogin',[LoginController::class,'postLogin']);

Route::prefix('customers')->name('customers.')->group(function() {
    Route::get('/',[CustomerController::class,'index'])->name('index');

    Route::get('/add',[CustomerController::class,'add'])->name('add');

    Route::post('/add',[CustomerController::class,'postAdd'])->name('postAdd');

    Route::get('/edit/{id}',[CustomerController::class,'getEdit'])->name('getEdit');

    Route::post('/update',[CustomerController::class,'postEdit'])->name('postEdit');

    Route::get('/delete/{id}',[CustomerController::class,'delete'])->name('delete');
});