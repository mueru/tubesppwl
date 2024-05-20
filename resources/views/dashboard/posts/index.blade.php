@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome, {{ auth()->user()->name }}</h1>
    </div>

    @session('success')
    <div class="alert alert-success col-lg-7" role="alert">
        {{ session('success') }}
    </div>
    @endsession

<div class="table-responsive col-lg-7">
    <a href="/dashboard/posts/create" class="btn btn-primary mb-3"><span data-feather="plus"></span> Create new post</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $post->title }} </td>
                    <td> {{ $post->category->name }} </td>
                    <td>
                        <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span
                                data-feather="info"></span></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
