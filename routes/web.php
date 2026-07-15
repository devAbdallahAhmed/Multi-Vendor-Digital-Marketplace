<?php

use App\Http\Controllers\Frontend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Frontend\KycVerificationController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartItemController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PaymentController;


Route::get('/', [HomeController::class, 'index'])->name('home');

//                           ---Product---
Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('product-details/{slug}', [ProductController::class, 'show'])->name('product.details');
Route::get('/stream/preview/{id}', [ProductController::class, 'streamPreview'])->name('items.stream');

Route::post('add-cart/{id}', [CartItemController::class, 'store'])->name('cart.store');


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::get('cart', [CartItemController::class, 'index'])->name('cart.index');
    Route::delete('delete-cart/{id}', [CartItemController::class, 'destroy'])->name('cart.delete');
    // checkout
    Route::get('checkout', CheckoutController::class)->name('checkout');
    // Payment Route
    Route::get('payment/paypal',[PaymentController::class,'payWithPaypal'])->name('payment.paypal');
    Route::get('payment/paypal/success', [PaymentController::class, 'paypalSuccess'])->name('payment.paypal.success');
    Route::get('payment/paypal/error', [PaymentController::class, 'paypalError'])->name('payment.paypal.error');


    //
    Route::get('kyc-verification', [KycVerificationController::class, 'index'])->name('kyc.verification')->middleware('checkKyc');
    Route::post('kyc-verification', [KycVerificationController::class, 'store'])->name('kyc.verification.store')->middleware('checkKyc');


    Route::group([
        'middleware' => 'is_author',
        'prefix' => 'user',
        'as' => 'user.'
    ], function () {
        Route::get('items', [ItemController::class, 'index'])->name('items.index');
        Route::get('items/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('items/uploads', [ItemController::class, 'itemUploads'])->name('items.uploads');
        Route::post('item/store', [ItemController::class, 'store'])->name('items.store');
        Route::get('item/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('item/update/{id}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('item/delete/{id}', [ItemController::class, 'delete'])->name('items.destroy');
        Route::get('item/{id}/download', [ItemController::class, 'download'])->name('items.download');
        Route::any('item/{id}/changelog', [ItemController::class, 'changelog'])->name('item.changelog');
        Route::get('item/{id}/history', [ItemController::class, 'history'])->name('item.history');
    });
});

require __DIR__ . '/auth.php';
