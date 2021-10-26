<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/', 'HomeController@index')->name('home[post]');
Route::post('/generate-invoice', 'HomeController@geterateInvoices')->name('generateinvoice');
Route::get('/products', 'ProductController@index')->name('product');
Route::post('/get-products-by-category', 'ProductController@getProductsByCategory')->name('productsbycategory');
Route::get('/category', 'CategoryController@index')->name('category');
