<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredArticles = Article::where('is_featured', true)
                                ->where('status', 'published')
                                ->with(['author', 'category'])
                                ->latest('published_at')
                                ->take(5)
                                ->get();

        $breakingNews = Article::where('is_breaking', true)
                               ->where('status', 'published')
                               ->with(['author', 'category'])
                               ->latest('published_at')
                               ->take(3)
                               ->get();

        $latestArticles = Article::where('status', 'published')                                ->with(['author', 'category'])
                                ->latest('published_at')
                                ->take(8)
                                ->get();

        $trendingArticles = Article::where('status', 'published')
                                ->with(['author'])
                                ->orderBy('views_count', 'desc')
                                ->take(5)
                                ->get();

        $categoriesWithArticles = Category::with(['articles' => function($query) {
                                        $query->where('status', 'published')
                                                ->with(['author'])
                                                ->latest('published_at')
                                                ->take(3);
                                    }])
                                    ->whereHas('articles')
                                    ->take(4)
                                    ->get();

        $categories = Category::withCount('articles')
                            ->orderBy('articles_count', 'desc')
                            ->get();

        return view('home', compact(
            'featuredArticles',
            'breakingNews', 
            'latestArticles',
            'trendingArticles',
            'categoriesWithArticles',
            'categories'
        ));
    }
}
