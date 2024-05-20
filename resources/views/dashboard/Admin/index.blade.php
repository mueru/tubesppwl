@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Posts List</h1>
    </div>

<div class="table-responsive col-lg-10">
    <table class="table table-striped table-sm table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Author</th>
                <th scope="col">Username</th>
                <th scope="col">Create Date</th>
                <th scope="col">Updated at</th>
            </tr>
        </thead>    
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $post->title }} </td>
                    <td> {{ $post->category->name }} </td>
                    <td> {{ $post->author->name }} </td>
                    <td> {{ $post->author->username }} </td>
                    <td> {{ $post->created_at }} </td>
                    <td> {{ $post->updated_at }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
