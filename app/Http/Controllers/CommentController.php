<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = new Comment();
        $comment->article_id = $request->input('article_id');
        $comment->user_id = Auth::id();
        $comment->content = $request->input('content');
        $comment->parent_id = $request->input('parent_id');
        $comment->save();

        return redirect()->route('articles.show', $comment->article->slug)->with('success', 'Comment posted!');
    }
}