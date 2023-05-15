@extends('backend.datatable-master')
@section('title','Notifications')
@section('content')
<div class="container-fluid">
    <a href="{{(auth()->user()->hasRole('admin')) ? route('admin.dashboard') : route('user.dashboard')}}" class="btn btn-danger waves-effect">BACK</a>
    @foreach ($notifications as $notification)
        @if ($notification->data['type'] == 'NewPost') 
        <div class="custom-card" role="alert">
            <div>
                Posted by {{$notification->data['username']}} Need to approve : {{Str::limit($notification->data['title'],100)}}...  
            </div>
            <div>
                <a class="btn btn-primary" href="{{route('admin.post.show',$notification->data['id'])}}">View</a> <a class="btn btn-warning" href="{{route('admin.markasread',$notification->id)}}">Mark as Read</a>
            </div>
        </div>
        @elseif ($notification->data['type'] == 'PostApproved')
        <div class="custom-card" role="alert">
            <div>
                Your Post has been successfully approved : {{Str::limit($notification->data['title'],100)}}...  
            </div>
            <div>
                <a class="btn btn-primary" href="{{route('user.post.show',$notification->data['id'])}}">View</a> <a class="btn btn-warning" href="{{route('user.markasread',$notification->id)}}">Mark as Read</a>
            </div>
        </div>
        @elseif ($notification->data['type'] == 'like')
        <div class="custom-card" role="alert">
            <div>
                {{$notification->data['username']}} Liked your post : {{Str::limit($notification->data['title'],100)}}...  
            </div>
            <div>
                <a class="btn btn-primary" href="{{(auth()->user()->hasRole('admin')) ? route('admin.post.show',$notification->data['id']) : route('user.post.show',$notification->data['id'])}}">View</a> 
                <a class="btn btn-warning" href="{{(auth()->user()->hasRole('admin')) ? route('admin.markasread',$notification->id) : route('user.markasread',$notification->id)}}">Mark as Read</a>
            </div>
        </div>
        @elseif ($notification->data['type'] == 'Comment')
        <div class="custom-card" role="alert">
            <div>
                {{$notification->data['username']}} Commented on your post : {{Str::limit($notification->data['title'],100)}}...  
            </div>
            <div>
                <a class="btn btn-primary" href="{{(auth()->user()->hasRole('admin')) ? route('admin.comments.index',$notification->data['id']) : route('user.comments.index',$notification->data['id'])}}">View Comments</a> 
                <a class="btn btn-warning" href="{{(auth()->user()->hasRole('admin')) ? route('admin.markasread',$notification->id) : route('user.markasread',$notification->id)}}">Mark as Read</a>
            </div>
        </div>
        @endif
    @endforeach
</div>
@endsection