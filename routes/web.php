<?php
namespace App\Http\Middleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login',[UserController::class, 'index']);
Route::get('/register', function () {
    return view('register');
});


Route::get('/icon-menu', function () {
    return view('dashboard.icon-menu');
})->name('icon-menu')->middleware('auth');

Route::get('/sidebar-style-2', function () {
    return view('dashboard.sidebar-style-2');
})->name('sidebar-style-2')->middleware('auth');

Route::get('/starter-template', function () {
    return view('dashboard.starter-template');
})->name('starter-template')->middleware('auth');

Route::get('/widgets', function () {
    return view('dashboard.widgets');
})->name('widgets')->middleware('auth');



Route::resource('/products', ProductController::class);
Route::resource('/users', UserController::class);

Route::get('/users', [UserController::class,  'show'])->name('users.index')->middleware('auth');

Route::get('/admin', [UserController::class, 'adminUrl']);



// Trending products route
Route::get('/trending-products', function () {
    return view('dashboard.trending-products');
})->name('trending-products')->middleware('auth');

// Route::get('/edit-trending-products', function () {
//     return view('dashboard.edit-trending-products');
// })->name('edit-trending-products')->middleware('auth');

Route::controller(RedirectController::class,'index')->group( function () {
    Route::get('/products', [ProductController::class, 'index'])->name('dashboard.trending-products.index')->middleware('auth');
    Route::get('/products/create', [ProductController::class, 'create'])->name('dashboard.trending-products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('dashboard.trending-products.store');
    Route::put('/edit-products/{id}', [ProductController::class, 'edit'])->name('dashboard.edit-trending-product.edit');
    Route::put('/update-products/{id}', [ProductController::class, 'update'])->name('dashboard.edit-trending-products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('dashboard.trending-products.destroy');
});
 

