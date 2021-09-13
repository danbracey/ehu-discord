@extends('layout')
    @section('title')
        {{$UserDetails->name}}'s Profile
    @endsection
@section('content')
<h2 class="mb-4">{{$UserDetails->name}}'s Profile</h2>
@if(isset($GetLatestInfraction) && $GetLatestInfraction->expired_at < today() && $GetLatestInfraction->type == 2)
    <div class="alert alert-danger" role="alert">
        This user is currently banned
    </div>
    <br/>
@endif
@if(isset($ActiveInactivity))
    <div class="alert alert-info" role="alert">
        This user is on Inactivity. Reason provided by user: {{$ActiveInactivity->reason}}
    </div>
    <br/>
@endif
<div class="row mb-4">
    <div class="col col-auto"> {{-- Left Sidebar --}}
        <img src="https://cdn.discordapp.com/avatars/{{$UserDetails->id}}/{{$UserDetails->avatar}}.jpg">
        <br/><br/>
        @include('users.modules.buttons')
        @foreach($UserDetails->roles as $role)
            @if($role->hex != '979c9f')
            <span class="label" style="background-color:#{{$role->hex}};color:#FFF;">{{$role->name}}</span>
            @endif
        @endforeach
        <br/><br/>
    </div>
    <div class="col">
        @include('users.modules.about')
    </div>
    <div class="col">
        @include('users.modules.social')
    </div>
</div>
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                Moderation history for {{$UserDetails->name}}
            </div>
            <div class="card-body">
                <div class="page-header">
                    @foreach($UserInfractions as $Infraction)
                        @switch ($Infraction->type)
                            @case(1)
                            <h5>Warning @ {{$Infraction->created_at}}</h5>
                            @break
                            @case(2)
                            <h5>Ban @ {{$Infraction->created_at}}</h5>
                            @break
                            @case(3)
                            <h5>Mute @ {{$Infraction->created_at}}</h5>
                            @break
                            @case(4)
                            <h5>Kick @ {{$Infraction->created_at}}</h5>
                            @break
                            @default
                            <h5>Error</h5>
                        @endswitch
                            <strong>Reason:</strong> {{$Infraction->reason}}<br>
                            <strong>Expires:</strong> {{$Infraction->expires_at ?? 'Unknown'}}
                            @if ($Infraction->active == 1 && $Infraction->expires_at > now())
                                <td><i class="fa fa-circle text-danger" data-toggle="tooltip" data-original-title="Active"></i></td>
                            @elseif($Infraction->active == 1 && $Infraction->expires_at < now())
                                <td><i class="fa fa-circle text-warning" data-toggle="tooltip" data-original-title="Active, Expired"></i></td>
                            @else
                                <td><i class="fa fa-circle text-secondary" data-toggle="tooltip" data-original-title="Inactive"></i></td>
                            @endif<br>
                            <strong>Issued By:</strong> <a href="/user/{{$Infraction->staff_uid}}">{{$Infraction->staff->name}} @if(isset($Infraction->staff->roles[0]) && $Infraction->staff->roles[0]->hex != '979c9f')<span class="badge" style="background-color:#{{$Infraction->staff->roles[0]->hex}};color:#FFF;">{{$Infraction->staff->roles[0]->name}}</span>@endif</a><br>
                            @if($Infraction->evidence)
                                <a href="{{$Infraction->evidence}}" style="display:inline-block" class="btn btn-primary btn-icon" data-toggle="tooltip" title="View Evidence"><i class="fas fa-fw fa-external-link-alt"></i></a>
                            @else
                                <button style="display:inline-block; cursor:not-allowed;" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="No evidence has been provided for this infraction"><i class="fas fa-fw fa-external-link-alt"></i></button>
                            @endif
                            @if ($Infraction->staff_uid == Auth::user()->id)
                                @can('use_moderation_tools')
                                <form method="post" style="display:inline" action="/infraction/edit">@csrf
                                    <input type="hidden" name="InfractionID" value="{{$Infraction->id}}">
                                    <button type="submit" style="display:inline-block" class="btn btn-warning btn-icon" data-toggle="tooltip" title="Edit Infraction"><i class="fas fa-fw fa-pencil-alt"></i></button>
                                </form>
                                @endcan
                            @endif
                            <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                User XP History
            </div>
            <div class="card-body">
                <table id="xp_history" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Date Earnt</th>
                        <th>XP Gained</th>
                        <th>Given By</th>
                        <th>Reason</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($UserDetails->XPHistory() as $XP)
                        <tr>
                            <td>{{$XP->created_at ?? 'No Record'}}</td>
                            <td>{{$XP->points ?? '0'}} XP</td>
                            <td><a href="/user/{{$XP->given_by_uid ?? env('CLIENT_ID')}}">{{$XP->given_by->name ?? 'Unknown User'}}</a></td>
                            <td>{{$XP->reason ?? 'Unknown Reason'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- End of Row -->
@endsection
@section('footer')
    <script>
        $(document).ready( function () {
            $('#xp_history').DataTable();
        } );
    </script>
@endsection
