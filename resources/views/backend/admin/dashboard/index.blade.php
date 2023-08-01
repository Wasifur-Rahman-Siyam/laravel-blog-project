@extends('backend.dashboard-master')
@section('title','Blog-Dashboard')
@section('content')

<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL POSTS</div>
                    <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL APPROVED POSTS</div>
                    <div class="number count-to" data-from="0" data-to="{{$approved_posts}}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-red hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">help</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL PENDING POSTS</div>
                    <div class="number count-to" data-from="0" data-to="{{$pending_posts}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-blue hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">face</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL USER</div>
                    <div class="number count-to" data-from="0" data-to="{{$total_user}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">face</i>
                </div>
                <div class="content">
                    <div class="text">NEW USER TODAY</div>
                    <div class="number count-to" data-from="0" data-to="{{$new_user_today}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-blue-grey hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">apps</i>
                </div>
                <div class="content">
                    <div class="text">CATEGORIS</div>
                    <div class="number count-to" data-from="0" data-to="{{$category_count}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-grey hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">labels</i>
                </div>
                <div class="content">
                    <div class="text">TAGS</div>
                    <div class="number count-to" data-from="0" data-to="{{$tag_count}}" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->


    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>POPURLAR POSTS:</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Likes</th>
                                    <th>Comments</th>
                                    <th>Status</th>
                                    <th>Preview</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popular_posts as $post)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{Str::limit($post->title,20)}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->like_to_users_count}}</td>
                                        <td>{{$post->comments_count}}</td>
                                        <td>
                                        @if ($post->status == true)
                                            <span class="badge bg-blue">Active</span>
                                        @else
                                            <span class="badge bg-yellow">Inactive</span>
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.post.show',$post->id)}}" class="btn btn-success">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>TOP 5 ACTIVE USER:</h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Profile</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($active_user as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->posts_count}}</td>
                                        <td>
                                            <a href="{{route('profile',$user->username)}}" class="btn btn-success">
                                                Visit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
    </div>
</div>
@endsection