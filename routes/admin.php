<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemReviewController;
use App\Http\Controllers\Admin\KycCheckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\KycSettingController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategory;
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
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        //                          --- Profile Routes ---
        Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile/', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
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


        Route::put('kyc-update-status/{kyc}', [KycCheckController::class, 'updateStatus'])->name('kyc-update-status');
        //    KYC Status Request
        Route::resource('kyc-request', KycCheckController::class)
            ->parameters([
                'kyc-request' => 'kyc'
            ]);



        //  Categories Routes
        Route::resource('categories', CategoryController::class);
        Route::resource('sub-categories', SubCategory::class);

        // Item Reviewer
        Route::get('items/review', [ItemReviewController::class, 'pendingIndex'])->name('items.review');
        Route::get('items/review/{id}/show', [ItemReviewController::class, 'pendingShow'])->name('items-review.show');
        Route::post('/item-review/update-status/{id}', [ItemReviewController::class, 'updateStatus'])->name('item.review.status');
        Route::get('items/review/approved', [ItemReviewController::class, 'approveIndex'])->name('approve.index');
        Route::get('items/review/hard-rejected', [ItemReviewController::class, 'hardRejectedIndex'])->name('hard.rejected.index');
        Route::get('items/review/soft-rejected', [ItemReviewController::class, 'softRejectedIndex'])->name('soft.rejected.index');
        Route::get('items/review/resubmitted', [ItemReviewController::class, 'resubmittedIndex'])->name('resubmitted.index');


        // Payment Settings
        Route::get('payment-setting', [PaymentSettingController::class, 'index'])->name('payment-setting.index');
        Route::put('/paypal-settings', [PaymentSettingController::class, 'updatePaypalSetting'])->name('paypal.setting');
        Route::get('/stripe-settings', [PaymentSettingController::class, 'stripeSetting'])->name('stripe.setting.index');
        Route::put('/stripe-setting', [PaymentSettingController::class, 'updateStripeSetting'])->name('stripe.setting');


        // Settings Routes
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('general-setting', [SettingController::class, 'updateGeneralSetting'])->name('general.setting.update');
    Route::get('commission-setting', [SettingController::class, 'commissionSettings'])->name('commission.setting');
    Route::put('commission-setting', [SettingController::class, 'updateCommissionSetting'])->name('commission.setting.update');
});
