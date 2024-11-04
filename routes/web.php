<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@home')->name('home');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/products/{id}/show', 'HomeController@show')->name('products.show');
Route::get('/products', 'HomeController@allProducts')->name('products');
Route::get('/merk/{id}/products', 'HomeController@showProductsByMerk')->name('merk.products');
Route::get('/category/{id}/products', 'HomeController@showProductsByCategory')->name('category.products');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


// Route::middleware(['auth', 'verified', 'role:kasir'])->prefix('kasir')->group(function () {
//     Route::get('/dashboard', 'DashboardController@kasir')->name('kasir.dashboard');
// });

require __DIR__ . '/auth.php';
