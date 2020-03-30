@extends('layouts.app')
@section('content')
<div class="card m-3">
  <div class="card-body">
    <h3 class="card-title">{{$post -> title}}</h3>
    <p class="card-text">{{$post -> description}}</p>    
    @if($post->file)
    <img class="card-img-top img-fluid" src="{{url('uploads/'.$post->file)}}" alt="image" style="height: 200px; width:200px">
    @endif
  </div>
</div>
<a href="{{route('posts.index')}}" class="btn btn-success m-3">Back</a>

@endsection