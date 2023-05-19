@extends('frontend.master')

@section('title')
    {{$post->title}}
@endsection

@section('content')
    <!-- blog content -->
    <main>
        <div class="container p-4 pb-5 my-4 blog-conteiner bg-body">
          <div class="row">
            <div class="col-12">
                <h6>
                  Categories:
                    @foreach ($post->categories as $category)
                    @if ($loop->last)
                    <a href="{{route('category.posts',$category->slug)}}">{{$category->name}}</a>
                    @else
                    <a href="{{route('category.posts',$category->slug)}}">{{$category->name}}, </a>
                    @endif
                    @endforeach
                </h6>
              <h2 class="my-4">{{$post->title}}</h2>
              <div class="d-flex justify-content-between align-items-center">
                <span class="profile-icon d-flex gap-2">
                  <img src="{{asset('/')}}{{$post->user->image}}" alt="">
                  <h6 class="mb-0 mt-2">{{$post->user->name}}</h6>
                </span>
                <p>{{$post->created_at->toFormattedDateString()}}</p>
              </div>
              <div class="blog-image my-3">
                <img src="{{asset('/')}}images/posts/banner/{{$post->image}}" alt="">
              </div>
              {!!$post->body!!}

              @foreach ($post->tags as $tag)
              <button type="button" class="btn btn-outline-dark me-3 mt-4"><a href="{{route('tag.posts',$tag->slug)}}">{{$tag->name}}</a></button>
              @endforeach
              
  
              <div class="like-comment-section p-3 d-flex gap-3 my-4">
                <div class="like">
                  @guest
                  <a href="{{route('register')}}" style="color:black">
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
  
              <div class="comment-section">
                @guest
                <div class="alert alert-secondary d-flex justify-content-between align-items-center" role="alert">
                  <p>
                    You must be logged in to post a comment
                  </p>
                  <a class="btn btn-dark" href="{{route('login')}}">LOG IN</a>
                </div>
                @else
                <form action="{{route('comment.store',$post->id)}}" method="POST" >
                  @csrf
                  <div class="mb-3">
                    <label for="comment" class="form-label">Write your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4" aria-expanded="false"></textarea>
                  </div>
                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark">
                      <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                  </div>
                </form>
              </div>
              @endguest
              <div class="all-comments-section">
                <div class="my-4 d-flex justify-content-center">
                  <h3>Comments</h3> 
                </div>
                @foreach ($post->comments as $comment)
                  @if ($comment->user->id == Auth::id())
                  <div class="list-group my-3 comment-card p-3">
                    <div class="d-flex justify-content-between">
                      <div class="profile-icon d-flex gap-2 mb-2">
                        <img src="{{asset('/')}}{{$comment->user->image}}" alt="">
                        <div>
                          <h6 class="mb-0">{{$comment->user->name}}</h6>
                          <p>{{$comment->created_at->diffForHumans()}}</p>
                        </div>
                      </div>
                      <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu">
                          <li>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('delete-form').submit();">
                              delete
                            </a>
                          </li>
                        <form action="{{(auth()->user()->hasRole('admin')) ? route('admin.comment.destroy',$comment->id) : route('user.comment.destroy',$comment->id)}}" method="POST" class="delete-from" id="delete-form" style="display: none">
                            @csrf
                            @method('DELETE')
                        </form> 
                          {{-- <li><a class="dropdown-item" href="#">Edit</a></li> --}}
                        </ul>
                      </div>
                    </div>
                    <p>{{$comment->comment}}</p>
                    </div>
                  @else
                  <div class="list-group my-3 comment-card p-3">
                    <div class="d-flex justify-content-between">
                      <div class="profile-icon d-flex gap-2 mb-2">
                        <img src="{{asset('/')}}{{$comment->user->image}}" alt="">
                        <div>
                          <h6 class="mb-0">{{$comment->user->name}}</h6>
                          <p>{{$comment->created_at->diffForHumans()}}</p>
                        </div>
                      </div>
                    </div>
                    <p>{{$comment->comment}}</p>
                    </div>
                  @endif                  
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </main>
@endsection