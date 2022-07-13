<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DrugGroupController;
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

    Route::get('/trash',[CustomerController::class,'trash'])->name('trash');

    Route::get('/untrash/{id}',[CustomerController::class,'untrash'])->name('untrash');

    Route::get('/forceDelete/{id}',[CustomerController::class,'forceDelete'])->name('forceDelete');

});

Route::prefix('drug_groups')->name('drug_groups.')->group(function() {
    Route::get('/',[DrugGroupController::class,'index'])->name('index');

    Route::get('/add',[DrugGroupController::class,'add'])->name('add');

    Route::post('/add',[DrugGroupController::class,'postAdd'])->name('postAdd');

    Route::get('/edit/{id}',[DrugGroupController::class,'getEdit'])->name('getEdit');

    Route::post('/update',[DrugGroupController::class,'postEdit'])->name('postEdit');

    Route::get('/delete/{id}',[DrugGroupController::class,'delete'])->name('delete');

    Route::get('/trash',[DrugGroupController::class,'trash'])->name('trash');

    Route::get('/untrash/{id}',[DrugGroupController::class,'untrash'])->name('untrash');

    Route::get('/forceDelete/{id}',[DrugGroupController::class,'forceDelete'])->name('forceDelete');

});