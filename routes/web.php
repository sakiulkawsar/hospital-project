<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;


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
Route::post('/appointment', [UserController::class,'Appointment'])->name('appointment');

Route::get('/contact',[userController::class,'contact'])->name('contact');
Route::get('/appointment',[userController::class,'appointments'])->name('appointment');


Route::get('/dashboard',[UserController::class,'Dashboard'] )->middleware(['auth', 'verified'])->name('dashboard');
 

  Route::middleware('auth','admin')->group(function () {
    Route::get('/add_doctors',[AdminController::class,'addDoctors'] )->middleware(['auth', 'verified'])->name('add_doctors');
    Route::post('/add_doctors',[AdminController::class,'postAddDoctors'] )->middleware(['auth', 'verified'])->name('add_doctors.store');
     Route::get('/view_doctors',[AdminController::class,'viewDoctors'] )->middleware(['auth', 'verified'])->name('view_doctors');
     Route::get('/delete_doctor/{id}',[AdminController::class,'deleteDoctor'] )->name('delete_doctor');
     Route::get('/update_doctor/{id}',[AdminController::class,'updateDoctor'] )->name('update_doctor');
     Route::post('/post_update_doctors/{id}',[AdminController::class,'postUpdateDoctors'] )->name('post_update_doctors');
     Route::get('/view_appointment',[AdminController::class,'viewAppointment'] )->name('view_appointment');
      Route::post('/changestatus/{id}',[AdminController::class,'changeStatus'] )->name('changestatus');
     
});  

Route::middleware(['auth', 'doctor', 'verified'])->group(function () {
    Route::get('/add_patients', [DoctorController::class, 'addPatients'])->name('add_patients');
    Route::post('/add_patients', [DoctorController::class, 'store'])->name('add_patients.store');
    Route::get('/view_patients', [DoctorController::class, 'viewPatients'])->name('view_patients');
       Route::get('/delete_patient/{id}',[DoctorController::class,'deletePatient'] )->name('delete_patient');
     Route::get('/update_patient/{id}',[DoctorController::class,'updatePatient'] )->name('update_patient');
     
     Route::post('/update_patient/{id}',[DoctorController::class, 'postUpdatePatient'])->name('post_update_patients'); 
    

        
  
        
        
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
