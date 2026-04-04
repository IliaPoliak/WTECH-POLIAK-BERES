<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/auth/login', function () {
    return view('auth/login');
});

Route::get('/auth/register', function () {
    return view('auth/register');
});

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
