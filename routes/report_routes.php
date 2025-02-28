<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'report', 'middleware' => ['auth']], function () {
    Route::any('/sales', [App\Http\Controllers\ReportController::class, 'sales'])->name('report.sales');
    Route::any('/sales_data', [App\Http\Controllers\ReportController::class, 'sales_data'])->name('report.sales_data');
    Route::any('/sales_arithmetics', [App\Http\Controllers\ReportController::class, 'sales_arithmetics'])->name('report.sales_arithmetics');
    Route::any('/sales_details/{sale_id}', [App\Http\Controllers\ReportController::class, 'sales_details'])->name('report.sales_details');
    Route::any('/sales_details_data', [App\Http\Controllers\ReportController::class, 'sales_details_data'])->name('report.sales_details_data');
    Route::any('/sales_details_arithmetics', [App\Http\Controllers\ReportController::class, 'sales_details_arithmetics'])->name('report.sales_details_arithmetics');
    Route::any('/stock', [App\Http\Controllers\ReportController::class, 'stock'])->name('report.stock');
});
