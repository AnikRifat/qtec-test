<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchHistoryController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/search-history', [SearchHistoryController::class, 'index'])->name('search-history.index')->middleware('auth');
Route::get('/search-history/{searchHistory}', [SearchHistoryController::class, 'show'])->name('search-history.show')->middleware('auth');
// Route::get('/search', 'SearchController@index');
Route::post('/search', [SearchController::class, 'store'])->middleware('auth');
Route::get('/', [SearchController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
