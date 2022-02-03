@extends('layouts.app')

@section('content')
    <section class="container">
        <h1 class="mb-5"> {{ $category->name }} </h1>

        @foreach($category->posts as $post)
            <article>
                <h2>{{ $post->title }}</h2>
                <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-success">Show</a>
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
            </article>
        @endforeach
    </section>
@endsection