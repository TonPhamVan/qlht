<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\DrugGroupController;
use App\Http\Controllers\ImportDetailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SupplierController;
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

Route::prefix('drugs')->name('drugs.')->group(function() {
    Route::get('/',[DrugController::class,'index'])->name('index');

    Route::get('/add',[DrugController::class,'add'])->name('add');

    Route::post('/add',[DrugController::class,'postAdd'])->name('postAdd');

    Route::get('/edit/{id}',[DrugController::class,'getEdit'])->name('getEdit');

    Route::post('/update',[DrugController::class,'postEdit'])->name('postEdit');

    Route::get('/delete/{id}',[DrugController::class,'delete'])->name('delete');

    Route::get('/trash',[DrugController::class,'trash'])->name('trash');

    Route::get('/untrash/{id}',[DrugController::class,'untrash'])->name('untrash');

    Route::get('/forceDelete/{id}',[DrugController::class,'forceDelete'])->name('forceDelete');

});

Route::prefix('suppliers')->name('suppliers.')->group(function() {
    Route::get('/',[SupplierController::class,'index'])->name('index');

    Route::get('/add',[SupplierController::class,'add'])->name('add');

    Route::post('/add',[SupplierController::class,'postAdd'])->name('postAdd');

    Route::get('/edit/{id}',[SupplierController::class,'getEdit'])->name('getEdit');

    Route::post('/update',[SupplierController::class,'postEdit'])->name('postEdit');

    Route::get('/delete/{id}',[SupplierController::class,'delete'])->name('delete');

    Route::get('/trash',[SupplierController::class,'trash'])->name('trash');

    Route::get('/untrash/{id}',[SupplierController::class,'untrash'])->name('untrash');

    Route::get('/forceDelete/{id}',[SupplierController::class,'forceDelete'])->name('forceDelete');

});

Route::prefix('import_details')->name('import_details.')->group(function() {
    Route::get('/',[ImportDetailController::class,'index'])->name('index');

    Route::get('/add',[ImportDetailController::class,'add'])->name('add');

    Route::post('/add',[ImportDetailController::class,'postAdd'])->name('postAdd');

    Route::get('/edit/{id}',[ImportDetailController::class,'getEdit'])->name('getEdit');

    Route::post('/update',[ImportDetailController::class,'postEdit'])->name('postEdit');

    Route::get('/delete/{id}',[ImportDetailController::class,'delete'])->name('delete');

    Route::get('/trash',[ImportDetailController::class,'trash'])->name('trash');

    Route::get('/untrash/{id}',[ImportDetailController::class,'untrash'])->name('untrash');

    Route::get('/forceDelete/{id}',[ImportDetailController::class,'forceDelete'])->name('forceDelete');

});