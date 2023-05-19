@extends('frontend.master')

@section('title', 'Category Page')

@section('content')

<main>
    <div class="container my-4">
      <div class="row">
        <h3>Blog Categories</h3>
      </div>
      <div class="container my-4">
        <div class="row">
          @if ($categories->count() > 0)
            @foreach ($categories as $category)
            <div class="col-lg-4 my-3">
              <a href="{{route('category.posts',$category->slug)}}" class="text-decoration-none text-black">
                <div class="card h-100">
                  <img src="{{asset('/')}}images/categories/card/{{$category->image}}" class="card-img-top" alt="" />
                  <div class="card-body">
                    <h4 class="card-title text-center">{{$category->name}}</h4>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
          @else
          <p class="text-center">No Category found</p>
          @endif
        </div>
      </div>
    </div>
  </main>

@endsection