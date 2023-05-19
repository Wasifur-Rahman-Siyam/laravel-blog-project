@extends('frontend.master')

@section('title', 'Liked Pots Page')

@section('content')

<main class="container my-4">
  <div class="row">
    <div class="col-12">
      <h3>Liked Pots:</h3>
      <!--Article lists -->
      @if ($posts->count() > 0)
        @foreach ($posts as $post)
          <div class="list-group mt-3">
            <div class="list-group-item list-group-item-action">
              <div class="recent-card d-flex gap-3">
                <div class="recent-card-img">
                  <a href="{{route('post.details',$post->slug)}}">
                    <img src="{{asset('/')}}images/posts/card/{{$post->image}}" alt="">
                  </a>
                </div>
                <a href="{{route('post.details',$post->slug)}}">
                  <div class="recent-card-content">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{$post->title}}</h5>
                    </div>
                    <p class="mb-1">{{$post->user->name}}</p>
                    {!!Str::limit($post->body,90)!!}
                  </div>
                </a>
                <div class="recent-card-like-btn d-flex justify-content-center flex-column ms-auto">
                  <button type="button" class="btn btn-dark" onclick="document.getElementById('like-form-{{$post->id}}').submit();">Remove</button>
                  <form id='like-form-{{$post->id}}' action="{{route('post.like',$post->id)}}" method="POST" style="display: none">
                    @csrf
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endforeach 
      @else
      <p class="text-center">No post found</p>
      @endif

      <div class="mt-4 d-flex justify-content-center">
        {{$posts->links()}}
      </div>
    </div>
  </div>
</main>
@endsection