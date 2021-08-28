<?php

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

Route::prefix('category')->group(function () {
    Route::post('/', [CategoryController::class, 'create'])->name('api.category.create');
    Route::delete('/{id}', [CategoryController::class, 'delete'])->name('api.category.delete');
});

Route::prefix('publisher')->group(function () {
    Route::post('/', [PublisherController::class, 'create'])->name('api.publisher.create');
    Route::delete('/{id}', [PublisherController::class, 'delete'])->name('api.publisher.delete');
});

