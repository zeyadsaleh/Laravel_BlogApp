<?php

namespace App\Http\Controllers;

use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
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
        //@dd($request) -> title;

        //validation

        /*$validatedData = $request->validate([
            'title' => 'required|unique:posts|min:3',
            'description' => 'required|min:10',
        ]);*/
        //store the data in the database
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,

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


    public function update(Request $request)
    {
        //validation
        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:10',
        ]);
        $postId = $request->post;
        //@dd($postId);
        $post = POST::find($postId);
        //@dd($request->title);
        /*$post->title = $request->title;
        $post->description = $request->description;
        $post->save();*/
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ]);


        return redirect()->route('posts.index');
    }

    public function edit()
    {
        //get the post id and users
        $request = request();
        $users = User::all();
        $postId = $request->post;
        //query the database to get this post
        $post = Post::find($postId);
        //render to form to edit this post
        return view(
            'Posts.edit',
            ['post' => $post],
            ['users' => $users]
        );
    }
}
