<div class="card mb-4">
    <div class="card-header bg-white font-weight-bold">
        Social Information
    </div>
    <div class="card-body">
        <form action="#" method="post">
            @csrf
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Steam</label>
                @if(Auth::check() && $UserDetails->id == Auth::user()->id)
                    @isset(Auth::user()->socials->steam)
                        <div class="col-sm-10">
                            <a href="{{route('steam.profile', Auth::user()->socials->steam)}}">{{Auth::user()->socials->steam}}</a>
                            <a href="{{route('steam.auth')}}" class="btn btn-secondary"><i class="fab fa-steam"></i> Update</a>
                        </div>
                    @else
                        <div class="col-sm-10">
                            <a href="{{route('steam.auth')}}" class="btn btn-secondary"><i class="fab fa-steam"></i> Login with Steam</a>
                        </div>
                    @endif
                @else
                    @isset($UserSocials->steam)
                        <div class="col-sm-10 col-form-label">
                            <a href="{{route('steam.profile', $UserSocials->steam)}}">{{$UserSocials->steam}}</a>
                        </div>
                    @else
                        <div class="col-sm-10 col-form-label">
                            <p class="form-control">This user has not linked their Steam account</p>
                        </div>
                    @endif
                @endisset
            </div>
        </form>
        @isset($UserSocials->tmp_id)
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">TruckersMP ID</label>
            <div class="col-sm-10 col-form-label">
                <a href="{{route('truckersmp.profile', $UserSocials->tmp_id)}}">{{$UserSocials->tmp_id}}</a>
                <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="This data is automatically pulled through by connecting to Steam"></i>
            </div>
        </div>
        @endisset
    </div>
</div>
