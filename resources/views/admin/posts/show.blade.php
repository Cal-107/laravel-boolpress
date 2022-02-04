@extends('layouts.app')

@section('content')
    <section class="container">
        <h1 class="mb-5">{{ $post->title }}</h1>

        <div class="mb-5">
            <span>
                <strong>Category</strong>
                @if ($post->category)
                    {{ $post->category->name }}
                @else
                    Uncategorized
                @endif
            </span>
            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back to archive</a>
        </div>

        <div class="row">
            <div class="col-md-6">
                {!! $post->content !!}
            </div>
            <div class="col-md-6">
                Image here
            </div>
        </div>

        @if (!$post->tags->isEmpty())
            <h4 class="mt-4">Tags</h4>

            @foreach ($post->tags as $tag)
                <span class="badge badge-primary">{{ $tag->name }}</span>
            @endforeach
        @else
            <p class="mt-4">This post has no tags</p>
        @endif
    </section>
@endsection