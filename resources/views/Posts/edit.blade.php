@extends('Layout.app')
@section('content')
<form method="POST" action="{{route('posts.update',['post' => $post->id])}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
        <label for="exampleInputEmail1">Title </label>
        <input type="text" value="{{$post-> title}}" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea name="description" class="form-control">{{$post-> description}}</textarea>
    </div>

    <div class="form-group">
        <label>Users</label>
        <select name='user_id' class="form-control">
            <option value="{{$post->user->id}}">{{$post->user->name}}</option>
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection