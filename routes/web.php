<?php

use App\Http\Controllers\Frontend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;

Route::get('/', [HomeController::class,'index'])->name('home');


Route::group(['middleware'=> 'auth' , 'verified'] , function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('profile',[ProfileController::class,'index'])->name('profile');
    Route::put('profile',[ProfileController::class,'update'])->name('profile.update');
    Route::put('password',[ProfileController::class,'updatePassword'])->name('profile.updatePassword');
    
    });




require __DIR__.'/auth.php';
