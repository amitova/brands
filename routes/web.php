<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsListController;

Route::get('/', [BrandsListController::class, 'index'])->name('home');
