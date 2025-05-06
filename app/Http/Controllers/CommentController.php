<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    // public function store(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'article_id' => 'required|exists:articles,id',
    //         'content' => 'required|string|min:3|max:1000',
    //         'parent_id' => 'nullable|exists:comments,id'
    //     ]);
        
    //     // Check if article exists and is published
    //     $article = Article::where('id', $request->article_id)
    //         ->where('status', 'published')
    //         ->where('published_at', '<=', now())
    //         ->firstOrFail();
        
    //     // Determine if comment should be auto-approved based on user role
    //     $isApproved = false;
    //     if (auth()->user()->hasRole(['admin', 'editor'])) {
    //         $isApproved = true;
    //     }
        
    //     // Create the comment
    //     $comment = new Comment();
    //     $comment->article_id = $request->article_id;
    //     $comment->user_id = auth()->id();
    //     $comment->content = $request->content;
    //     $comment->parent_id = $request->parent_id;
    //     $comment->is_approved = $isApproved;
    //     $comment->save();
        
    //     // Redirect back to article with appropriate message
    //     $message = $isApproved 
    //         ? 'Your comment has been posted successfully!'
    //         : 'Your comment has been submitted and is awaiting approval.';
            
    //     return redirect()->back()->with('success', $message);
    // }
}