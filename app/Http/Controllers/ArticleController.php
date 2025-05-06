<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        // Get all categories and tags for filters
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        
        // Start query builder
        $articlesQuery = Article::with(['author', 'category', 'tags', 'comments'])
            ->where('status', 'published')
            ->where('published_at', '<=', now());
        
        // Apply category filter
        if ($request->has('category')) {
            $articlesQuery->whereHas('category', function($query) use ($request) {
                $query->where('slug', $request->category)
                      ->where('is_active', true);
            });
        }
        
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
        
        // Get featured article
        $featuredArticle = Article::with(['author', 'category'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->first();
        
        // Paginate results
        $articles = $articlesQuery->paginate(9)->withQueryString();
        
        return view('articles.index', compact('articles', 'categories', 'tags', 'featuredArticle'));
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        // Find the article by slug
        $article = Article::with(['author', 'category', 'tags', 'comments.user', 'comments.replies.user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->firstOrFail();
        
        // Increment view count
        $article->increment('views_count');
        
        // Get related articles (same category or tags, excluding current)
        $relatedArticles = Article::with(['author', 'category'])
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->where(function ($query) use ($article) {
                $query->where('category_id', $article->category_id)
                    ->orWhereHas('tags', function ($query) use ($article) {
                        $query->whereIn('tags.id', $article->tags->pluck('id'));
                    });
            })
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();
        
        return view('articles.show', compact('article', 'relatedArticles'));
    }
}