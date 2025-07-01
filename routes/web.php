<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsListController;
use App\Http\Controllers\Api\BrandController;

Route::get('/', [BrandsListController::class, 'index'])->name('home');

Route::prefix('api')->group(function () {
    Route::apiResource('brands', BrandController::class);
    Route::get('toplist', [BrandController::class, 'toplist']);
});
