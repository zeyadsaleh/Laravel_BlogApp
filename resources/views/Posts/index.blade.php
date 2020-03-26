@extends('Layout.app')
@section('content')
<div class="container-fluid ">
<a href="{{route('posts.create')}}" class="btn btn-success mb-2 center-block">Create Post</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">User</th>
            <th scope="col">CreatedAt</th>
            <th scope="col">Actions</th>


        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <th>{{$post -> id}}</th>
            <td>{{$post-> title}}</td>
            <td>{{ $post->user ? $post->user->name : '--'}}</td>
            <td>{{$post-> created_at -> format('Y-m-d')}}</td>
            <td><a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-secondary btn-sm">View</a>
            <a href="{{route('posts.edit',['post' => $post->id])}}" class="btn btn-primary btn-sm">Edit</a>
                <form method="POST" action="{{route('posts.destroy',['post' => $post->id])}}" style = "display: inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-primary btn-sm bg-danger">Delete</button>
                </form>
                
            </td>


        </tr>
        @endforeach


    </tbody>
</table>
</div>
@endsection