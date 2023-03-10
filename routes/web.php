<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/search-history', 'SearchHistoryController@index')->name('search-history.index');
Route::get('/search-history/{searchHistory}', 'SearchHistoryController@show')->name('search-history.show');
