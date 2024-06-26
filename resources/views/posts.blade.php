@extends('layouts/main')

{{-- sintaks php {{ $post["id"] }} --}}
{{-- sintaks laravel+collection {{ $post->id }} --}}
@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            {{-- Method GET adalah method default --}}
            <form action="/posts">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Recipe" name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-warning text-white" style="background-color: #3eb489" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
        <div class="card mb-3 align-items-center border-0">
            @if ($posts[0]->image)
                <div style="max-height: 400px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}"
                        class="img-fluid">
                </div>
            @else
                <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top"
                    alt="{{ $posts[0]->category->name }}">
            @endif

            <div class="card-body text-center">
                <h5 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-dark">{{ $posts[0]->title }}</a>
                </h5>
                <p>
                    <small class="text-muted">
                        By. <a href="/posts?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a> in
                        <a href="/posts?category={{ $posts[0]->category->slug }}"
                            class="text-decoration-none">{{ $posts[0]->category->name }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                </p>

                <p class="card-text">{{ $posts[0]->excerpt }}</p>

                <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn text-white" style="background-color: #3eb489">Read more</a>

            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-md-4 mb-3">
                        <div class="card text-center h-100">
                            <div class="position-absolute px-3 py-2 text-white rounded"
                                style="background-color: rgba(0, 0, 0, 0.3)"><a
                                    href="/posts?category={{ $post->category->slug }}"
                                    class="text-white text-decoration-none">{{ $post->category->name }}</a></div>
                            @if($post->image)
                            <div style="max-width:500px; overflow:hidden">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                                    class="img-fluid">
                            </div>
                            @else
                                <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"
                                    class="card-img-top" alt="{{ $post->category->name }}">
                            @endif
                            <div class="card-body overflow-hidden">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>
                                    <small class="text-muted">
                                        By. <a href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a> in
                                        <a href="/posts?category={{ $post->category->slug }}"
                                            class="text-decoration-none">{{ $post->category->name }}</a>
                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </p>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a href="/posts/{{ $post->slug }}" class="btn text-white" style="background-color: #3eb489">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @else
        <p class="text-center fs-4">No Post Found</p>
    @endif

    {{ $posts->links() }}

    <div class="container">
        <hr>
        <hr>
    </div>

@endsection
