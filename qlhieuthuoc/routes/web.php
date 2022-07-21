<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\DrugGroupController;
use App\Http\Controllers\ExportDetailController;
use App\Http\Controllers\ImportDetailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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


Route::get('/login',[LoginController::class,'login'])->name('login');

Route::post('/login',[LoginController::class,'postLogin']);

Route::post('/logout',[LoginController::class,'logout'])->name('logout');


// Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('layouts/master');
    })->name('master');

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

        Route::middleware('can:isAdmin')->get('/add',[DrugGroupController::class,'add'])->name('add');

        Route::middleware('can:isAdmin')->post('/add',[DrugGroupController::class,'postAdd'])->name('postAdd');

        Route::middleware('can:isAdmin')->get('/edit/{id}',[DrugGroupController::class,'getEdit'])->name('getEdit');

        Route::middleware('can:isAdmin')->post('/update',[DrugGroupController::class,'postEdit'])->name('postEdit');

        Route::middleware('can:isAdmin')->get('/delete/{id}',[DrugGroupController::class,'delete'])->name('delete');

        Route::middleware('can:isAdmin')->get('/trash',[DrugGroupController::class,'trash'])->name('trash');

        Route::middleware('can:isAdmin')->get('/untrash/{id}',[DrugGroupController::class,'untrash'])->name('untrash');

        Route::middleware('can:isAdmin')->get('/forceDelete/{id}',[DrugGroupController::class,'forceDelete'])->name('forceDelete');

    });

    Route::prefix('drugs')->name('drugs.')->group(function() {
        Route::get('/',[DrugController::class,'index'])->name('index');

        Route::middleware('can:isAdmin')->get('/add',[DrugController::class,'add'])->name('add');

        Route::middleware('can:isAdmin')->post('/add',[DrugController::class,'postAdd'])->name('postAdd');

        Route::middleware('can:isAdmin')->get('/edit/{id}',[DrugController::class,'getEdit'])->name('getEdit');

        Route::middleware('can:isAdmin')->post('/update',[DrugController::class,'postEdit'])->name('postEdit');

        Route::middleware('can:isAdmin')->get('/delete/{id}',[DrugController::class,'delete'])->name('delete');

        Route::middleware('can:isAdmin')->get('/trash',[DrugController::class,'trash'])->name('trash');

        Route::middleware('can:isAdmin')->get('/untrash/{id}',[DrugController::class,'untrash'])->name('untrash');

        Route::middleware('can:isAdmin')->get('/forceDelete/{id}',[DrugController::class,'forceDelete'])->name('forceDelete');

    });

    Route::prefix('suppliers')->name('suppliers.')->group(function() {
        Route::get('/',[SupplierController::class,'index'])->name('index');

        Route::middleware('can:isAdmin')->get('/add',[SupplierController::class,'add'])->name('add');

        Route::middleware('can:isAdmin')->post('/add',[SupplierController::class,'postAdd'])->name('postAdd');

        Route::middleware('can:isAdmin')->get('/edit/{id}',[SupplierController::class,'getEdit'])->name('getEdit');

        Route::middleware('can:isAdmin')->post('/update',[SupplierController::class,'postEdit'])->name('postEdit');

        Route::middleware('can:isAdmin')->get('/delete/{id}',[SupplierController::class,'delete'])->name('delete');

        Route::middleware('can:isAdmin')->get('/trash',[SupplierController::class,'trash'])->name('trash');

        Route::middleware('can:isAdmin')->get('/untrash/{id}',[SupplierController::class,'untrash'])->name('untrash');

        Route::middleware('can:isAdmin')->get('/forceDelete/{id}',[SupplierController::class,'forceDelete'])->name('forceDelete');

    });

    Route::prefix('import_details')->middleware('can:isAdmin')->name('import_details.')->group(function() {
        Route::get('/',[ImportDetailController::class,'index'])->name('index');

        Route::get('/add',[ImportDetailController::class,'add'])->name('add');

        Route::post('/add',[ImportDetailController::class,'postAdd'])->name('postAdd');

        Route::get('/delete/{id}',[ImportDetailController::class,'delete'])->name('delete');

        Route::get('/update',[ImportDetailController::class,'updateQuantity'])->name('update');


    });

    Route::prefix('export_details')->name('export_details.')->group(function() {
        Route::get('/',[ExportDetailController::class,'index'])->name('index');

        Route::get('/add',[ExportDetailController::class,'add'])->name('add');

        Route::post('/add',[ExportDetailController::class,'postAdd'])->name('postAdd');

        Route::get('/delete/{id}',[ExportDetailController::class,'delete'])->name('delete');

        Route::get('/update',[ExportDetailController::class,'updateQuantity'])->name('update');


    });

    Route::prefix('users')->middleware('can:isAdmin')->name('users.')->group(function() {
        Route::get('/',[UserController::class,'index'])->name('index');

        Route::get('/add',[UserController::class,'add'])->name('add');

        Route::post('/add',[UserController::class,'postAdd'])->name('postAdd');

        Route::get('/edit/{id}',[UserController::class,'getEdit'])->name('getEdit');

        Route::post('/update',[UserController::class,'postEdit'])->name('postEdit');

        Route::get('/delete/{id}',[UserController::class,'delete'])->name('delete');

    });
});
