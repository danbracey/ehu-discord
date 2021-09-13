@extends('layout')
@section('title')
    Users
@endsection
@section('css')
    .card-box {
    padding: 20px;
    border-radius: 3px;
    margin-bottom: 30px;
    }

    .thumb-lg {
    height: 88px;
    width: 88px;
    }
    .img-thumbnail {
    padding: .25rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: .25rem;
    max-width: 100%;
    height: auto;
    }

    h4 {
    line-height: 22px;
    font-size: 18px;
    }
@endsection
@section('content')
    @empty($request->title)
        <h2 class="mb-4">User / Role Search</h2>
    @else
        <h2 class="mb-4">Your search results for {{$request->title}}</h2>
    @endempty

<div class="card mb-4">
    <div class="card-body">
            @csrf
            @foreach($errors->all() as $message)
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
            @endforeach
            <div class="row">
                <div class="col">
                    Search for a user...
                    <form method="post" action="/users">
                    <div class="form-group">@csrf
                        <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="Username, ID or Discriminator" value="{{$request->title}}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-lg mt-3 mt-lg-4">Search</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col">
                    Show all registered users with the following role...
                    <div class="form-group">
                        <form method="post" action="/users">@csrf
                            <select name="roles" class="form-control form-control-lg">
                                    <option value="0" style="background-color:#{{$Role->hex ?? '333'}};color:#FFF;">Choose a role</option>
                                    @foreach($Roles as $Role)
                                    <option value="{{$Role->id}}" style="background-color:#{{$Role->hex ?? '333'}};color:#FFF;">{{$Role->name}}</option>
                                    @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary btn-lg mt-3 mt-lg-4">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

<div class="row">
    @if ($results)
            @foreach($results as $user)
                @if($user->enabled == 1)
                    <div class="col-lg-3">
                        <div class="text-center card card-box">
                            <div class="member-card pt-2 pb-2">
                                <div class="thumb-lg member-thumb mx-auto"><img src="https://cdn.discordapp.com/avatars/{{$user->id ?? '322293880802246657'}}/{{$user->avatar ?? 'adb8e8d4840fec380f93e4a5127a7505'}}.jpg" class="rounded-circle img-thumbnail" alt="profile-image"></div>
                                <div class="">
                                    <h4><a href="/user/{{$user->id}}">{{$user->name}}</a></h4>
                                    @if(isset($user->roles[0]) && $user->roles[0]->hex != '979c9f')<span class="label" style="background-color:#{{$user->roles[0]->hex}};color:#FFF;">{{$user->roles[0]->name}}</span>@endif
                                    <br>
                                </div>
                                <i>{!! $user->about !!}</i>
                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mt-3">
                                                <h4>{{$user->XP()->sum('points')}}</h4>
                                                <p class="mb-0 text-muted">XP</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mt-3">
                                                @if (Gate::allows('use_moderation_tools')) {{--Don't show links for users to report themselves --}}
                                                <a href="/infraction/create?uid={{$user->id}}" style="display:inline-block" class="btn btn-danger btn-icon" data-toggle="tooltip" title="Ban / Warn User"><i class="fas fa-fw fa-gavel"></i></a>
                                                @endif
                                                @if (Gate::allows('manage_xp')) {{--Don't show links for users to report themselves --}}
                                                <a href="/user/{{$user->id}}/xp" style="display:inline-block" class="btn btn-info btn-icon" data-toggle="tooltip" title="Add/Remove XP for this User"><i class="fas fa-fw fa-star"></i></a>
                                                @endif
                                                @if (Gate::allows('manage_support')) {{--Don't show links for users to report themselves --}}
                                                <form method="post" action="/support/admin/user/tickets" style="display: inline;">@csrf
                                                    <input type="hidden" name="id" value="{{$user->id}}"/>
                                                    <button style="display:inline-block" class="btn btn-info btn-icon" data-toggle="tooltip" title="Find Support Tickets created by this user"><i class="fas fa-fw fa-question"></i></button>
                                                </form>
                                                @endif
                                                @if (Gate::allows('manage_users')) {{--Don't show links for users to report themselves --}}
                                                <a href="/discord/syncuser/{{$user->id}}" style="display:inline-block" class="btn btn-success btn-icon" data-toggle="tooltip" title="Sync user from Discord"><i class="fas fa-fw fa-sync"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @empty($results)
            <div class="alert alert-danger" role="alert">
                No users were found with this query
            </div>
        @endempty
    @endif
</div>
@endsection
