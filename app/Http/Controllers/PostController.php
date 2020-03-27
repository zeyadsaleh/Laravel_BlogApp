<?php

namespace App\Http\Controllers;

use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\User;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(2);;
        // @dd($posts);
        return view('Posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        //@dd($post);
        //get the id from url
        //$request = request();
        //@dd($request);
        //$postId = $request->post;
        //qurey the database to get the post
        //$post = Post::find($postId);
        //add code to handle if the post id is not existed

        //put the value to the view

        return view('Posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('Posts.create', ['users' => $users]);
    }

    public function store(PostRequest $request)
    {
        //get the request data
        //$path = $request->file('image')->store('image');
       // $path = Storage::putFile('image', $request->file('image'));    
        //store the data in the database
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'file' => Storage::putFile('image', $request->file('image'))
            
        ]);

        //redirect to posts
        return redirect()->route('posts.store');
    }

    public function destroy(Post $post)
    {
        //get the post id
        //$request = request();
       // $postId = $request->post;
        //@dd($userId);
        //delete it from database
       // $post = POST::findOrFail($postId);

        $post->delete();
        if ($post->image) Storage::delete('public/'.$post->image);
        //redirect to the show page
        return redirect()->route('posts.index');
    }


    public function update(PostRequest $request, Post $post)
    {
        
        //$postId = $request->post;
        //@dd($postId);
       // $post = POST::find($postId);
        //@dd($request->title);
        /*$post->title = $request->title;
        $post->description = $request->description;
        $post->save();*/
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);
        if ($request->hasFile('image')){
            $attributes['image'] = Post::storePostImage($request);
            Storage::delete('public/'.$post->image);
        }


        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        //get the post id and users
       // $request = request();
        $users = User::all();
       // $postId = $request->post;
        //query the database to get this post
       // $post = Post::find($postId);
        //render to form to edit this post
        return view(
            'Posts.edit',
            ['post' => $post],
            ['users' => $users]
        );
    }
}
