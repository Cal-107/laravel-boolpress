@extends('layouts.app')

@section('content')
    <section class="container">
        <h1 class="mb-5">{{ $post->title }}</h1>

        <h2 class="my-3">{{ $post->created_at->isoFormat('dddd DD/MM/YYYY, HH:mm:ss a') }}</h2>

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
            <div class="{{ $post->cover ? 'col-md-6' : 'col' }}">
                {!! $post->content !!}
            </div>
            @if ($post->cover)
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                </div>
            @endif
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