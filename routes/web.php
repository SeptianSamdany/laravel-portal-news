<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/advertisement', function () {
    return view('pages.advertisement');
})->name('advertisement');

// Article routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/trending', [ArticleController::class, 'trending'])->name('articles.trending');
Route::get('/articles/editor-picks', [ArticleController::class, 'editor-picks'])->name('articles.editor-picks');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show'); 

// // Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show'); 

// Tag routes
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.show');

// Author routes
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/apply', function () {
    return view('authors.apply');
})->name('authors.apply');
Route::post('/authors/apply', [AuthorController::class, 'apply'])->name('authors.apply.submit');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

// Search functionality
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');

// Comments
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

// Authentication routes
Route::get('/dashboard', function () {
    // Jika user role 'user', redirect ke halaman lain (misal: home)
    if (Auth::user()->hasRole('user')) {
        return redirect('/')->with('error', 'You are not authorized to access the dashboard.');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
    // Admin routes for articles, categories, tags, etc. could be added here
});

Route::fallback(function () {
    return view('errors.404');
}); 

require __DIR__.'/auth.php';