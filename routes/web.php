<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocaleController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale');
Route::prefix('admin')->group(function() {
    Route::middleware(['auth'])->group(function () {
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware('auth');
        });
        Route::prefix('publisher')->group(function () {
            Route::get('/', [PublisherController::class, 'index'])->name('publisher.index')->middleware('auth');
        });
        Route::resource('book', BookController::class)->except(['destroy']);
    });
});
