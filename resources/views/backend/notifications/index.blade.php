@extends('backend.datatable-master')
@section('title','Notifications')
@section('content')
<div class="container-fluid">
    <a href="{{(auth()->user()->hasRole('admin')) ? route('admin.dashboard') : route('user.dashboard')}}" class="btn btn-danger waves-effect">BACK</a>
    <br>
    <br>
    @foreach ($notifications as $notification)
        @if ($notification->data['type'] == 'NewPost') 
        <div class="alert alert-success" role="alert">
            Posted by {{$notification->data['username']}} Need to approve <a class="btn btn-primary" href="{{route('admin.post.show',$notification->data['id'])}}">View</a> <a class="btn btn-warning" href="{{route('admin.markasread',$notification->id)}}">Mark as Read</a>
        </div>
        @elseif ($notification->data['type'] == 'PostApproved')
        <div class="alert alert-success" role="alert">
            Your Post has been successfully approved <a class="btn btn-primary" href="{{route('user.post.show',$notification->data['id'])}}">View</a> <a class="btn btn-warning" href="{{route('user.markasread',$notification->id)}}">Mark as Read</a>
        </div>
        @endif
    @endforeach
</div>
@endsection