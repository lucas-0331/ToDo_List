<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SiteController;
use Inertia\Inertia;


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

//Route::post('/update_status/{id}', [SiteController::class, 'update_status'])->name('update_status');

Route::prefix('/task')->controller(TaskController::class)->name('task.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{task}/details', 'show')->name('details');
    Route::get('/{task}/edit', 'edit')->name('edit');
    Route::post('/{task}/update', 'update')->name('update');
    Route::get('/{task}/destroy', 'destroy')->name('destroy');
    Route::post('/{task}/status', 'status')->name('status');
});

Route::get('/hello', [TaskController::class, 'hello'])
    ->name('hello');
Route::get('/', [TaskController::class, 'index'])
    ->name('task');
Route::get('/learn', [TaskController::class, 'learn'])
    ->name('learn');
Route::get('/price', [TaskController::class, 'price'])
    ->name('price');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
