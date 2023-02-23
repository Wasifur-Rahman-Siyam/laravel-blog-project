
@include('backend.includs.datatable-header')
<body class="theme-black">
    <!-- Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('backend.partials.topbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('backend.partials.sidebar')
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">

        @yield('content')

    </section>

    @include('backend.includs.datatable-footer')