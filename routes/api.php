<?php

use App\Http\Controllers\Api\V1\Admin\ApiPaymentSettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\KycApiController;
use App\Http\Controllers\Api\V1\ItemApiController;
use App\Http\Controllers\Api\V1\Admin\ProfileController;
use App\Http\Controllers\Api\V1\Admin\KycCheckController;
use App\Http\Controllers\Api\V1\Admin\RoleUserController;
use App\Http\Controllers\Api\V1\Admin\SubCategoryController;
use App\Http\Controllers\Api\V1\Admin\CategoryApiController;
use App\Http\Controllers\Api\V1\Front\ProfileController as FrontProfileController;
use App\Http\Controllers\Api\V1\Front\Auth\LoginController as FrontLoginController;
use App\Http\Controllers\Api\V1\Admin\Auth\AdminAuthController as AdminLoginController;
use App\Http\Controllers\Api\V1\Admin\ItemReviewController;
use App\Http\Controllers\Api\V1\Front\Auth\RegisterUserController as FrontRegisterController;
use App\Http\Controllers\Api\V1\Front\ApiCartItemController;
use App\Http\Controllers\Api\V1\Front\ApiPaymentController;
/*
|--------------------------------------------------------------------------
| API Routes - Version 1 (v1)
|--------------------------------------------------------------------------
*/

// Generic Sanctum User Check
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ==========================================
// FRONT & AUTHOR ENDPOINTS (v1/front)
// ==========================================
Route::prefix('v1/front')->group(function () {

    // Public Guest Routes
    Route::post('/login', [FrontLoginController::class, 'login']);
    Route::post('/register', [FrontRegisterController::class, 'register']);

    // Authenticated User & Author Routes
    Route::middleware(['auth:sanctum', 'throttle:5,1'])->group(function () {

        // Cart Item
        Route::get('cart', [ApiCartItemController::class, 'index']);
        Route::post('cart/store/{id}', [ApiCartItemController::class, 'store']);
        Route::delete('cart/destroy/{id}', [ApiCartItemController::class, 'destroy']);

        // General Profile
        Route::get('/profile', [FrontProfileController::class, 'index']);
        Route::put('/profile/update', [FrontProfileController::class, 'update']);

        // KYC Verification (User Side)
        Route::get('kyc/status', [KycApiController::class, 'status']);
        Route::post('kyc/submit', [KycApiController::class, 'submit']);
        Route::post('kyc/resubmit', [KycApiController::class, 'resubmit']);


        Route::post('/payment/{gateway}/process', [ApiPaymentController::class, 'processPayment']);

        // Specialized Author Routes (Protected by Role)
        Route::middleware(['is_author'])->group(function () {
            Route::get('items', [ItemApiController::class, 'index']);
            Route::post('items', [ItemApiController::class, 'store']);
            Route::get('items/{id}', [ItemApiController::class, 'show']);
            Route::put('items/{id}', [ItemApiController::class, 'update']);
            Route::post('items/uploads', [ItemApiController::class, 'itemUploads']);
            Route::delete('items/uploads/{id}', [ItemApiController::class, 'deleteUpload']);
            Route::post('items/{id}/changelog', [ItemApiController::class, 'storeChangelog']);
            Route::get('items/{id}/history', [ItemApiController::class, 'history']);
        });
    });
});

// ==========================================
// ADMIN ENDPOINTS (v1/admin)
// ==========================================
Route::prefix('v1/admin')->group(function () {

    // Public Admin Login
    Route::post('/login', [AdminLoginController::class, 'login']);

    // Protected Admin System Routes
    Route::middleware('auth:sanctum')->group(function () {

        // Admin Profile
        Route::get('/profile', [ProfileController::class, 'index']);
        Route::put('/profile/update', [ProfileController::class, 'update']);

        // Internal Role Management
        Route::get('role/user', [RoleUserController::class, 'index']);
        Route::post('role/user/store', [RoleUserController::class, 'store']);
        Route::put('role/user/update/{role_user}', [RoleUserController::class, 'update']);
        Route::delete('role/user/delete/{role_user}', [RoleUserController::class, 'destroy']);

        // KYC Review Workflow (Admin View)
        Route::get('kyc-requests', [KycCheckController::class, 'index']);
        Route::get('kyc-requests/{kyc}', [KycCheckController::class, 'show']);
        Route::put('kyc-requests/{kyc}/update-status', [KycCheckController::class, 'updateStatus']);
        Route::get('kyc-requests/{kyc}/download/{index}', [KycCheckController::class, 'downloadDocument']);
        Route::delete('kyc-requests/{kyc}', [KycCheckController::class, 'destroy']);

        // Global System Metadata (Categories Control)
        Route::apiResource('categories', CategoryApiController::class);
        Route::apiResource('sub/categories', SubCategoryController::class);

        // Item Reviews
        Route::get('items/reviews', [ItemReviewController::class, 'pendingIndex']);
        Route::get('items/reviews/{id}/show', [ItemReviewController::class, 'pendingShow']);
        Route::put('items/reviews/{id}/update-status', [ItemReviewController::class, 'updateStatus']);
        Route::get('items/approved', [ItemReviewController::class, 'approveIndex']);
        Route::get('items/soft-rejected', [ItemReviewController::class, 'softRejectedIndex']);
        Route::get('items/hard-rejected', [ItemReviewController::class, 'hardRejectedIndex']);
        Route::get('items/resubmitted', [ItemReviewController::class, 'resubmittedIndex']);



        // Payment Gateway
        Route::put('/stripe-setting', [ApiPaymentSettingController::class, 'updateStripeSetting'])->name('stripe.setting');
        Route::put('/paypal-setting', [ApiPaymentSettingController::class, 'updatePaypalSetting'])->name('paypal.setting');
    });
});
