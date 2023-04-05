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
              <div class="col-lg-4">
                @foreach ($recentPosts as $recentPost)
                <div class="card mt-3">
                  <img src="{{asset('/')}}frontend-assets/img/1.jpg" class="card-img-top" alt="" />
                  <div class="card-body">
                    {{-- <a href="#" class="text-decoration-none text-black"> --}}
                      <h6>Category</h6>
                      <h4 class="card-title">{{$recentPost->title}}</h4>
                      <p>5/5/2023</p>
                      <p>
                          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias,
                          quisquam ratione? Ea natus magni omnis?....
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="profile-info-container">
                          <span class="profile-icon">
                            <img src="{{asset('/')}}frontend-assets/img/IMG_1043.JPG" alt="">
                            User name
                          </span>
                        </div>
                        <div class="d-flex gap-3">
                          <div class="like">
                            @guest
                            <i class="fa-regular fa-thumbs-up"></i>
                              {{$recentPost->like_to_users()->count()}}
                            @else  
                              <a href="javascript:void(0);" style="color:black">
                                <i class="fa-regular fa-thumbs-up"></i>
                                {{$recentPost->like_to_users()->count()}}
                              </a>
                              {{-- <i class="fa-solid fa-thumbs-up"></i> --}}
                            @endguest
                          </div>
                          <div class="comment">
                            <i class="fa-regular fa-comment"></i>
                            1
                          </div>
                        </div>
                      </div>
                    {{-- </a> --}}
                  </div>
                </div>
                @endforeach
              </div>
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
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="recent-card d-flex gap-3">
                      <div class="recent-card-img">
                        <img src="{{asset('/')}}images/posts/card/{{$recentPost->image}}" alt="">
                      </div>
                      <div class="recent-card-content">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">{{$recentPost->title}}</h5>
                          <small class="text-muted">{{$recentPost->created_at->toFormattedDateString()}}</small>
                        </div>
                        <p class="mb-1">{{$recentPost->user->name}}</p>
                        <small class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit.</small>
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