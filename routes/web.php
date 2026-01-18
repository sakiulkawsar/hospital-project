<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
Route::get('/', [UserController::class,'Index'])->name('Index');
Route::get('/alldoctors',[UserController::class,'allDoctors'] )->name('alldoctors');
Route::get('/dashboard',[UserController::class,'Dashboard'] )->middleware(['auth', 'verified'])->name('dashboard');
 

  Route::middleware('auth','admin')->group(function () {
    Route::get('/add_doctors',[AdminController::class,'addDoctors'] )->middleware(['auth', 'verified'])->name('add_doctors');
    Route::post('/add_doctors',[AdminController::class,'postAddDoctors'] )->middleware(['auth', 'verified'])->name('add_doctors.store');
});  

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
