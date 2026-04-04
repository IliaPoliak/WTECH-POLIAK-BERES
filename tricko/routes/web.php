<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('index');
});

Route::get('/search_results', function () {
    return view('search_results');
});

Route::get('/product_detail', function () {
    return view('product_detail');
});

// AUTH
Route::middleware('guest')->group(function () {
    Route::get('/auth/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/auth/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/auth/login', [LoginController::class, 'login'])->name('login');
});

Route::post('/auth/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


// CATEGORY PAGES
Route::get('/category_pages/category(Ciapky)', function () {
    return view('category_pages/category(Ciapky)');
});

Route::get('/category_pages/category(Mikiny)', function () {
    return view('category_pages/category(Mikiny)');
});

Route::get('/category_pages/category(Tricka)', function () {
    return view('category_pages/category(Tricka)');
});

// BASKET
Route::get('/basket', function () {
    return view('basket/basket');
});

Route::get('/basket/basket_delivery_and_payment', function () {
    return view('basket/basket_delivery_and_payment');
});

Route::get('/basket/basket_address', function () {
    return view('basket/basket_address');
});

Route::get('/basket/basket_payment_details', function () {
    return view('basket/basket_payment_details');
});

Route::get('/basket/basket_thank_you', function () {
    return view('basket/basket_thank_you');
});
