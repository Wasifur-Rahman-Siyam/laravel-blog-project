@extends('frontend.master')

@section('title', 'Category Page')

@section('content')

<main>
    <div class="container my-4">
      <div class="row">
        <h3>Blog Categories</h3>
      </div>
      <div class="row">
          @foreach ($categories as $category)
          <div class="col-lg-4">
            <div class="card mt-3">
              <img src="{{asset('/')}}images/categories/card/{{$category->image}}" class="card-img-top" alt="" />
              <div class="card-body">
                <a href="blogs.html" class="text-decoration-none text-black">
                  <h4 class="card-title">{{$category->name}}</h4>
                </a>
              </div>
            </div>
          </div>
          @endforeach
      </div>
    </div>
  </main>

@endsection