<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root']);

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index']);
//Language Translation

Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
Route::get('layout/{type}', [App\Http\Controllers\HomeController::class, 'layout']);

Route::post('/formsubmit', [App\Http\Controllers\HomeController::class, 'FormSubmit'])->name('FormSubmit');

// route tambahan
Route::group(['prefix'=>'pages'],function(){
    // master data
    Route::group(['prefix'=>'master'],function(){
        // get
        Route::get('{any}',[App\Http\Controllers\MasterController::class,'index']);

        // form
        Route::group(['prefix'=>'form'],function(){
            Route::get('{any}',[App\Http\Controllers\MasterController::class,'create']);
            Route::get('{any}/{id}',[App\Http\Controllers\MasterController::class,'edit']);
        });

        // store
        Route::group(['prefix'=>'store'],function(){
            Route::post('doctor',[App\Http\Controllers\DoctorController::class,'store'])->name('doctor.store');
            Route::post('specialist',[App\Http\Controllers\SpecialistController::class,'store'])->name('specialist.store');
            Route::post('room',[App\Http\Controllers\RoomController::class,'store'])->name('room.store');
            Route::post('medicine',[App\Http\Controllers\MedicineController::class,'store'])->name('medicine.store');
            Route::post('patient',[App\Http\Controllers\PatientController::class,'store'])->name('patient.store');
        });

        // update
        Route::group(['prefix'=>'update'],function(){
            Route::post('specialist/{id}',[App\Http\Controllers\SpecialistController::class,'update'])->name('specialist.update');
            Route::post('room/{id}',[App\Http\Controllers\RoomController::class,'update'])->name('room.update');
            Route::post('medicine/{id}',[App\Http\Controllers\MedicineController::class,'update'])->name('medicine.update');
            Route::post('patient/{id}',[App\Http\Controllers\PatientController::class,'update'])->name('patient.update');
        });

        // delete
        Route::get('/',[App\Http\Controllers\MasterController::class,'destroy'])->name('master.delete');
    });
});
