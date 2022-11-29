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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/','\App\Http\Controllers\Homecontroller@index')->name('front');


Route::get('doctors/listing','\App\Http\Controllers\DoctorsController@ajaxlisting')->name('doctors.ajaxlisting');

Route::resource('doctors','\App\Http\Controllers\DoctorsController');

Route::get('product/listing','\App\Http\Controllers\ProductController@ajaxlisting')->name('product.ajaxlisting');

Route::resource('product','\App\Http\Controllers\ProductController');
