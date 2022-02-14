<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{

    // Post Archive
    public function index() {
        // $posts = Post::all();
        
        // $posts = Post::paginate(3);

        $posts = Post::orderBy('id', 'desc')->paginate(3);

        return response()->json($posts);
    }

    // Post Details
    public function show($slug) {
        // Take  post by Slug
        $post = Post::where('slug', $slug)->with(['category', 'tags'])->first();
              
        if (! $post) {
            $post['not_found'] = true;
        } elseif ($post->cover) {
            $post->cover = url('storage/' . $post->cover);
        }

        // Data return in json format
        return response()->json($post);
    }
}
