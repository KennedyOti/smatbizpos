<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'product', 'middleware' => ['auth']], function () {
    Route::any('/', [ProductController::class, 'index'])->name('product.info');
    Route::any('/add_product', [ProductController::class, 'create'])->name('product.add_product');
    Route::any('/product_data', [ProductController::class, 'data'])->name('product.product_data');
    Route::any('/get_category_subcategories', [ProductController::class, 'getCategorySubCategories'])->name('product.get_category_subcategories');
    Route::any('/store', [ProductController::class, 'store'])->name('product.store');
    Route::any('/update', [ProductController::class, 'update'])->name('product.update');
    Route::any('/manage/{product_id}', [ProductController::class, 'show'])->name('product.manage');
    Route::any('/edit_product/{product_id}', [ProductController::class, 'edit'])->name('product.edit_product');
    Route::any('/delete', [ProductController::class, 'destroy'])->name('product.delete');
});
