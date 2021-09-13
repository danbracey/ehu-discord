<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="/"><img src="/images/logo.png" height='70'><span style="vertical-align:middle; font-size:2vw;"> EHU Computer Science</span></a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            @if(session()->get('user'))
                <a href="{{route('logout')}}" class="btn btn-lg btn-discord"><i class="fab fa-discord"></i> Logout</a>
            @else
                <a href="{{route('login.discord')}}" class="btn btn-lg btn-discord"><i class="fab fa-discord"></i> Login</a>
            @endif
        </ul>
    </div>
</nav>
