<?php

use App\Http\Controllers\POSController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pos', 'middleware' => ['auth']], function () {
    Route::any('/sales', [POSController::class, 'index'])->name('pos.sales');
    Route::any('/sale_data', [POSController::class, 'sale_data'])->name('pos.sale_data');
    Route::any('/make_sale', [POSController::class, 'create'])->name('pos.make_sale');
    Route::any('/search_product', [POSController::class, 'search_product'])->name('pos.search_product');
    Route::any('/store_sale', [POSController::class, 'store_sale'])->name('pos.store_sale');
    Route::any('/sale_receipt/{receipt_id}', [POSController::class, 'sale_receipt'])->name('pos.sale_receipt');
    Route::any('/delete', [POSController::class, 'destroy'])->name('pos.delete');
});
