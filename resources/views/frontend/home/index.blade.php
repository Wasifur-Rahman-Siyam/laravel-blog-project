@extends('frontend.master')

@section('title', 'Home Page')

@section('content')
        <!-- Banner area -->
        <div class="container-fluid">
            <div class="row">
              <div class="banner-img">
                <img src="{{asset('/')}}frontend-assets/img/banner.png" alt="">
              </div>
            </div>
          </div>
      
          <!-- Featured Area -->
          <div class="container my-4">
            <div class="row">
              <h3>Featured Post</h3>
            </div>
            <div class="row">
              @foreach ($randomPosts as $randomPost)
              <div class="col-lg-4">
                <div class="card mt-3 h-100">
                  <img src="{{asset('/')}}images/posts/card/{{$randomPost->image}}" class="card-img-top" alt="" />
                  <div class="card-body">
                    <a href="{{route('post.details',$randomPost->slug)}}" class="text-decoration-none text-black">
                      <h4 class="card-title">{{$randomPost->title}}</h4>
                      <p>{{$randomPost->created_at->toFormattedDateString()}}</p>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="profile-info-container">
                          <span class="profile-icon">
                            <img src="{{asset('/')}}{{$randomPost->user->image}}" alt="">
                            {{$randomPost->user->name}}
                          </span>
                        </div>
                        <div class="d-flex gap-3">
                          <div class="like">
                            @guest
                            <i class="fa-regular fa-thumbs-up"></i>
                              {{$randomPost->like_to_users()->count()}}
                            @else
                              <a href="javascript:void(0);" onclick="document.getElementById('like-form-{{$randomPost->id}}').submit();" style="color:black">
                                <i class="{{!Auth::user()->likedPosts()->where('post_id',$randomPost->id)->count() == 0 ? 'fa-solid':'fa-regular'}} fa-thumbs-up"></i>
                                {{$randomPost->like_to_users()->count()}}
                              </a>
                              <form id='like-form-{{$randomPost->id}}' action="{{route('post.like',$randomPost->id)}}" method="POST" style="display: none">
                                @csrf
                              </form> 
                            @endguest
                          </div>
                          <div class="comment">
                            <i class="fa-regular fa-comment"></i>
                            {{$randomPost->comments()->count()}}
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
      
          <!-- Recent articles section -->
          <main class="container my-4">
            <div class="row">
              <div class="col-sm-9">
                <h3>Recent Articles</h3>
                <!--Article lists -->
                @foreach ($recentPosts as $recentPost)                  
                <div class="list-group mt-3">
                  <a href="{{route('post.details',$recentPost->slug)}}" class="list-group-item list-group-item-action">
                    <div class="recent-card d-flex gap-3">
                      <div class="recent-card-img">
                        <img src="{{asset('/')}}images/posts/card/{{$recentPost->image}}" alt="">
                      </div>
                      <div class="recent-card-content">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">{{Str::limit($recentPost->title,65)}}</h5>
                        </div>
                        <p>{{$recentPost->user->name}}</p>
                        <small class="text-muted">{{$recentPost->created_at->toFormattedDateString()}}</small>
                        {!!Str::limit($recentPost->body,90)!!}
                      </div>
                    </div>
                  </a>
                </div>
                @endforeach
              </div>
      
              <!-- side bar -->
              <div class="col-sm-3">
                <h3 class="">Popular Categories</h3>
                <div class="mt-3">
                  <ul class="list-group">
                    <li class="list-group-item">An item</li>
                  </ul>
                </div>
              </div>
            </div>
          </main>
@endsection