<?php

use App\Http\Controllers\CatalogueController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'catalogue', 'middleware' => ['auth']], function () {
    Route::any('/', [CatalogueController::class, 'index'])->name('catalogue.info');
    Route::any('/catalogue_data', [CatalogueController::class, 'data'])->name('catalogue.catalogue_data');
    Route::any('/store_catalogue', [CatalogueController::class, 'store'])->name('catalogue.store_catalogue');
    Route::any('/update_catalogue', [CatalogueController::class, 'update'])->name('catalogue.update_catalogue');
    Route::any('/catalogue_delete', [CatalogueController::class, 'destroy'])->name('catalogue.catalogue_delete');
    Route::any('/sub_category_delete/{category_id}', [CatalogueController::class, 'destroy_sub_category'])->name('catalogue.sub_category_delete');
    Route::any('/manage/{category_id}', [CatalogueController::class, 'manage'])->name('catalogue.manage');
    Route::any('/store_sub_category', [CatalogueController::class, 'addSubCategory'])->name('catalogue.store_sub_category');
    Route::any('/getSubCategories/{category_id}', [CatalogueController::class, 'getSubCategories'])->name('catalogue.getSubCategories');
});
