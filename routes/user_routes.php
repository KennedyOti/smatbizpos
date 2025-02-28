<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {

    Route::any('/', [App\Http\Controllers\UserController::class, 'index'])->name('users.info');
    Route::any('/users_data', [App\Http\Controllers\UserController::class, 'users_data'])->name('users.users_data');
    Route::any('/user_management/{id}', [App\Http\Controllers\UserController::class, 'user_management'])->name('users.user_management');
    Route::any('/user_update', [App\Http\Controllers\UserController::class, 'user_update'])->name('users.user_update');
    Route::any('/category_management', [App\Http\Controllers\UserController::class, 'category_management'])->name('users.category_management');
});
