@extends('layouts.app')
@section('content')
<div class="container-fluid ">
    <a href="{{route('posts.create')}}" class="btn btn-success mb-2 center-block">Create Post</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
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
                <td>{{ $post->slug ? $post->slug : '--'}}</td>
                <td>{{ $post->user ? $post->user->name : '--'}}</td>
                <td>{{$post-> created_at -> format('Y-m-d')}}</td>
                <td><a href="{{route('posts.show',['post' => $post->id])}}" class="btn btn-secondary btn-sm">View</a>
                    <a href="{{route('posts.edit',['post' => $post->id])}}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="button" class="btn btn-primary btn-sm bg-danger" data-toggle="modal" data-target="#delete">Delete</button>

                </td>


            </tr>
            <!-- Modal -->
            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLongTitle">Warning</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this post?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form method="POST" action="{{route('posts.destroy',['post' => $post->id])}}" style="display: inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-primary bg-danger" data-toggle="modal" data-target="#delete">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </tbody>
    </table>


</div>


<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
    </li>
    {{ $posts->links() }}

    </li>
  </ul>
</nav>
<div class="container">
    <div class="row">

    </div>
    </div>






@endsection