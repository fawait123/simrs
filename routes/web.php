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
        });

        // update
        Route::group(['prefix'=>'update'],function(){
            Route::post('specialist/{id}',[App\Http\Controllers\SpecialistController::class,'update'])->name('specialist.update');
        });

        // delete
        Route::get('/',[App\Http\Controllers\MasterController::class,'destroy'])->name('master.delete');
    });
});
