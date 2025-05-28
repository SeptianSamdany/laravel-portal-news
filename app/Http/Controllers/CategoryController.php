<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories and tags for filters
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        
        // Get all active categories
        $activeCategories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('categories.index', [
            'categories' => $activeCategories,
            'tags' => $tags
        ]);
    }
    
    public function show($slug, Request $request)
    {
        // Find the category by slug
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        // Get all categories and tags for filters
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        
        // Get articles in this category and its children
        $categoryIds = [$category->id];
        
        // Add child category IDs if they exist
        if ($category->children->count() > 0) {
            $categoryIds = array_merge($categoryIds, $category->children->pluck('id')->toArray());
        }
        
        // Build query for articles
        $articlesQuery = Article::with(['author', 'category', 'tags', 'comments'])
            ->whereIn('category_id', $categoryIds)
            ->where('status', 'published')
            ->where('published_at', '<=', now());
        
        // Apply tag filter
        if ($request->has('tag')) {
            $articlesQuery->whereHas('tags', function($query) use ($request) {
                $query->where('slug', $request->tag);
            });
        }
        
        // Apply sorting
        switch ($request->get('sort', 'newest')) {
            case 'oldest':
                $articlesQuery->orderBy('published_at', 'asc');
                break;
            case 'popular':
                $articlesQuery->orderBy('views_count', 'desc');
                break;
            case 'newest':
            default:
                $articlesQuery->orderBy('published_at', 'desc');
                break;
        }
        
        // Paginate results
        $articles = $articlesQuery->paginate(9)->withQueryString();
        
        return view('categories.show', [
            'category' => $category,
            'articles' => $articles,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
}