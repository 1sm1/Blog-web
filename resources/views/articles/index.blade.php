@extends("layouts.app")
@section("content")
    <div class="container">
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        {{ $articles->links() }}
        <div class="row row-cols-1 row-cols-md-3">
            @foreach($articles as $article)
                    <div class="col">
                        <div class="card text-bg-light mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <div class="card-subtitle mb-2 text-muted small">
                                    {{ $article->created_at->diffForHumans() }}
                                </div>
                                <p class="card-text">{{ $article->body }}</p>
                                <a class="card-link"
                                    href= "{{ url("/articles/detail/$article->id") }}">
                                    View Detail &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endsection
