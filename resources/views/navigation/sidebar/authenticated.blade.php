<div class="sidebar sidebar-dark bg-dark">
    <ul class="list-unstyled">
        <li class="{{ Request::path() === 'home' ? 'active' : ''}}"><a href="/"><i class="fa fa-fw fa-home"></i> Home</a></li>
        @cannot('create_news')
        <li class="{{ Request::path() === 'news' ? 'active' : ''}}"><a href="/news"><i class="fas fa-fw fa-newspaper"></i> News</a></li>
        @else {{-- If they can create news --}}
        <li>
            <a href="#news" data-toggle="collapse">
                <i class="fas fa-fw fa-newspaper"></i> News
            </a>
            <ul id="news" class="list-unstyled collapse">

                <li><a href="{{route('news')}}"> View News</a></li>
                <li><a href="{{route('news.create')}}"><i class="fas fa-fw fa-plus"></i> Create News</a></li>
            </ul>
        </li>
        @endcannot
        @cannot('manage_rules')
        <li class="{{ Request::path() === 'rules' ? 'active' : ''}}"><a href="/rules"><i class="fas fa-fw fa-user-shield"></i> Rules</a></li>
        @else
        <li>
            <a href="#rulesets" data-toggle="collapse">
                <i class="fas fa-fw fa-user-shield"></i> Rules
            </a>
            <ul id="rulesets" class="list-unstyled collapse">

                <li><a href="{{route('rules')}}"> View Rules</a></li>
                <li><a href="{{route('rules.create')}}"><i class="fas fa-fw fa-lock"></i> Create Rules</a></li>
            </ul>
        </li>
        @endcannot
        @cannot('access_vtc')
            <li class="{{ Request::path() === 'vtc' ? 'active' : ''}}"><a href="/vtc"><i class="fas fa-fw fa-truck"></i> Plasma Trucking</a></li>
        @else
            <li class="{{ Request::path() === 'vtc' ? 'active' : ''}}">
                <a href="#vtc" data-toggle="collapse">
                    <i class="fas fa-fw fa-truck"></i> Plasma Trucking
                    @if(Gate::allows('manage_vtc'))
                        @if($PendingJobsCount > 0)
                            <span class="badge badge-light">{{$PendingJobsCount}}</span>
                        @endif
                    @endif
                </a>
                <ul id="vtc" class="list-unstyled collapse">

                    <li><a href="{{route('vtc.index')}}"><i class="fa fa-fw fa-truck-loading"></i> VTC Home</a></li>
                    <li><a href="{{route('vtc.create')}}"><i class="fas fa-fw fa-plus"></i> Add New Job</a></li>
                    <li><a href="{{route('vtc.jobslist')}}"><i class="fa fa-fw fa-search"></i> View Jobs</a></li>
                    <li><a href="{{route('vtc.locations')}}"><i class="fas fa-fw fa-map-marker-alt"></i> Locations</a></li>
                    <li><a href="{{route('vtc.drivers.division', "casual")}}"><i class="fa fa-fw fa-user"></i> Casual Drivers</a></li>
                    <li><a href="{{route('vtc.drivers.division', "simulation")}}"><i class="fa fa-fw fa-user"></i> Simulation Drivers</a></li>
                    <li><a href="{{route('vtc.leaderboard')}}"><i class="fa fa-fw fa-trophy"></i> Leaderboard</a></li>
                    <li><a href="{{route('vtc.missions')}}"><i class="fa fa-fw fa-star"></i> Missions</a></li>
                    @can('manage_vtc')
                    <li><a href="{{route('vtc.missions.create')}}"><i class="fa fa-fw fa-certificate"></i> Create Mission</a></li>
                    @endcan
                </ul>
            </li>
        @endcannot
        @cannot('manage_events')
            <li class="{{ Request::path() === 'events' ? 'active' : ''}}"><a href="/events"><i class="fas fa-fw fa-calendar-day"></i> Events</a></li>
        @else
            <li class="{{ Request::path() === 'events' || Request::path() === 'events/pending' ? 'active' : ''}}">
                <a href="#events" data-toggle="collapse">
                    <i class="fas fa-fw fa-calendar-day"></i> Events & Tournaments
                    @if($PendingEventsCount)
                        <span class="badge badge-light">{{$PendingEventsCount}}</span>
                    @endif
                </a>
                <ul id="events" class="list-unstyled collapse">
                    <li><a href="{{route('events')}}">Events</a></li>
                    <li><a href="{{route('events.pending')}}">Pending Events</a></li>
                </ul>
            </li>
        @endcannot
        <li class="{{ Request::path() === 'giveaways' ? 'active' : ''}}"><a href="/giveaways"><i class="fas fa-fw fa-gift"></i> Giveaways</a></li>
        <li>
            <a href="#support" data-toggle="collapse">
                <i class="fas fa-fw fa-life-ring"></i> Support / Contact Us
                @can('manage_support')
                    @if($OpenSupportTickets > 0)
                        <span class="badge badge-light">{{$OpenSupportTickets}}</span>
                    @endif
                @endcan
            </a>
            <ul id="support" class="list-unstyled collapse">
                <li><a href="{{route('support.index')}}"> Support</a></li>
                @can('upper_staff')
                    <li><a href="{{route('support.triage')}}"> Triage Queue</a></li>
                @endcan
                @can('manage_support')
                    <li><a href="{{route('support.admin')}}"> Support Admin</a></li>
                @endcan
            </ul>
        </li>
        <li>
            <a href="#recruit" data-toggle="collapse">
                <i class="fas fa-fw fa-briefcase"></i> Recruitment
            </a>
            <ul id="recruit" class="list-unstyled collapse">
                <li><a href="{{route('recruitment.index')}}"> View Recruitment</a></li>
                @can('manage_recruitment')
                <li><a href="{{route('recruitment.create')}}"><i class="fas fa-fw fa-lock"></i> Add New Recruitment</a></li>
                @endcan
            </ul>
        </li>
        @cannot('manage_status')
        <li class="{{ Request::path() === 'status' ? 'active' : ''}}"><a href="/status"><i class="fas fa-fw fa-server"></i> Network Status</a></li>
        @else
        <li class="{{ Request::path() === 'status' || Request::path() === 'status/manage' ? 'active' : ''}}">
            <a href="#status" data-toggle="collapse">
                <i class="fas fa-fw fa-server"></i> Network Status
            </a>
            <ul id="status" class="list-unstyled collapse">
                <li><a href="{{route('status')}}">Network Status</a></li>
                <li><a href="{{route('status.manage')}}" >Manage Status</a></li>
            </ul>
        </li>
        @endcannot
        <li>
            <a href="#donate" data-toggle="collapse">
                <i class="fas fa-fw fa-gem" style="color:goldenrod"></i> Support Plasma
            </a>
            <ul id="donate" class="list-unstyled collapse">
                <li><a href="https://www.patreon.com/plasmagaming" target="_blank"><i class="fab fa-fw fa-patreon"></i> Patreon</a></li>
                <li><a href="https://www.paypal.com/paypalme/plasmagc" target="_blank"><i class="fab fa-fw fa-paypal"></i> Paypal</a></li>
            </ul>
        </li>
        @can('use_project_manager')
            <li class="{{ Request::path() === 'projects' || Request::path() === 'project' ? 'active' : ''}}"><a href="/projects"><i class="fa fa-fw fa-clipboard-check"></i> Project Management</a></li></li>
        @endcannot
        <li>
            <a href="#users" data-toggle="collapse">
                <i class="fas fa-fw fa-users"></i> Users
            </a>
            <ul id="users" class="list-unstyled collapse">
                <li><a href="{{route('users')}}">View Users</a></li>
            </ul>
        </li>
        @can('use_inactivity')
            <li class="{{ Request::path() === 'inactivity' ? 'active' : ''}}"><a href="/inactivity"><i class="fas fa-fw fa-clock"></i> Inactivity / LOA</a></li>
        @endcan
        <li class="{{ Request::path() === 'terms' || Request::path() === 'privacy'  ? 'active' : ''}}">
            <a href="#terms" data-toggle="collapse">
                <i class="fa fa-fw fa-newspaper"></i> Terms & Privacy
            </a>
            <ul id="terms" class="list-unstyled collapse">
                <li><a href="{{route('terms')}}">Terms of Service</a></li>
                <li><a href="{{route('privacy')}}" >Privacy Policy</a></li>
            </ul>
        </li>
        @cannot('use_discord_tools')
            <li><a href="https://discord.plasmagc.com"><i class="fab fa-fw fa-discord"></i> Discord</a></li>
        @else
            <li class="{{ Request::path() === 'discord' || Request::path() === 'discord/bans' ? 'active' : ''}}">
                <a href="#tools" data-toggle="collapse">
                    <i class="fas fa-fw fa-tools"></i> Community Tools
                </a>
                <ul id="tools" class="list-unstyled collapse">
                    <li><a href="{{route('discord.rolesync')}}">Sync Discord roles</a></li>
                    <li><a href="{{route('discord.bans')}}">Manage Discord Bans</a></li>
                    <li><a href="{{route('discord.roles')}}">View Server Roles</a></li>
                </ul>
            </li>
        @endcannot
    </ul>
</div>
