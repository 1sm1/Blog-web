@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    By <b> {{ $article->user->name }} </b>,
                    {{ $article->created_at->diffForHumans() }},
                    Category:: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                @auth
                    @if (auth()->user()->id == $article->user_id)
                        <a class="btn btn-outline-primary me-1" href="{{ url("/articles/edit/$article->id") }}">Edit
                        </a>
                        <a class="btn btn-outline-danger" href="{{ url("/articles/delete/$article->id") }}">
                            Delete
                        </a>
                    @endif
                @endauth
            </div>
        </div>
        <ul class="list-group mb-2">
            <li class="list-group-item active">Comments ({{ count($article->comments) }})
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    @auth
                        @if (auth()->user()->id == $comment->user_id)
                            <a class="btn-close float-end" href="{{ url("/comments/delete/$comment->id") }}">
                            </a>
                        @endif
                    @endauth
                    {{ $comment->content }}
                    <div class="small mt-2">
                        By <b> {{ $comment->user->name }} </b>,
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>
        @auth
            <form action="/comments/add" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" value="New Comment" class="form-control mb-2">
            </textarea>
                <input type="submit" value="Add Comment" class="btn btn-secondary">
            </form>
        @endauth
    </div>
@endsection
