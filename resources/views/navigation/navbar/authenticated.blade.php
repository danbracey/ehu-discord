<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="/home"><img src="/images/logo.png" height='70'><span style="vertical-align:middle; font-size:2vw;"> Plasma Gaming</span></a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="{{route('users')}}" class="nav-link"><i class="fas fa-search" style="padding-top: 15px"></i></a>
            </li>
            <li class="nav-item">
                <a href="{{route('xp.leaderboard')}}" class="nav-link"><i class="fas fa-trophy" style="padding-top: 15px"></i></a>
            </li>
            @isset(Auth::user()->Socials->steam)
                <li class="nav-item">
                    <a href="{{route('steam.profile', Auth::user()->Socials->steam ?? '0')}}" target="_blank" class="nav-link"><i class="fab fa-steam" style="padding-top: 15px"></i></a>
                </li>
            @endisset
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><img style="vertical-align: inherit;" src="https://cdn.discordapp.com/avatars/{{Auth::user()->id}}/{{Auth::user()->avatar}}.jpg" height="50" width="50">
                    <span class="d-none d-sm-inline">
                        <div style="display: table-cell;vertical-align: middle;line-height: 1.2;">
                            <div class="user-name">{{Auth::user()->name}}</div>
                            <div class="user-role">
                                @if(isset(Auth::user()->roles[0]) && Auth::user()->roles[0]->hex != '979c9f')
                                    <span class="label" style="background-color:#{{Auth::user()->roles[0]->hex}};color:#FFF;">{{Auth::user()->roles[0]->name}}</span>
                                @else
                                    <span class="label" style="background-color:#979c9f;color:#FFF;">Member</span>
                                @endif
                            </div>
                        </div>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="/profile" class="dropdown-item">My Profile</a>
                    @csrf
                    @switch(Auth::user()->theme)
                    @case(0)
                    <a href="/theme/1" class="dropdown-item">Light Theme</a>
                    @break
                    @case(1)
                    <a href="/theme/0" class="dropdown-item">Dark Theme</a>
                    @break
                    @default
                    <a href="/theme/0" class="dropdown-item">Light Theme</a>
                    <a href="/theme/1" class="dropdown-item">Dark Theme</a>
                    @endswitch
                    <form action="{{route ('logout')}}" method="post">
                        @csrf
                        <button class="dropdown-item">Logout</button>
                    </form>
                </div>
        </ul>
    </div>
</nav>
