<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Inertia\CurrentUserController;

Route::prefix('admin')->group(function () {
    Route::resources([
        'posts' => PostController::class,
        'categories' => CategoryController::class,
        'comments' => CommentController::class,
    ]);
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->prefix('admin')->group(function () {
//     Route::resources([
//         'posts' => PostController::class,
//         'categories' => CategoryController::class,
//         'comments' => CommentController::class,
//     ]);
// });
