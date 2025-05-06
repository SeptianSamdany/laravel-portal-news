<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // public function index(Request $request)
    // {
    //     // Get all authors
    //     $authors = User::where('is_active', true)->orderBy('name')->get();
        
    //     return view('authors.index', [
    //         'authors' => $authors
    //     ]);
    // }

    // public function show($id, Request $request)
    // {
    //     // Find the author by ID
    //     $author = User::findOrFail($id);
        
    //     // Get all categories and tags for filters
    //     $categories = Category::where('is_active', true)->orderBy('name')->get();
    //     $tags = Tag::orderBy('name')->get();
        
    //     // Get articles by this author
    //     $articlesQuery = $author->articles()
    //         ->with(['author', 'category', 'tags', 'comments'])
    //         ->where('status', 'published')
    //         ->where('published_at', '<=', now());
        
    //     // Apply category filter
    //     if ($request->has('category')) {
    //         $articlesQuery->whereHas('category', function($query) use ($request) {
    //             $query->where('slug', $request->category)
    //                   ->where('is_active', true);
    //         });
    //     }
        
    //     // Apply tag filter
    //     if ($request->has('tag')) {
    //         $articlesQuery->whereHas('tags', function($query) use ($request) {
    //             $query->where('slug', $request->tag);
    //         });
    //     }
        
    //     // Apply sorting
    //     switch ($request->get('sort', 'newest')) {
    //         case 'oldest':
    //             $articlesQuery->orderBy('published_at', 'asc');
    //             break;
    //         case 'popular':
    //             $articlesQuery->orderBy('views_count', 'desc');
    //             break;
    //         case 'newest':
    //         default:
    //             $articlesQuery->orderBy('published_at', 'desc');
    //             break;
    //     }
        
    //     // Paginate results
    //     $articles = $articlesQuery->paginate(9)->withQueryString();
        
    //     return view('authors.show', [
    //         'author' => $author,
    //         'articles' => $articles,
    //         'categories' => $categories,
    //         'tags' => $tags
    //     ]);
    // }
}