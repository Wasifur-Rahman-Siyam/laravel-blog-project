@extends('backend.datatable-master')
@section('title','Notifications')
@section('content')
<div class="container-fluid">
    <a href="{{(auth()->user()->hasRole('admin')) ? route('admin.dashboard') : route('user.dashboard')}}" class="btn btn-danger waves-effect">BACK</a>

    <ul>
        @foreach ($notifications as $notification)
            <li>
                Posted by {{$notification->data['username']}} Need to approve <a href="{{route('admin.post.show',$notification->data['id'])}}">View</a>
            </li>  
        @endforeach
    </ul>
</div>
@endsection