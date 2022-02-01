@extends('layouts.app')

@section('content')
    <section class="container">
        <h1>Blog Posts</h1>

        @if ($posts->isEmpty())
        <p>No post found yet. <a href=" {{ route('admin.posts.create') }} ">Create a new one</a></p>
        @else

        @if (session('deleted'))
        <div class="alert alert-success">
            <strong> {{ session('deleted') }} </strong> has been successfully deleted 
        </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td class="text-center">{{ $post->id }}</td>
                        <td class="text-center">{{ $post->title }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-info">Show Post</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-secondary">Edit Post</a>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">
                                    Delete Post
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </section>
@endsection