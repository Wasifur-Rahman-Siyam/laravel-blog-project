@extends('backend.datatable-master')
@section('title','Post details')
@section('content')
<div class="container-fluid">
    <a href="{{route('user.post.index')}}" class="btn btn-danger waves-effect">BACK</a>
    <div class="row clearfix">
        @foreach ($comments as $comment)
        <div class="custom-card" role="alert">
          <div>
            <h5>{{$comment->user->name}}
              <br>
              <small>{{$comment->created_at->diffForHumans()}}</small>
            </h5>
            <p>{{$comment->comment}}</p>
          </div>
          <div>
            <button class="btn btn-danger" type="submit" onclick="deleteFrom()">
                <i class="material-icons" >delete</i>
            </button>
            <form action="{{ route('user.comment.destroy',$comment->id)}}" method="POST" class="delete-from" id="delete">
                @csrf
                @method('DELETE')
            </form> 
          </div>
      </div>             
      @endforeach
    </div>
</div>
@endsection