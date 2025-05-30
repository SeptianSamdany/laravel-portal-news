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
        // Start query builder
        $articlesQuery = Article::with(['author', 'category', 'tags', 'comments'])
            ->where('status', 'published');
            // ->where('published_at', '<=', now());
        
        // Get featured articles (changed to get multiple featured articles)
        $featuredArticles = Article::with(['author', 'category'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->limit(5) // Limit to 5 featured articles, adjust as needed
            ->get();

        // Tambahkan ini:
        $editorPicks = Article::with(['author', 'category'])
            ->where('status', 'published')
            ->latest('published_at')
            ->take(5)
            ->get();

        $mainPick = $editorPicks->first();
        $sidePicks = $editorPicks->skip(1);
        
        // Paginate results
        $articles = $articlesQuery->paginate(9)->withQueryString();
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('articles.index', compact('articles', 'featuredArticles', 'categories', 'tags', 'editorPicks',
        'mainPick',
        'sidePicks'));
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
            ->take(3)
            ->get();
        
        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function trending(Request $request)
    {
        $trendingArticles = Article::with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('views_count', 'desc')
            ->paginate(9)
            ->withQueryString();

        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.trending', compact('trendingArticles', 'categories', 'tags'));
    }

    public function editorPicks()
    {
        $editorPicks = \App\Models\Article::with(['author', 'category'])
            ->where('status', 'published')
            ->where('is_editor_pick', true) // pastikan kolom ini ada
            ->latest('published_at')
            ->paginate(5);

        $mainPick = $editorPicks->first();
        $sidePicks = $editorPicks->skip(1)->values();

        return view('articles.editor-picks', compact('mainPick', 'sidePicks', 'editorPicks'));
    }
}