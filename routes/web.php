<?php

use App\Http\Controllers\AuthorController;
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
    return view('home');
})->name('index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale');

Route::prefix('admin')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'adminIndex'])->name('admin.home');
    Route::middleware(['auth'])->group(function () {
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
        });
        Route::prefix('publishers')->group(function () {
            Route::get('/', [PublisherController::class, 'index'])->name('publishers.index')->middleware('auth');
        });
        Route::resource('books', BookController::class)->except(['destroy']);
        Route::resource('authors', AuthorController::class)->except(['destroy']);
    });
});
