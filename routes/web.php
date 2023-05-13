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
        Route::get('{any}',[App\Http\Controllers\MasterController::class,'index']);
        Route::group(['prefix'=>'doctor'],function(){
            Route::post('store',[App\Http\Controllers\MasterController::class,'doctorStore'])->name('doctor.store');
        });
    });
});
