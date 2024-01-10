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

//Route::resource('admin', TaskController::class)->except(['destroy', 'edit'])->names('task');
Route::resource('admin', TaskController::class)->names('admin');

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::get('/task/{id}', [SiteController::class, 'details'])->name('details');

Route::get('/task/all/{id_user}', [SiteController::class, 'id_user'])->name('id_user');

Route::get('/task/edit/{id}', [SiteController::class, 'edit'])->name('edit');

Route::post('/task/edited', [SiteController::class, 'edited'])->name('edited');

Route::post('/update_status/{id}', [SiteController::class, 'update_status'])->name('update_status');

Route::delete('/delete_task/{id}', [SiteController::class, 'delete_task'])->name('delete_task');

Route::match(['get', 'post'], '/create_new_task/', [SiteController::class, 'create_task'])->name('create_task');
