@extends('layouts.app')

@section('content')
    <section class="container">
        <h1>Create your post</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name='title' id="title" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name='content' id="content" row="6">{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Categories section --}}
            <div class="mb-3">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Uncategorized</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if($category->id == old('category_id')) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tags section --}}
            <div class="mb-3">
                <h4>Tags</h4>
                
                @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3">
                        <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}" value="{{ $tag->id }}"
                            @if (in_array($tag->id, old('tags', [] ))) checked @endif>
                            
                        <label for="tag{{ $loop->iteration }}">
                            {{ $tag->name }}
                        </label>
                    </span>
                @endforeach   
                @error('tags')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            {{-- Post Cover Image --}}
            <div class="mb-5">
                <label for="cover" class="form-label">Post Image</label>
                <input class="form-control-file" type="file" name="cover" id="cover">
                @error('cover')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Create Post</button>
        </form>
    </section>
@endsection