@extends('layouts.standard')

@section('title', $article->title . ' - Your Blog')
@section('meta_description', $article->meta_description ?? $article->excerpt)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumbs -->
        <div class="flex items-center text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('categories.show', $article->category->slug) }}" class="hover:text-indigo-600">{{ $article->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700">{{ $article->title }}</span>
        </div>
        
        <!-- Article Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $article->title }}</h1>
            
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center">
                    @if($article->author->avatar)
                        <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}" class="w-10 h-10 rounded-full mr-3">
                    @else
                        <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3">
                            {{ substr($article->author->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <p class="font-medium text-gray-800">{{ $article->author->name }}</p>
                        <p class="text-sm text-gray-500">{{ $article->published_at->format('M d, Y') }} &bull; {{ $article->published_at->diffForHumans() }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-gray-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        {{ $article->views_count }} views
                    </span>
                    
                    <span class="text-sm text-gray-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        {{ $article->comments->count() }} comments
                    </span>
                </div>
            </div>
        </div>
        
        @if($article->featured_image)
            <div class="mb-8">
                <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-auto rounded-lg shadow-md">
            </div>
        @endif
        
        <!-- Article Content -->
        <div class="prose prose-indigo max-w-none mb-12">
            {!! $article->content !!}
        </div>
        
        <!-- Tags -->
        @if($article->tags->count() > 0)
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    @foreach($article->tags as $tag)
                        <a href="{{ route('tags.show', $tag->slug) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full transition">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Author Bio -->
        <div class="border-t border-gray-200 pt-8 mb-12">
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex items-center mb-4">
                    @if($article->author->avatar)
                        <img src="{{ $article->author->avatar }}" alt="{{ $article->author->name }}" class="w-16 h-16 rounded-full mr-4">
                    @else
                        <div class="w-16 h-16 rounded-full bg-indigo-100 text-indigo-600 text-xl flex items-center justify-center mr-4">
                            {{ substr($article->author->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $article->author->name }}</h3>
                        <p class="text-sm text-gray-500">Author</p>
                    </div>
                </div>
                
                <p class="text-gray-600">{{ $article->author->bio ?? 'This author has not yet added their bio.' }}</p>
                
                <div class="mt-4">
                    <a href="{{ route('authors.show', $article->author->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                        View all posts by this author
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
            <div class="border-t border-gray-200 pt-8 mb-12">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">You might also like</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($relatedArticles as $relatedArticle)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-300">
                            @if($relatedArticle->featured_image)
                                <img src="{{ $relatedArticle->featured_image }}" alt="{{ $relatedArticle->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-gray-800 mb-2 hover:text-indigo-600">
                                    <a href="{{ route('articles.show', $relatedArticle->slug) }}">{{ $relatedArticle->title }}</a>
                                </h4>
                                <p class="text-gray-600 text-sm mb-3">{{ $relatedArticle->excerpt }}</p>
                                
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-500">{{ $relatedArticle->published_at->format('M d, Y') }}</span>
                                    <span class="text-indigo-600">{{ $relatedArticle->category->name }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        
        <!-- Comments Section -->
        <div class="border-t border-gray-200 pt-8 mb-12" id="comments">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Comments ({{ $article->comments->count() }})</h3>
            
            @auth
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-8">
                    <h4 class="text-lg font-medium text-gray-800 mb-4">Leave a comment</h4>
                    
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        
                        <div class="mb-4">
                            <textarea name="content" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" placeholder="Your comment..." required></textarea>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-6 mb-8 text-center">
                    <p class="text-gray-600 mb-4">You need to be logged in to comment.</p>
                    <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg inline-block transition duration-300">
                        Login to Comment
                    </a>
                </div>
            @endauth
            
            <!-- Comments List -->
            <div class="space-y-8">
                @forelse($article->comments->where('parent_id', null)->where('is_approved', true) as $comment)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6" id="comment-{{ $comment->id }}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                @if($comment->user->avatar)
                                    <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full mr-3">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h5 class="font-medium text-gray-800">{{ $comment->user->name }}</h5>
                                    <p class="text-sm text-gray-500">{{ $comment->created_at->format('M d, Y') }} at {{ $comment->created_at->format('H:i') }}</p>
                                </div>
                            </div>
                            
                            @auth
                                <button class="text-gray-500 hover:text-indigo-600 reply-button" data-comment-id="{{ $comment->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endauth
                        </div>
                        
                        <div class="text-gray-700 mb-4">
                            {{ $comment->content }}
                        </div>
                        
                        <!-- Reply Form (Hidden by default) -->
                        @auth
                            <div class="reply-form hidden mt-4 pl-4 border-l-2 border-indigo-100" id="reply-form-{{ $comment->id }}">
                                <h6 class="text-sm font-medium text-gray-700 mb-2">Reply to {{ $comment->user->name }}</h6>
                                <form action="{{ route('comments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    
                                    <div class="mb-3">
                                        <textarea name="content" rows="3" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500" placeholder="Your reply..." required></textarea>
                                    </div>
                                    
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-1 px-3 rounded-lg transition duration-300 cancel-reply" data-comment-id="{{ $comment->id }}">
                                            Cancel
                                        </button>
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-1 px-3 rounded-lg transition duration-300">
                                            Post Reply
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endauth
                        
                        <!-- Replies -->
                        @if($comment->replies->where('is_approved', true)->count() > 0)
                            <div class="mt-6 pl-6 border-l-2 border-gray-100 space-y-6">
                                @foreach($comment->replies->where('is_approved', true) as $reply)
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <div class="flex items-center mb-3">
                                            @if($reply->user->avatar)
                                                <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}" class="w-8 h-8 rounded-full mr-2">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-2">
                                                    {{ substr($reply->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="font-medium text-gray-800 text-sm">{{ $reply->user->name }}</h6>
                                                <p class="text-xs text-gray-500">{{ $reply->created_at->format('M d, Y') }} at {{ $reply->created_at->format('H:i') }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="text-gray-700 text-sm">
                                            {{ $reply->content }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Reply functionality
        const replyButtons = document.querySelectorAll('.reply-button');
        const cancelButtons = document.querySelectorAll('.cancel-reply');
        
        replyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.dataset.commentId;
                const replyForm = document.getElementById(`reply-form-${commentId}`);
                replyForm.classList.toggle('hidden');
            });
        });
        
        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const commentId = this.dataset.commentId;
                const replyForm = document.getElementById(`reply-form-${commentId}`);
                replyForm.classList.add('hidden');
            });
        });
    });
</script>
@endpush
@endsection