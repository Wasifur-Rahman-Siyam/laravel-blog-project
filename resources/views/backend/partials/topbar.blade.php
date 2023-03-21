<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{route('home')}}">Larave Blog Project - Home</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li>
                    <a href="{{(auth()->user()->hasRole('admin')) ? route('admin.notifications') : route('user.notifications')}}">
                        <i class="material-icons" style="font-size: 3rem">notifications</i>
                        <span class="label-count" style="font-size: 1.4rem">{{auth()->user()->unreadNotifications->count();}}</span>
                    </a>
                </li>
                <!-- #END# Notifications -->
            </ul>
        </div>
    </div>
</nav>