<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [ArticleController::class, 'index'])->name('home');

// Article routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('article.show'); 

// // Category routes
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('category.show'); 

// // Tag routes
// Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.show');

// // Author routes
// Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
// Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

// Search functionality
Route::get('/search', [SearchController::class, 'index'])->name('search'); 

// // Newsletter subscription
// Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// // Comments
// Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

// Authentication routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin routes for articles, categories, tags, etc. could be added here
});

Route::fallback(function () {
    return view('errors.404');
}); 

require __DIR__.'/auth.php';