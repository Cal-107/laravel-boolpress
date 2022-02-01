@extends('layouts.app')

@section('content')
    <section class="container">
        <h1>Create your post</h1>

        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf
        </form>
    </section>
@endsection