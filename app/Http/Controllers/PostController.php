<?php

namespace App\Http\Controllers;

use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Post;
use App\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(2);;
        return view('Posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        $url = Storage::url($post->file);

        return view('Posts.show', [
            'post' => $post,
            'url' => $url
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('Posts.create', ['users' => $users]);
    }

    public function store(PostRequest $request)
    {
        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename() . '.' . $extension,  File::get($cover));

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'file' => $cover->getFilename() . '.' . $extension,


        ]);

        //redirect to posts
        return redirect()->route('posts.store');
    }

    public function destroy(Post $post)
    {   
        $post->delete();
        if ($post->file) Storage::delete('public/uploads'.$post->file);
        //redirect to the show page
        return redirect()->route('posts.index');
    }


    public function update(PostRequest $request, Post $post)
    {
        if ($request->file) {
            Storage::delete('public/uploads'.$post->file);
            $cover = $request->file('image');
            $extension = $cover->getClientOriginalExtension();
            Storage::disk('public')->put($cover->getFilename() . '.' . $extension,  File::get($cover));
            $post->update(['file' => $cover->getFilename() . '.' . $extension,]);
        }


        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);
        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        //get the post id and users
        $users = User::all();
        //render to form to edit this post
        return view(
            'Posts.edit',
            ['post' => $post],
            ['users' => $users]
        );
    }
}
