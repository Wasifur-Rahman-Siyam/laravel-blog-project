@extends('frontend.master')

@section('title', 'Category Page')

@section('content')

<main>
    <div class="container my-4">
      <div class="row">
        <h3>Blog Categories</h3>
      </div>
      <div class="row">

        <div class="col-lg-4">
          <div class="card mt-3">
            <img src="{{asset('/')}}frontend-assets/img/1.jpg" class="card-img-top" alt="" />
            <div class="card-body">
              <a href="blogs.html" class="text-decoration-none text-black">
                <h4 class="card-title">Blog Post 1</h4>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias,
                    quisquam ratione? Ea natus magni omnis?....
                </p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection