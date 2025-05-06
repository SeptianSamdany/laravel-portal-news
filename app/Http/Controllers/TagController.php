<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class TagController extends Controller
{
    
    // public function show($slug, Request $request)
    // {
    //     // Find the tag by slug
    //     $tag = Tag::where('slug', $slug)->firstOrFail();
        
    //     // Get all categories and tags for filters
    //     $categories = Category::where('is_active', true)->orderBy('name')->get();
    //     $tags = Tag::orderBy('name')->get();
        
    //     // Get articles with this tag
    //     $articlesQuery = $tag->articles()
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
        
    //     return view('tags.show', [
    //         'tag' => $tag,
    //         'articles' => $articles,
    //         'categories' => $categories,
    //         'tags' => $tags
    //     ]);
    // }
}