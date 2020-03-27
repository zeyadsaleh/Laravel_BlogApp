@extends('layouts.app')
@section('content')
<div class="card" >
  <div class="card-body">
    <h3 class="card-title">{{$post -> title}}</h3>
    <p class="card-text">{{$post -> description}}</p>
  </div>
</div>
<a href="{{route('posts.index')}}" class="btn btn-success mt-2">Back</a>

@endsection

