<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BrandController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

    Route::apiResource('brands', BrandController::class);
    Route::get('toplist', [BrandController::class, 'toplist']);
