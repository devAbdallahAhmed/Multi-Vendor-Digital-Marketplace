<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ProfileController;
use App\Http\Controllers\Api\Admin\RoleUserController;
use App\Http\Controllers\Api\KycApiController;
use App\Http\Controllers\Api\Admin\KycCheckController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/front')->group(function () {
    Route::post('/login', [App\Http\Controllers\Api\Front\Auth\LoginController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\Api\Front\Auth\RegisterUserController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [App\Http\Controllers\Api\Front\ProfileController::class, 'index']);
        Route::put('/profile/update', [App\Http\Controllers\Api\Front\ProfileController::class, 'update']);

        //  KYC Submit
        Route::get('kyc/status', [KycApiController::class, 'status']);
        Route::post('kyc/submit', [KycApiController::class, 'submit']);
        Route::post('kyc/resubmit', [KycApiController::class, 'resubmit']);
    });
});





Route::prefix('v1/admin')->group(function () {
    Route::post('/login', [App\Http\Controllers\Api\Admin\Auth\AdminAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index']);
        Route::put('/profile/update', [ProfileController::class, 'update']);


        //Role & Permission
        Route::get('role/user', [RoleUserController::class, 'index']);
        Route::post('role/user/store', [RoleUserController::class, 'store']);
        Route::put('role/user/update/{role_user}', [RoleUserController::class, 'update']);
        Route::delete('role/user/delete/{role_user}', [RoleUserController::class, 'destroy']);



        //KYC Verification
        Route::get('kyc-requests', [KycCheckController::class, 'index']);
        Route::get('kyc-requests/{kyc}', [KycCheckController::class, 'show']);
        Route::put('kyc-requests/{kyc}/update-status', [KycCheckController::class, 'updateStatus']);
        Route::get('kyc-requests/{kyc}/download/{index}', [KycCheckController::class, 'downloadDocument']);
        Route::delete('kyc-requests/{kyc}', [KycCheckController::class, 'destroy']);
    });
});
