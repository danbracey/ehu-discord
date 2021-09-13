<div class="card mb-4">
    <div class="card-header bg-white font-weight-bold">
        About {{$UserDetails->name}}
    </div>
    <div class="card-body">
        @if(Auth::check() && Auth::user()->id == $UserDetails->id || Gate::allows('manage_users'))
            <form action="/user/{{$UserDetails->id}}/about" method="post">
                @csrf
                <textarea class="form-control" id="about" name="about" rows="3">{{$UserDetails->about}}</textarea>
                <br/>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        @elseif(empty($UserDetails->about)) {{--If the user hasn't provided their about me, show a friendly message rather than nothing--}}
        <p><i>This user hasn't provided an about me section...</i></p>
        @else
            {!! $UserDetails->about !!}
        @endif
    </div>
</div>
@can('add_user_notes')
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Staff Notes - {{$UserDetails->name}}
        </div>
        <div class="card-body">
            <form action="/user/{{$UserDetails->id}}/notes" method="post">
                @csrf
                <textarea class="form-control" id="UserNotes" name="UserNotes" rows="3">{!! $UserDetails->UserNotes !!}</textarea>
                <br/>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endcan
