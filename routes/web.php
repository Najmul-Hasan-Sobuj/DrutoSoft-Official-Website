<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ServiceSectionController;
use App\Http\Controllers\Backend\WorkSectionController;
use App\Http\Controllers\Backend\TeamSectionController;
use App\Http\Controllers\Backend\ContactSectionController;

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

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('homes/edit', [App\Http\Controllers\Backend\HomeSectionController::class, 'edit'])->name('homes.index');
    Route::put('homes/update', [App\Http\Controllers\Backend\HomeSectionController::class, 'update'])->name('homes.update');

    Route::resource('service', ServiceSectionController::class);
    Route::resource('work', WorkSectionController::class);
    Route::resource('team', TeamSectionController::class);
    Route::resource('contact', ContactSectionController::class);
    
});
