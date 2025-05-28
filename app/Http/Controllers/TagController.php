<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of tags with their articles count and latest articles
     */
    public function index(Request $request)
    {
        // Get sort parameter from request (default: popular)
        $sort = $request->get('sort', 'popular');
        
        // Base query with published articles count and latest articles
        $tagsQuery = Tag::withCount(['articles' => function($query) {
            $query->where('status', 'published');
        }])
        ->with(['articles' => function($query) {
            $query->with('author')
                  ->where('status', 'published')
                  ->latest('published_at')
                  ->take(3);
        }]);
        
        // Apply sorting
        switch ($sort) {
            case 'alphabetical':
                $tagsQuery->orderBy('name', 'asc');
                break;
            case 'recent':
                $tagsQuery->orderBy('created_at', 'desc');
                break;
            case 'popular':
            default:
                $tagsQuery->orderBy('articles_count', 'desc');
                break;
        }
        
        $tags = $tagsQuery->get();
        
        // Get popular categories for cross-reference
        $popularCategories = Category::withCount(['articles' => function($query) {
            $query->where('status', 'published');
        }])
        ->having('articles_count', '>', 0)
        ->orderBy('articles_count', 'desc')
        ->take(10)
        ->get();
        
        return view('tags.index', compact('tags', 'popularCategories', 'sort'));
    }

    /**
     * Display articles for a specific tag
     */
    public function show(Request $request, $slug)
    {
        // Find tag by slug
        $tag = Tag::where('slug', $slug)->firstOrFail();
        
        // Get articles with pagination
        $articlesQuery = $tag->articles()
            ->with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->latest('published_at');
            
        $articles = $articlesQuery->paginate(12);
        
        // Get related tags (tags that appear with this tag)
        $relatedTags = Tag::whereHas('articles', function($query) use ($tag) {
            $query->whereHas('tags', function($subQuery) use ($tag) {
                $subQuery->where('tags.id', $tag->id);
            })
            ->where('status', 'published');
        })
        ->where('id', '!=', $tag->id)
        ->withCount(['articles' => function($query) {
            $query->where('status', 'published');
        }])
        ->orderBy('articles_count', 'desc')
        ->take(10)
        ->get();
        
        return view('tags.show', compact('tag', 'articles', 'relatedTags'));
    }
}