@extends('layouts.app')

@section('content')
    <section class="container">
        <h1 class="mb-5">{{ $post->title }}</h1>

        <div class="mb-5">
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
    </section>
@endsection