<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Auth::routes(['register'=>false]);
Route::get('/index',[\App\Http\Controllers\frontend\FrontendController::class,'index']);
Route::get('/dashboard',[\App\Http\Controllers\backend\DashboardController::class,'dashboard']);
//service
Route::resource('/service',(\App\Http\Controllers\backend\ServiceController::class));
Route::get('/service_list',[\App\Http\Controllers\backend\ServiceController::class,'service_list']);
Route::get('/create-pdf',[\App\Http\Controllers\backend\ServiceController::class,'createPDF'])->name('create-pdf');


//sub service
Route::resource('/sub-service',(\App\Http\Controllers\backend\SubserviceController::class));
Route::get('/subservice-list',[\App\Http\Controllers\backend\SubserviceController::class,'subservice_list'])->name('subservice_list');

//galleries
Route::resource('/galleries',(\App\Http\Controllers\backend\GalleryController::class));



Route::get('/notification',[\App\Http\Controllers\backend\IndexController::class,'whatsapphandler'])->name('notification');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){

    Route::get('/Dashboard',[\App\Http\Controllers\backend\IndexController::class,'admin_panel'])->name('Dashboard');
});

