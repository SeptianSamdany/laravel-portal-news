<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = \App\Models\User::whereHas('roles', function($q) {
                $q->whereIn('name', ['author', 'writer', 'super_admin']);
            })
            ->where('is_active', true)
            ->with(['articles' => function($query) {
                $query->where('status', 'published');
            }])
            ->paginate(12);

        return view('authors.index', compact('authors'));
    }

    public function show($id, Request $request)
    {
        // Find the author by ID
        $author = User::findOrFail($id);

        // Hanya tampilkan jika author punya role yang diizinkan
        if (!$author->hasAnyRole(['author', 'writer', 'super_admin'])) {
            abort(404); // Atau bisa redirect dengan pesan error
        }

        // Get all categories and tags for filters
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        // Get articles by this author
        $articlesQuery = $author->articles()
            ->with(['author', 'category', 'tags', 'comments'])
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

        // Paginate results
        $articles = $articlesQuery->paginate(9)->withQueryString();

        return view('authors.show', [
            'author' => $author,
            'articles' => $articles,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function apply(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:author_applications,email',
            'bio' => 'nullable|string|max:500',
            'portfolio' => 'nullable|url|max:255',
        ]);

        DB::table('author_applications')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
            'portfolio' => $request->portfolio,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('authors.apply')->with('success', 'Application submitted successfully. We will contact you soon!');
    }
}