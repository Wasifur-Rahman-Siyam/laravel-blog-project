@extends('frontend.master')

@section('title')
  {{$searchTerm}}
@endsection

@section('content')
        <!-- Banner area -->
          <div class="container">
            <div class="row mt-4">
              <h3>{{$posts->count()}} Results found for "{{$searchTerm}}" :</h3>
            </div>
          </div>
          <!-- Featured Area -->
          <div class="container my-4">
            <div class="row">
              @if ($posts->count() > 0)
                @foreach ($posts as $post)
                  <div class="col-lg-4 my-3">
                    <div class="card h-100">
                      <img src="{{asset('/')}}images/posts/card/{{$post->image}}" class="card-img-top" alt="" />
                      <div class="card-body">
                        <a href="{{route('post.details',$post->slug)}}" class="text-decoration-none text-black">
                          <h4 class="card-title">{{$post->title}}</h4>
                          <p>{{$post->created_at->toFormattedDateString()}}</p>
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="profile-info-container">
                              <span class="profile-icon">
                                <img src="{{asset('/')}}{{$post->user->image}}" alt="">
                                {{$post->user->name}}
                              </span>
                            </div>
                            <div class="d-flex gap-3">
                              <div class="like">
                                <i class="fa-regular fa-thumbs-up"></i>
                                {{$post->like_to_users()->count()}}
                              </div>
                              <div class="comment">
                                <i class="fa-regular fa-comment"></i>
                                {{$post->comments()->count()}}
                              </div>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
                @else
                <p class="text-center">We're sorry. We cannot find any matches for your search term.
                </p>
                @endif
            </div>
          </div>
@endsection