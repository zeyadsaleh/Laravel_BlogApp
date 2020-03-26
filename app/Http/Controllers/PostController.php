<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // @dd($posts);
        return view('Posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show()
    {
        //get the id from url
        $request = request();
        //@dd($request);
        $postId = $request->post;
        //qurey the database to get the post
        $post = Post::find($postId);
        //put the value to the view

        return view('Posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('Posts.create', ['users' => $users]);
    }

    public function store()
    {
        //get the request data
        $request = request();
        //@dd($request) -> title;
        //store the data in the database
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);

        //redirect to posts
        return redirect()->route('posts.store');
    }

    public function destroy()
    {
        //get the post id
        $request = request();
        $postId = $request->post;
        //@dd($userId);
        //delete it from database
        $post = POST::findOrFail($postId);

        $post->delete();
        //redirect to the show page
        return redirect()->route('posts.index');
    }


    public function update()
    {
        $request = request();
        
        $postId = $request -> post;
        //@dd($postId);
        $post = POST::find($postId);
        //@dd($request->title);
        $post->title = $request->title;
        $post->description = $request->title;

        $post->save();

        return redirect()->route('posts.index');


    }

    public function edit()
    {
        //get the post id and user
        $request = request();
        $postId = $request->post;
        //query the database to get this post
        $post = Post::find($postId);
        //render to form to edit this post
        return view('Posts.edit', ['post' => $post]);
    }
}
