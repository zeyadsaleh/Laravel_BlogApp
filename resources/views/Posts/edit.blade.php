@extends('layouts.app')
@section('content')
@if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
<form method="POST" action="{{route('posts.update',['post' => $post->id])}}" enctype="multipart/form-data" class="m-3">
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
        <label for="exampleInputEmail1">Title </label>
        <input  type="file" value="{{$post-> file}}" class="form-control mt-2 mb-2" name="image">
    </div>

    <div class="form-group">
    <label>Users</label>
    <select name = 'user_id' class="form-control">
        @foreach($users as $user)
        <option value="{{$user -> id}}">{{$user->name}}</option>
        @endforeach
    </select>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection