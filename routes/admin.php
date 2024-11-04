<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:superadmin'])->group(function () {
    Route::get('/dashboard', 'DashboardController@superadmin')->name('superadmin.dashboard');

    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('/create', 'CategoryController@create')->name('category.create');
        Route::post('/', 'CategoryController@store')->name('category.store');
        Route::get('/{category}/edit', 'CategoryController@edit')->name('category.edit');
        Route::put('/{category}', 'CategoryController@update')->name('category.update');
        Route::delete('/{category}', 'CategoryController@destroy')->name('category.destroy');
    });

    Route::prefix('merk')->group(function () {
        Route::get('/', 'MerkController@index')->name('merk.index');
        Route::get('/create', 'MerkController@create')->name('merk.create');
        Route::post('/', 'MerkController@store')->name('merk.store');
        Route::get('/{merk}/edit', 'MerkController@edit')->name('merk.edit');
        Route::put('/{merk}', 'MerkController@update')->name('merk.update');
        Route::delete('/{merk}', 'MerkController@destroy')->name('merk.destroy');
    });

    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::post('/', 'ProductController@store')->name('product.store');
        Route::get('/{product}/edit', 'ProductController@edit')->name('product.edit');
        Route::put('/{product}', 'ProductController@update')->name('product.update');
        Route::delete('/{product}', 'ProductController@destroy')->name('product.destroy');
        Route::post('/toggle-product-status/{id}', 'ProductController@toggleStatus')->name('toggle.product.status');
    });

    Route::prefix('transaction')->group(function () {
        Route::get('/', 'TransactionController@index')->name('transaction.index');
        // Route::get('/{id}', 'TransactionController@show')->name('transaction.show');
        Route::get('/create', 'TransactionController@create')->name('transaction.create');
        Route::post('/', 'TransactionController@store')->name('transaction.store');
    });
});
