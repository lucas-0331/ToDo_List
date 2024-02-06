<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemporaryTaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


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

Route::get('/', [TaskController::class, 'index'])
    ->name('index');

Route::get('/dashboard', [TaskController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->name('task.')->group(function () {
    Route::get('task/create', [TaskController::class, 'create'])->name('create');
    Route::post('task/store', [TaskController::class, 'store'])->name('store');
    Route::get('task/{task}/show', [TaskController::class, 'show'])->name('show');
    Route::get('task/{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::patch('task/{task}/update', [TaskController::class, 'update'])->name('update');
    Route::delete('task/{task}/destroy', [TaskController::class, 'destroy'])->name('destroy');
    Route::patch('task/{task}/status', [TaskController::class, 'status'])->name('status');
});
Route::post('email/send', [\App\Http\Controllers\ContactController::class, 'send'])->name('send');

Route::middleware(['auth', 'verified'])->name('temporary.')->group(function () {
    Route::get('temporary/task/index', [TemporaryTaskController::class, 'index'])->name('index');
    Route::post('temporary/task/store', [TemporaryTaskController::class, 'store'])->name('store');
    Route::get('temporary/{temporaryTask}/edit', [TemporaryTaskController::class, 'edit'])->name('edit');
    Route::patch('temporary/{temporaryTask}/update', [TemporaryTaskController::class, 'update'])->name('update');
    Route::delete('temporary/{temporaryTask}/destroy', [TemporaryTaskController::class, 'destroy'])->name('destroy');
    Route::get('temporary/task/import', [TemporaryTaskController::class, 'import'])->name('import');
    Route::patch('temporary/{temporaryTask}/flag', [TemporaryTaskController::class, 'flag'])->name('flag');
    Route::patch('temporary/all_task', [TemporaryTaskController::class, 'all_task'])->name('all_task');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
