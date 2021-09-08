<?php

use App\Http\Controllers\{
    AuthorController,
    BookController,
    CategoryController,
    PublisherController,
    UserController,
    BookOrderController,
    LocaleController,
    HomeController,
};
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();


Route::get('/locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale');

Route::resource('user', UserController::class)->only(['index', 'show', 'edit', 'update']);
Route::resource('books', BookController::class)->only(['show']);
Route::resource('book_orders', BookOrderController::class);
Route::get('filter', [BookController::class, 'filter'])->name('books.filter');

Route::prefix('admin')->middleware(['admin.only'])->group(function() {
    Route::get('/home', [HomeController::class, 'adminIndex'])->name('admin.home');
    Route::middleware(['auth'])->group(function () {
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index')->middleware('auth');
        });
        Route::prefix('publishers')->group(function () {
            Route::get('/', [PublisherController::class, 'index'])->name('publishers.index')->middleware('auth');
        });
        Route::resource('books', BookController::class)->except(['destroy', 'show']);
        Route::resource('authors', AuthorController::class)->except(['destroy']);
        Route::resource('users', UserController::class)->except(['destroy']);

        Route::prefix('users')->group(function () {
            Route::get('/modify/{user}', [UserController::class, 'modify'])->name('users.modify');
        });
    });
});
