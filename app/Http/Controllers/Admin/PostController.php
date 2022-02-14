<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categories = Category::all();
       $tags = Tag::all();
       return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        // $request->validate([
        //     'title' => 'required|max:255',
        //     'content' => 'required',
        // ], [
        //     'required' => 'The :attribute is a required field!',
        //     'max' => 'Max :max characters allowed for the :attribute',
        // ]);
        $request->validate($this->validation_rules(), $this->validation_messages());

        $data = $request->all();
        
        // dd($data);

        if (array_key_exists('cover', $data)) {
            $img_path = Storage::put('post-covers', $data['cover']);
            $data['cover'] = $img_path;
        }

        // create new post
        $new_post = new Post();

        // Gen unique slug
        $slug = Str::slug($data['title'], '-');
        $count = 1;

        // run th cicle if found the post with same slug
        while (Post::where('slug', $slug)->first()) {
            // gen new slug with counter
            $slug .= '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        $new_post->fill($data);
        $new_post->save();

        // Save in pivot the relation between the new post with the tags selected in the form
        if (array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if(! $post) {
            abort('404');
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $post = Post::find($id);
        $categories = Category::all();

        $tags = Tag::all();

        if (! $post) {
            abort(']404');
        }

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
         // Validation
        //  $request->validate([
        //     'title' => 'required|max:255',
        //     'content' => 'required',
        // ], [
        //     'required' => 'The :attribute is a required field!',
        //     'max' => 'Max :max characters allowed for the :attribute',
        // ]);
        $request->validate($this->validation_rules(), $this->validation_messages());

        $data = $request->all();
       
        // update slug if the title has changed
        if ($data['title'] != $post->title) {
            $slug = Str::slug($data['title'], '-');
            $count = 1;
            $base_slug = $slug;

            // run th cicle if found the post with same slug
            while (Post::where('slug', $slug)->first()) {
                // gen new slug with counter
                $slug .= $base_slug . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;
        }
        else {
            $data['slug'] = $post->slug;
        }

        $post->update($data);

        // update pivots relation's between updated post and tags
        if (array_key_exists('tags', $data)) {
            // update tags (rows in bridge) : add /remove
            $post->tags()->sync($data['tags']);
        } else {
            // no checkbox for selected tag from the form, so clear
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }

    // Validation rules
    private function validation_rules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'nullable|file|mimes:jpeg,bmp,png'
        ];
    }

    private function validation_messages() {
        return [
            'required' => 'The :attribute is a required field!',
            'max' => 'Max :max characters allowed for the :attribute',
            'category_id.exists' => 'Sorry, this category does not exists',
        ];
    }

}
