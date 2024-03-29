<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{asset('/'.Auth::user()->image)}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{(auth()->user()->hasRole('admin')) ? route('admin.profile.settings') : route('user.profile.settings')}}"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="#" class="dropdown-item" onclick="logOutFrom()"><i class="material-icons">input</i>Log Out</a>
                        <form action="{{route('logout')}}" method="POST" id="logout">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if (auth()->user()->hasRole('admin'))
            <li class="{{Request::is('admin/dashboard') ? 'active': ''}}"">
                <a href="{{route('dashboard')}}">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{Request::is('admin/tag*') ? 'active': ''}}">
                <a href="{{route('admin.tag.index')}}">
                    <i class="material-icons">label</i>
                    <span>Tag</span>
                </a>
            </li>
            <li class="{{Request::is('admin/category*') ? 'active': ''}}">
                <a href="{{route('admin.category.index')}}">
                    <i class="material-icons">apps</i>
                    <span>Category</span>
                </a>
            </li>
            <li class="{{Request::is('admin/post*') ? 'active': ''}}">
                <a href="{{route('admin.post.index')}}">
                    <i class="material-icons">library_books</i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="{{Request::is('admin/pending*') ? 'active': ''}}">
                <a href="{{route('admin.post.pending')}}">
                    <i class="material-icons">pending</i>
                    <span>Pending Posts</span>
                </a>
            </li>
            <li class="{{Request::is('admin/users*') ? 'active': ''}}">
                <a href="{{route('admin.users.index')}}">
                    <i class="material-icons">face</i>
                    <span>Users</span>
                </a>
            </li>
            <li class="header">System</li>
            <li class="{{Request::is('admin/settings*') ? 'active': ''}}">
                <a href="{{route('admin.profile.settings')}}">
                    <i class="material-icons">settings</i>
                    <span>Profile Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="dropdown-item" onclick="logOutFrom()">
                    <i class="material-icons">input</i>
                    <span>Log Out</span>
                </a>
                <form action="{{route('logout')}}" method="POST" id="logout">
                    @csrf
                </form>
            </li>
            @endif
            @if (auth()->user()->hasRole('user'))
            <li class="{{Request::is('user/dashboard') ? 'active': ''}}"">
                <a href="{{route('dashboard')}}">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{Request::is('user/post*') ? 'active': ''}}">
                <a href="{{route('user.post.index')}}">
                    <i class="material-icons">library_books</i>
                    <span>Posts</span>
                </a>
            </li>
            <li class="header">System</li>
            <li class="{{Request::is('user/settings*') ? 'active': ''}}">
                <a href="{{route('user.profile.settings')}}">
                    <i class="material-icons">settings</i>
                    <span>Profile Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="dropdown-item" onclick="logOutFrom()">
                    <i class="material-icons">input</i>
                    <span>Log Out</span>
                </a>
                <form action="{{route('logout')}}" method="POST" id="logout">
                    @csrf
                </form>
            </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>