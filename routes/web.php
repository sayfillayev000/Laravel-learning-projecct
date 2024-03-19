<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'main'])->name('main');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/services', [PageController::class, 'services'])->name('services');

Route::get('/projects', [PageController::class, 'projects'])->name('projects')->middleware('throttle:5');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('register', [AuthController::class, 'register'])->name('register');

Route::post('register', [AuthController::class, 'register_store'])->name('register.store');

Route::middleware('auth')->group(function () {

    Route::get('notifications/allRead', [NotificationController::class, 'allRead'])->name('notifications.allRead');
    Route::get('notifications/{notification}/read', [NotificationController::class, 'read'])->name('notifications.read');
});

Route::get('language/{locale}', [LanguageController::class, 'changeLocale'])->name('locale.change');

Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
    'notifications' => NotificationController::class,
]);

 
















// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');

// Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

// Route::put('/posts/{post}/edit', [PostController::class, 'update'])->name('posts.update');

// Route::delete('/posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete');
