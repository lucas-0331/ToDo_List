<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SiteController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::resource('admin', TaskController::class)->except(['destroy', 'edit'])->names('task');
Route::resource('admin', TaskController::class)->names('admin');

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::get('/task/{id}', [SiteController::class, 'details'])->name('details');
