<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\ItemReviewController;
use App\Http\Controllers\Admin\KycCheckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\KycSettingController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategory;
use App\Http\Controllers\Admin\WithdrawMethodController;
use App\Http\Controllers\Admin\WithdrawRequestController;
use App\Http\Controllers\Admin\FeaturedCategoryController;
use App\Http\Controllers\Admin\HighlightedProductController;
use App\Http\Controllers\Admin\MonthlyPickedProductsController;
use App\Http\Controllers\Admin\FeaturedAuthorSectionController;
use App\Http\Controllers\Admin\CounterSectionController;
use App\Http\Controllers\Admin\BannerSectionController;
use App\Http\Controllers\Admin\FooterSectionController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\ContactInfoSectionController;
use App\Http\Controllers\Admin\WipeDatabaseController;


// ==========================================
// Guest Admin Routes (No Auth Required)
// ==========================================
Route::middleware('guest:admin')
    ->prefix('admin/')
    ->name('admin.')
    ->group(function () {

        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    });

// ==========================================
// Authenticated Admin Routes
// ==========================================
Route::middleware('auth:admin')
    ->prefix('admin/')
    ->name('admin.')
    ->group(function () {

        // --- Core Routes (Accessible to all authenticated admins) ---
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // --- Profile Management ---
        Route::get('profile/', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile/', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::get('get-states', [ProfileController::class, 'getStates'])->name('get-states');

        // --- Access Management (Roles & Permissions) ---
        Route::middleware(['permission:access management'])->group(function () {
            Route::resource('roles', RoleController::class);
            Route::resource('role-users', RoleUserController::class);
        });


        // --- KYC Management ---
        Route::middleware(['permission:manage KYC'])->group(function () {
            Route::resource('kyc-setting', KycSettingController::class);
            Route::put('kyc-setting/update', [KycSettingController::class, 'update'])->name('kyc-setting.update');
            Route::get('kyc-request/download-document/{kyc}/{index}', [KycCheckController::class, 'downloadDocument'])->name('kyc-request.download-document');
            Route::put('kyc-update-status/{kyc}', [KycCheckController::class, 'updateStatus'])->name('kyc-update-status');
            Route::resource('kyc-request', KycCheckController::class)->parameters(['kyc-request' => 'kyc']);
        });


        // --- Categories Management ---
        Route::middleware(['permission:manage categories'])->group(function () {
            Route::resource('categories', CategoryController::class);
            Route::resource('sub-categories', SubCategory::class);
        });


        // --- Product Review Management ---
        Route::middleware(['permission:review product'])->group(function () {
            Route::get('items/review', [ItemReviewController::class, 'pendingIndex'])->name('items.review');
            Route::get('items/review/{id}/show', [ItemReviewController::class, 'pendingShow'])->name('items-review.show');
            Route::post('/item-review/update-status/{id}', [ItemReviewController::class, 'updateStatus'])->name('item.review.status');
            Route::get('items/review/approved', [ItemReviewController::class, 'approveIndex'])->name('approve.index');
            Route::get('items/review/hard-rejected', [ItemReviewController::class, 'hardRejectedIndex'])->name('hard.rejected.index');
            Route::get('items/review/soft-rejected', [ItemReviewController::class, 'softRejectedIndex'])->name('soft.rejected.index');
            Route::get('items/review/resubmitted', [ItemReviewController::class, 'resubmittedIndex'])->name('resubmitted.index');
        });


        // --- Orders Management ---
        Route::middleware(['permission:manage order'])->group(function () {
            Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
            Route::get('orders/{id}/show', [OrderController::class, 'show'])->name('orders.show');
        });


        // --- Withdrawals Management ---
        Route::resource('withdraw-method', WithdrawMethodController::class)->middleware('permission:manage withdraw method');
        Route::resource('withdraw-request', WithdrawRequestController::class)->middleware('permission:manage withdraw request');


        // --- Sections Management ---
        Route::middleware(['permission:manage sections'])->group(function () {
            Route::get('ajax/product-search', [HeroSectionController::class, 'productSearch'])->name('ajax.product-search');
            Route::resource('hero-section', HeroSectionController::class);
            Route::resource('featured-category', FeaturedCategoryController::class);
            Route::resource('highlighted-product-section', HighlightedProductController::class);
            Route::resource('monthly-picked-product-section', MonthlyPickedProductsController::class);
            Route::get('featured-author-section', [FeaturedAuthorSectionController::class, 'index'])->name('featured-author-section.index');
            Route::put('featured-author-section/{id}', [FeaturedAuthorSectionController::class, 'update'])->name('featured-author-section.update');
            Route::get('counter-section', [CounterSectionController::class, 'index'])->name('counter-section.index');
            Route::put('counter-section/{id}', [CounterSectionController::class, 'update'])->name('counter-section.update');
            Route::get('footer-section', [FooterSectionController::class, 'index'])->name('footer-section.index');
            Route::put('footer-section/{id}', [FooterSectionController::class, 'update'])->name('footer-section.update');
            Route::resource('contact-section', ContactInfoSectionController::class);
        });


        // --- Banner Section ---
        Route::middleware(['permission:manage banner'])->group(function () {
            Route::get('banner-section', [BannerSectionController::class, 'index'])->name('banner-section.index');
            Route::put('banner-section/{id}', [BannerSectionController::class, 'update'])->name('banner-section.update');
        });


        // --- Social Links ---
        Route::resource('social-links', SocialLinkController::class)->middleware('permission:manage socials');


        // --- Payment Settings ---
        Route::middleware(['permission:payment setting'])->group(function () {
            Route::get('payment-setting', [PaymentSettingController::class, 'index'])->name('payment-setting.index');
            Route::put('/paypal-settings', [PaymentSettingController::class, 'updatePaypalSetting'])->name('paypal.setting');
            Route::get('/stripe-settings', [PaymentSettingController::class, 'stripeSetting'])->name('stripe.setting.index');
            Route::put('/stripe-setting', [PaymentSettingController::class, 'updateStripeSetting'])->name('stripe.setting');
        });


        // --- General Settings ---
        Route::middleware(['permission:manage settings'])->group(function () {
            Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
            Route::put('general-setting', [SettingController::class, 'updateGeneralSetting'])->name('general.setting.update');
            Route::get('commission-setting', [SettingController::class, 'commissionSettings'])->name('commission.setting');
            Route::put('commission-setting', [SettingController::class, 'updateCommissionSetting'])->name('commission.setting.update');
            Route::get('/logo-setting', [SettingController::class, 'logoSetting'])->name('logo-setting.index');
            Route::put('/logo-setting/update', [SettingController::class, 'updateLogoSetting'])->name('logo-setting.update');
            Route::get('/smtp-setting', [SettingController::class, 'smtpSetting'])->name('smtp-setting.index');
            Route::put('/smtp-setting/update', [SettingController::class, 'updateSmtpSetting'])->name('smtp-setting.update');

            Route::get('wipe-database', [WipeDatabaseController::class, 'index'])->name('wipe-database.index');
            Route::delete('wipe-database', [WipeDatabaseController::class, 'destroy'])->name('wipe-database.destroy');
        });
    });
