<?php

use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Personal\Main\IndexController as PersonalIndexController;
use App\Http\Controllers\Personal\Liked\IndexController as LikedIndexController;
use App\Http\Controllers\Personal\Liked\DeleteController as LikedDeleteController;
use App\Http\Controllers\Personal\Comment\IndexController as CommentIndexController;
use App\Http\Controllers\Personal\Comment\EditController as CommentEditController;
use App\Http\Controllers\Personal\Comment\UpdateController as CommentUpdateController;
use App\Http\Controllers\Personal\Comment\DeleteController as CommentDeleteController;
use App\Http\Controllers\Admin\Main\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\Post\IndexController as PostIndexController;
use App\Http\Controllers\Post\IndexController as PostBlogIndexController;
use App\Http\Controllers\Admin\Post\CreateController as PostCreateController;
use App\Http\Controllers\Admin\Post\StoreController as PostStoreController;
use App\Http\Controllers\Admin\Post\ShowController as PostShowController;
use App\Http\Controllers\Post\ShowController as PostBlogShowController;
use App\Http\Controllers\Admin\Post\EditController as PostEditController;
use App\Http\Controllers\Admin\Post\UpdateController as PostUpdateController;
use App\Http\Controllers\Admin\Post\DeleteController as PostDeleteController;
use App\Http\Controllers\Admin\Category\IndexController as CategoryIndexController;
use App\Http\Controllers\Admin\Category\CreateController as CategoryCreateController;
use App\Http\Controllers\Admin\Category\StoreController as CategoryStoreController;
use App\Http\Controllers\Admin\Category\ShowController as CategoryShowController;
use App\Http\Controllers\Admin\Category\EditController as CategoryEditController;
use App\Http\Controllers\Admin\Category\UpdateController as CategoryUpdateController;
use App\Http\Controllers\Admin\Category\DeleteController as CategoryDeleteController;
use App\Http\Controllers\Admin\Tag\IndexController as TagIndexController;
use App\Http\Controllers\Admin\Tag\CreateController as TagCreateController;
use App\Http\Controllers\Admin\Tag\StoreController as TagStoreController;
use App\Http\Controllers\Admin\Tag\ShowController as TagShowController;
use App\Http\Controllers\Admin\Tag\EditController as TagEditController;
use App\Http\Controllers\Admin\Tag\UpdateController as TagUpdateController;
use App\Http\Controllers\Admin\Tag\DeleteController as TagDeleteController;
use App\Http\Controllers\Admin\User\IndexController as UserIndexController;
use App\Http\Controllers\Admin\User\CreateController as UserCreateController;
use App\Http\Controllers\Admin\User\StoreController as UserStoreController;
use App\Http\Controllers\Admin\User\ShowController as UserShowController;
use App\Http\Controllers\Admin\User\EditController as UserEditController;
use App\Http\Controllers\Admin\User\UpdateController as UserUpdateController;
use App\Http\Controllers\Admin\User\DeleteController as UserDeleteController;
use App\Http\Controllers\Post\Comment\StoreController as PostCommentStoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('main.index');

Route::prefix('posts')->group(function () {
    Route::get('/', PostBlogIndexController::class)->name('post.index');
    Route::get('/{post}', PostBlogShowController::class)->name('post.show');

    Route::prefix('{post}/comments')->group(function () {
        Route::post('/', PostCommentStoreController::class)->name('post.comment.store');
    });
});

Route::prefix('personal')->middleware(['auth', 'verified'])->group(function () {
    Route::prefix('main')->group(function () {
        Route::get('/', PersonalIndexController::class)->name('personal.main.index');
    });
    Route::prefix('liked')->group(function () {
        Route::get('/', LikedIndexController::class)->name('personal.liked.index');
        Route::delete('/{post}', LikedDeleteController::class)->name('personal.liked.delete');
    });
    Route::prefix('comments')->group(function () {
        Route::get('/', CommentIndexController::class)->name('personal.comment.index');
        Route::get('/{comment}/edit', CommentEditController::class)->name('personal.comment.edit');
        Route::patch('/{comment}', CommentUpdateController::class)->name('personal.comment.update');
        Route::delete('/{comment}', CommentDeleteController::class)->name('personal.comment.delete');
    });
});

Route::prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/', AdminIndexController::class)->name('admin.main.index');

    Route::prefix('posts')->group(function () {
        Route::get('/', PostIndexController::class)->name('admin.post.index');
        Route::get('/create', PostCreateController::class)->name('admin.post.create');
        Route::post('/', PostStoreController::class)->name('admin.post.store');
        Route::get('/{post}', PostShowController::class)->name('admin.post.show');
        Route::get('/{post}/edit', PostEditController::class)->name('admin.post.edit');
        Route::patch('/{post}', PostUpdateController::class)->name('admin.post.update');
        Route::delete('/{post}', PostDeleteController::class)->name('admin.post.delete');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', CategoryIndexController::class)->name('admin.category.index');
        Route::get('/create', CategoryCreateController::class)->name('admin.category.create');
        Route::post('/', CategoryStoreController::class)->name('admin.category.store');
        Route::get('/{category}', CategoryShowController::class)->name('admin.category.show');
        Route::get('/{category}/edit', CategoryEditController::class)->name('admin.category.edit');
        Route::patch('/{category}', CategoryUpdateController::class)->name('admin.category.update');
        Route::delete('/{category}', CategoryDeleteController::class)->name('admin.category.delete');
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', TagIndexController::class)->name('admin.tag.index');
        Route::get('/create', TagCreateController::class)->name('admin.tag.create');
        Route::post('/', TagStoreController::class)->name('admin.tag.store');
        Route::get('/{tag}', TagShowController::class)->name('admin.tag.show');
        Route::get('/{tag}/edit', TagEditController::class)->name('admin.tag.edit');
        Route::patch('/{tag}', TagUpdateController::class)->name('admin.tag.update');
        Route::delete('/{tag}', TagDeleteController::class)->name('admin.tag.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UserIndexController::class)->name('admin.user.index');
        Route::get('/create', UserCreateController::class)->name('admin.user.create');
        Route::post('/', UserStoreController::class)->name('admin.user.store');
        Route::get('/{user}', UserShowController::class)->name('admin.user.show');
        Route::get('/{user}/edit', UserEditController::class)->name('admin.user.edit');
        Route::patch('/{user}', UserUpdateController::class)->name('admin.user.update');
        Route::delete('/{user}', UserDeleteController::class)->name('admin.user.delete');
    });
});

Auth::routes(['verify' => true]);
