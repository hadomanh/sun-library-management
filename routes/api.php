<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('categories')->group(function () {
    Route::post('/', [CategoryController::class, 'create'])->name('api.categories.create');
    Route::delete('/{id}', [CategoryController::class, 'delete'])->name('api.categories.delete');
});

Route::prefix('publishers')->group(function () {
    Route::post('/', [PublisherController::class, 'create'])->name('api.publishers.create');
    Route::delete('/{id}', [PublisherController::class, 'delete'])->name('api.publishers.delete');
});

Route::prefix('books')->group(function () {
    Route::delete('/{id}', [BookController::class, 'destroy'])->name('api.books.destroy');
});

Route::prefix('authors')->group(function () {
    Route::delete('/{id}', [AuthorController::class, 'destroy'])->name('api.authors.destroy');
});

