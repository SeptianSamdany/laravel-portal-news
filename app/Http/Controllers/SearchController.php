<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $articles = Article::with(['author', 'category'])
            ->where('status', 'published')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->orderBy('published_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('search.index', [
            'articles' => $articles,
            'query' => $query,
        ]);
    }
}