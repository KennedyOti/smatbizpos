<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'setting', 'middleware' => ['auth']], function () {
    Route::any('/supplier', [SettingController::class, 'supplier'])->name('setting.supplier');
    Route::any('/slide', [SettingController::class, 'slide'])->name('setting.slide');
});
