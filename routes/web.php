<?php

use App\Http\Controllers\Frontend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Frontend\KycVerificationController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');

//                          ---Product---
Route::get('products', [ProductController::class, 'index'])->name('products');
Route::get('product-details/{slug}', [ProductController::class, 'show'])->name('product.details');
Route::get('/stream/preview/{id}', [ProductController::class, 'streamPreview'])->name('items.stream');


Route::group(['middleware' => 'auth', 'verified'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');


    //  Kyc verification
    Route::get('kyc-verification', [KycVerificationController::class, 'index'])->name('kyc.verification')->middleware('checkKyc');
    Route::post('kyc-verification', [KycVerificationController::class, 'store'])->name('kyc.verification.store')->middleware('checkKyc');


    Route::group(['middleware' => 'is_author'], function () {
        Route::get('items', [ItemController::class, 'index'])->name('items.index');
    });
    Route::group([
        'middleware' => ['auth', 'verified'],
        'prefix' => 'user',
        'as' => 'user.'
    ], function () {
        Route::group(['middleware' => 'is_author'], function () {
            Route::get('items', [ItemController::class, 'index'])->name('items.index');
            Route::get('items/create', [ItemController::class, 'create'])->name('items.create');
            Route::post('items/uploads', [ItemController::class, 'itemUploads'])->name('items.uploads');
            Route::delete('item-destroy/{id}', [ItemController::class, 'delete'])->name('item.destroy');
            Route::post('item/store', [ItemController::class, 'store'])->name('items.store');
            Route::get('item/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
            Route::put('item/update/{id}', [ItemController::class, 'update'])->name('items.update');
            Route::delete('item/delete/{id}', [ItemController::class, 'delete'])->name('items.destroy');
            Route::get('item/{id}/download', [ItemController::class, 'download'])->name('items.download');
            Route::any('item/{id}/changelog', [ItemController::class, 'changelog'])->name('item.changelog');
            Route::get('item/{id}/history', [ItemController::class, 'history'])->name('item.history');
        });
    });
});




require __DIR__ . '/auth.php';
