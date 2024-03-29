@extends('backend.datatable-master')
@section('title','Post details')
@section('content')
<div class="container-fluid">
    <a href="{{route('admin.post.index')}}" class="btn btn-danger waves-effect">BACK</a>
    @if ($post->is_approved == false)
        <button type="button" class="btn btn-success pull-right" type="submit" onclick="approvePostFrom()">
            <i class="material-icons">done</i>
            <span>Approve</span>
        </button>
        <form action="{{route('admin.post.approve',$post->id)}}" method="POST" id="approval-from">
            @csrf
            @method('PUT')
        </form>
    @else
        <button type="button" class="btn btn-success pull-right" disabled>
            <i class="material-icons">done</i>
            <span>Approved</span>
        </button>
    @endif
    <br>
    <br>
    <div class="row clearfix">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$post->title}}
                        <small>Posted By: <strong>{{$post->user->name}}</strong> on {{$post->created_at->toFormattedDateString()}}</small>
                    </h2>
                </div>
                <div class="body">
                    {!!$post->body!!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Categories
                    </h2>
                </div>
                <div class="body">
                    @foreach ($post->categories as $category)
                       <span class="label bg-cyan">{{$category->name}}</span> 
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-green">
                    <h2>
                        Tags
                    </h2>
                </div>
                <div class="body">
                    @foreach ($post->tags as $tag)
                       <span class="label bg-green">{{$tag->name}}</span> 
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-amber">
                    <h2>
                        Featured image:
                    </h2>
                </div>
                <div class="body">
                    <img src="{{asset('/')}}images/posts/card/{{$post->image}}" alt="" class="img-responsive thumbnail">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection