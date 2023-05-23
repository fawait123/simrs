<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Auth::routes();

// route auth
Route::get('login',[App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::post('login',[App\Http\Controllers\AuthController::class,'loginAction'])->name('login');
Route::get('register',[App\Http\Controllers\AuthController::class,'register'])->name('register');
Route::post('register',[App\Http\Controllers\AuthController::class,'registerAction'])->name('register');
Route::post('logout',[App\Http\Controllers\AuthController::class,'logout'])->name('logout')->middleware('auth');


Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('home')->middleware('auth');
// route setting
Route::get('setting',[App\Http\Controllers\HomeController::class, 'setting'])->name('setting')->middleware('auth');
Route::post('setting',[App\Http\Controllers\HomeController::class, 'settingAction'])->name('setting')->middleware('auth');
Route::get('setting/patient',[App\Http\Controllers\HomeController::class, 'patient'])->name('patient')->middleware('auth');
Route::get('setting/patient/{id}',[App\Http\Controllers\HomeController::class, 'patientEdit'])->name('setting.patient.edit')->middleware('auth');
Route::post('setting/patient',[App\Http\Controllers\HomeController::class, 'patientStore'])->name('setting.patient.store')->middleware('auth');
Route::put('setting/patient/{id}',[App\Http\Controllers\HomeController::class, 'patientUpdate'])->name('setting.patient.update')->middleware('auth');

// route registrasi
Route::get('registration',[App\Http\Controllers\RegistrationController::class,'index'])->name('registration')->middleware('auth');
Route::post('registration',[App\Http\Controllers\RegistrationController::class,'submit'])->name('registration')->middleware('auth');

// list queue check
Route::get('list-queue-check',[App\Http\Controllers\QueueController::class,'index'])->name('list.queue')->middleware('auth');
Route::get('list-queue-check/json',[App\Http\Controllers\QueueController::class,'json'])->name('list.queue.json')->middleware('auth');

//route Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang'])->middleware('auth');
Route::get('layout/{type}', [App\Http\Controllers\HomeController::class, 'layout'])->middleware('auth');
Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit')->middleware('auth');

// route rekam medis
Route::get('medical-record',[\App\Http\Controllers\MedicalRecordController::class,'index'])->name('medical-record.index')->middleware('auth');
Route::post('medical-record',[\App\Http\Controllers\MedicalRecordController::class,'store'])->name('medical-record.store')->middleware('auth');
Route::get('medical-record/json',[\App\Http\Controllers\MedicalRecordController::class,'json'])->name('medical-record.json')->middleware('auth');

// administrator
Route::get('administrator',[\App\Http\Controllers\AdministratorController::class,'index'])->name('administrator.index')->middleware('auth');
Route::post('administrator',[\App\Http\Controllers\AdministratorController::class,'submit'])->name('administrator.submit')->middleware('auth');
Route::get('administrator/json',[\App\Http\Controllers\AdministratorController::class,'json'])->name('administrator.json')->middleware('auth');


// tracking
Route::get('tracking',[App\Http\Controllers\TrackingController::class,'index'])->name('tracking.index')->middleware('auth');



// route tambahan
Route::group(['prefix'=>'pages','middleware'=>['auth','role:admin']],function(){
    // master data
    Route::group(['prefix'=>'master'],function(){
        // get
        Route::get('user',[App\Http\Controllers\MasterController::class,'index']);
        Route::get('patient',[App\Http\Controllers\MasterController::class,'index']);
        Route::get('medicine',[App\Http\Controllers\MasterController::class,'index']);
        Route::get('doctor',[App\Http\Controllers\MasterController::class,'index']);
        Route::get('specialist',[App\Http\Controllers\MasterController::class,'index']);
        Route::get('room',[App\Http\Controllers\MasterController::class,'index']);

        // form
        Route::group(['prefix'=>'form'],function(){
            // create
            Route::get('user',[App\Http\Controllers\MasterController::class,'create']);
            Route::get('patient',[App\Http\Controllers\MasterController::class,'create']);
            Route::get('medicine',[App\Http\Controllers\MasterController::class,'create']);
            Route::get('doctor',[App\Http\Controllers\MasterController::class,'create']);
            Route::get('specialist',[App\Http\Controllers\MasterController::class,'create']);
            Route::get('room',[App\Http\Controllers\MasterController::class,'create']);

            // edit
            Route::get('user/{id}',[App\Http\Controllers\MasterController::class,'edit']);
            Route::get('patient/{id}',[App\Http\Controllers\MasterController::class,'edit']);
            Route::get('medicine/{id}',[App\Http\Controllers\MasterController::class,'edit']);
            Route::get('doctor/{id}',[App\Http\Controllers\MasterController::class,'edit']);
            Route::get('specialist/{id}',[App\Http\Controllers\MasterController::class,'edit']);
            Route::get('room/{id}',[App\Http\Controllers\MasterController::class,'edit']);
        });

        // store
        Route::group(['prefix'=>'store'],function(){
            Route::post('doctor',[App\Http\Controllers\DoctorController::class,'store'])->name('doctor.store');
            Route::post('specialist',[App\Http\Controllers\SpecialistController::class,'store'])->name('specialist.store');
            Route::post('room',[App\Http\Controllers\RoomController::class,'store'])->name('room.store');
            Route::post('medicine',[App\Http\Controllers\MedicineController::class,'store'])->name('medicine.store');
            Route::post('patient',[App\Http\Controllers\PatientController::class,'store'])->name('patient.store');
            Route::post('user',[App\Http\Controllers\UserController::class,'store'])->name('user.store');
        });

        // update
        Route::group(['prefix'=>'update'],function(){
            Route::put('specialist/{id}',[App\Http\Controllers\SpecialistController::class,'update'])->name('specialist.update');
            Route::put('room/{id}',[App\Http\Controllers\RoomController::class,'update'])->name('room.update');
            Route::put('medicine/{id}',[App\Http\Controllers\MedicineController::class,'update'])->name('medicine.update');
            Route::put('patient/{id}',[App\Http\Controllers\PatientController::class,'update'])->name('patient.update');
            Route::put('doctor/{id}',[App\Http\Controllers\DoctorController::class,'update'])->name('doctor.update');
            Route::put('user/{id}',[App\Http\Controllers\UserController::class,'update'])->name('user.update');
        });

        // delete
        Route::get('/',[App\Http\Controllers\MasterController::class,'destroy'])->name('master.delete');

        // delete image
        Route::put('user/status',[App\Http\Controllers\UserController::class,'status'])->name('user.status');
    });
});



// route any
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
