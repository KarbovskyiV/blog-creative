<?php

use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Admin\Main\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\Category\IndexController as CategoryIndexController;
use App\Http\Controllers\Admin\Category\CreateController as CategoryCreateController;
use App\Http\Controllers\Admin\Category\StoreController as CategoryStoreController;
use App\Http\Controllers\Admin\Category\ShowController as CategoryShowController;
use App\Http\Controllers\Admin\Category\EditController as CategoryEditController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class);

Route::prefix('admin')->group(function () {
    Route::get('/', AdminIndexController::class);

    Route::prefix('categories')->group(function () {
        Route::get('/', CategoryIndexController::class)->name('admin.category.index');
        Route::get('/create', CategoryCreateController::class)->name('admin.category.create');
        Route::post('/', CategoryStoreController::class)->name('admin.category.store');
        Route::get('/{category}', CategoryShowController::class)->name('admin.category.show');
        Route::get('/{category}/edit', CategoryEditController::class)->name('admin.category.edit');
    });
});

Auth::routes();
