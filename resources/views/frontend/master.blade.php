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
        <a class="navbar-brand" href="index.html"><h2>My Blog</h2></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto  mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="categories.html">Categories</a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto  mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Log In</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="profile-icon">
                  <img src="{{asset('/')}}frontend-assets/img/IMG_1043.JPG" alt="">
                </span>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Log Out</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </nav>


    @yield('content')

    <!--Footer section  -->
    <footer class="w-100 bg-dark">
      <div class="container text-white py-4">
        <div class="row text-center">
          <p class="mb-0">&copy; Designed by Md. Wasifur Rahman Siyam</p>
        </div>
      </div>
    </footer>
    <script src="{{asset('/')}}frontend-assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/45f49eb8bc.js" crossorigin="anonymous"></script>
  </body>
</html>
