@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="post">
            @csrf
            <div class="mb-3">
                <input type="text" name="title" class="form-control" value="{{ $article->title }}" />
            </div>
            <div class="mb-3">
                <textarea rows="7" name="body" class="form-control">
                    {{ $article->body }}
                </textarea>
            </div>
            <input type="submit" value="update" class="btn btn-outline-primary float-end" />
        </form>
    </div>
@endsection
