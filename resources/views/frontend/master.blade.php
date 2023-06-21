<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="{{asset('/')}}frontend-assets/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{asset('/')}}frontend-assets/css/style.css" />

    <title>@yield('title')</title>
  </head>
  <body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"><div class="site-logo"><img src="{{asset('/')}}frontend-assets/img/logo.png" alt=""></div></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto  mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('categories')}}">Categories</a>
            </li>
            @if (Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="{{route('post.liked')}}">Liked Posts</a>
            </li>
            @endif
          </ul>

          <form class="d-flex m-auto" action="{{route('search')}}" method="GET">
            @csrf
            <input class="form-control me-2" type="search" name='search' placeholder="Search" aria-label="Search" style="width: 22rem">
            <button class="btn btn-dark" type="submit"><i class="fa fa-search"></i></button>
          </form>


          <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">

            @if (!Auth::check())
            <li class="nav-item">
              <a class="nav-link text-white" href="{{route('login')}}">Log In</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{route('register')}}">Register</a>
            </li>
            @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="profile-icon">
                  <img src="{{asset('/'.Auth::user()->image)}}" alt="">
                </span>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a href="#" class="dropdown-item" onclick="logOutFrom()">Logout</a>
                      <form action="{{route('logout')}}" method="POST" id="logout">
                        @csrf
                      </form>
                </li>
              </ul>
            </li>
            @endif
          </ul>

          
        </div>
      </div>
    </nav>


    @yield('content')

    <!--Footer section  -->
    <footer class="w-100 bg-dark">
      <div class="container text-white py-4">
        <div class="row text-center">
          <p class="mb-0">&copy; {{ config('app.name') }} All Right Reserved.</p>
          <p class="mb-0">Designe & Develop by Md. Wasifur Rahman Siyam</p>
        </div>
      </div>
    </footer>
    <script>
      function logOutFrom(){
          event.preventDefault();
          var from = document.getElementById("logout");
          from.submit();
      }
  </script>
    <script src="{{asset('/')}}frontend-assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/45f49eb8bc.js" crossorigin="anonymous"></script>
  </body>
</html>
