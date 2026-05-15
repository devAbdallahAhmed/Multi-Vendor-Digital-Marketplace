<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KycCheckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\KycSettingController;
use App\Http\Controllers\Frontend\KycVerificationController;

Route::middleware('guest:admin')
->prefix('admin/')
->name('admin.')
->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:admin')
->prefix('admin/')
->name('admin.')
->group(function () {

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
        Route::get('dashboard' ,[DashboardController::class ,'index'])->name('dashboard');
     //                          --- Profile Routes ---
        Route::get('profile/',[ProfileController::class,'index'])->name('profile.index');
        Route::put('profile/',[ProfileController::class,'update'])->name('profile.update');
        Route::put('profile/password',[ProfileController::class,'updatePassword'])->name('profile.updatePassword');
        //                          Route Management Routes
        Route::resource('roles', RoleController::class);
        //                          Roles Assignment Routes
        Route::resource('role-users', RoleUserController::class);
        //                          KYC_Setting
       Route::resource('kyc-setting', KycSettingController::class);
       Route::put('kyc-setting/update', [KycSettingController::class, 'update'])->name('kyc-setting.update');
       //


    Route::get(
            'kyc-request/download-document/{kyc}/{index}',
            [KycCheckController::class, 'downloadDocument']
        )->name('kyc-request.download-document');


        Route::put('kyc-update-status/{kyc}',[KycCheckController::class,'updateStatus'])->name('kyc-update-status');
   //    KYC Status Request
        Route::resource('kyc-request', KycCheckController::class)
        ->parameters([
        'kyc-request' => 'kyc'
    ]);



       });
