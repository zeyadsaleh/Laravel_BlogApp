<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(
            Post::with('User')->paginate(5)
        );
        
    }
    public function show(Post $post)
    {  
        return new PostResource($post);    
    }

}
