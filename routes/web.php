<?php
use  App\Http\Middleware\Authenticate;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login',[UserController::class,'index']);
Route::get('/register', function () {
    return view('register');
});


Route::resource('/products', ProductController::class);
Route::resource('/users', UserController::class);
// Route::get(UserController::class, 'show');//working
Route::get('/dashboards', [UserController::class, 'show'])->middleware('auth');



