<?php

use Illuminate\Support\Facades\Route;

Route::get('/tour/showAll', [\App\Http\Controllers\TourActivitesController::class, 'showAll']);
Route::get('/tour/getById/{id}', [\App\Http\Controllers\TourActivitesController::class, 'getById']); //done

Route::get('/blog/showAll', [\App\Http\Controllers\BlogController::class, 'showAll']); // done
Route::get('/blog/get/{id}', [\App\Http\Controllers\BlogController::class, 'getById']); //done
Route::get('/blog/search', [\App\Http\Controllers\BlogController::class, 'search']); //done
Route::post('/blog/create', [\App\Http\Controllers\BlogController::class, 'create']); //done
Route::put('/blog/update/{id}', [\App\Http\Controllers\BlogController::class, 'update']); //done
Route::delete('/blog/delete/{id}', [\App\Http\Controllers\BlogController::class, 'delete']); //done

Route::post('/voucher/create', [\App\Http\Controllers\VoucherController::class, 'create']); //done
Route::put('/voucher/update/{id}', [\App\Http\Controllers\VoucherController::class, 'update']); //done
Route::delete('/voucher/delete/{id}', [\App\Http\Controllers\VoucherController::class, 'delete']);
Route::get('/product/show', [\App\Http\Controllers\ProductController::class, 'showAll']);
Route::post('/booking/create', [\App\Http\Controllers\VoucherController::class, 'store']);
Route::get('/product', [\App\Http\Controllers\ProductController::class, 'filterByAdvance']);