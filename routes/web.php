<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
Route::get('/displayByCategory', [App\Http\Controllers\HomeController::class, 'displayByCategory'])->name('displayByCategory.info');
Route::get('/tradyProducts', [App\Http\Controllers\HomeController::class, 'tradyProducts'])->name('tradyProducts.info');
Route::get('/latestProducts', [App\Http\Controllers\HomeController::class, 'latestProducts'])->name('latestProducts.info');
Route::get('/product_details/{product_id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product_details.info');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    require_once('user_routes.php');

    require_once('catalogue_routes.php');

    require_once('product_routes.php');

    require_once('pos_routes.php');

    require_once('report_routes.php');

    require_once('setting_routes.php');
});
