@if (Auth::check() && Auth::user()->id != $UserDetails->id) {{--Don't show links for users to report themselves --}}
<a href="{{route('support.create')}}" style="display:inline-block" class="btn btn-danger btn-icon" data-toggle="tooltip" title="Report User"><i class="fas fa-fw fa-exclamation-triangle"></i> Report User</a>
@endif
@if (Gate::allows('use_moderation_tools')) {{--Don't show links for users to report themselves --}}
<a href="{{route('infraction.create')}}?uid={{$UserDetails->id}}" style="display:inline-block" class="btn btn-danger btn-icon" data-toggle="tooltip" title="Ban / Warn User"><i class="fas fa-fw fa-gavel"></i></a>
@endif
@if (Gate::allows('manage_xp')) {{--Don't show links for users to report themselves --}}
<a href="/user/{{$UserDetails->id}}/xp" style="display:inline-block" class="btn btn-info btn-icon" data-toggle="tooltip" title="Add/Remove XP for this User"><i class="fas fa-fw fa-star"></i></a>
@endif
@if (Gate::allows('manage_support')) {{--Don't show links for users to report themselves --}}
<form method="post" action="/support/admin/user/tickets" style="display: inline;">
    @csrf
    <input type="hidden" name="id" value="{{$UserDetails->id}}"/>
    <button style="display:inline-block" class="btn btn-info btn-icon" data-toggle="tooltip" title="Find Support Tickets created by this user"><i class="fas fa-fw fa-question"></i></button>
</form>
@endif
@if (Gate::allows('manage_users')) {{--Don't show links for users to report themselves --}}
<a href="/discord/syncuser/{{$UserDetails->id}}" style="display:inline-block" class="btn btn-success btn-icon" data-toggle="tooltip" title="Sync user from Discord"><i class="fas fa-fw fa-sync"></i></a>
@endif
<br>
