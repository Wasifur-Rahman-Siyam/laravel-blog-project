@extends('frontend.master')

@section('title', 'Home Page')

@section('content')
        <!-- Banner area -->
        @if ($bannerImage != null) 
          <div class="container-fluid">
            <div class="row">
              <div class="banner-img">
                <img src="{{asset('/')}}images/categories/banner/{{$bannerImage}}" alt="">
              </div>
            </div>
          </div>
        @endif
          <!-- Featured Area -->
          <div class="container my-4">
            <div class="row">
              @if ($posts->count() > 0)
                @foreach ($posts as $post)
                  <div class="col-lg-4 my-3">
                    <div class="card h-100">
                      <img src="{{asset('/')}}images/posts/card/{{$post->image}}" class="card-img-top" alt="" />
                      <div class="card-body">
                          <h4 class="card-title">{{$post->title}}</h4>
                          <p>{{$post->created_at->toFormattedDateString()}}</p>
                          <div class="profile-info-container">
                            <span class="profile-icon">
                              <img src="{{asset('/')}}{{$post->user->image}}" alt="">
                              {{$post->user->name}}
                            </span>
                          </div>
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex gap-3">
                              <div class="like">
                                @guest
                                <a href="{{route('login')}}" style="color:black">
                                  <i class="fa-regular fa-thumbs-up"></i>
                                  {{$post->like_to_users()->count()}}
                                </a>
                                @else
                                  <a href="javascript:void(0);" onclick="document.getElementById('like-form-{{$post->id}}').submit();" style="color:black">
                                    <i class="{{!Auth::user()->likedPosts()->where('post_id',$post->id)->count() == 0 ? 'fa-solid':'fa-regular'}} fa-thumbs-up"></i>
                                    {{$post->like_to_users()->count()}}
                                  </a>
                                  <form id='like-form-{{$post->id}}' action="{{route('post.like',$post->id)}}" method="POST" style="display: none">
                                    @csrf
                                  </form> 
                                @endguest
                              </div>
                              <div class="comment">
                                <i class="fa-regular fa-comment"></i>
                                {{$post->comments()->count()}}
                              </div>
                            </div>
                            <div>
                              <a href="{{route('post.details',$post->slug)}}" class="btn btn-outline-dark">View</a>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                @else
                <p class="text-center">No post found</p>
                @endif
            </div>
          </div>
@endsection