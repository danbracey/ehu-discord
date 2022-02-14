@extends('layout')
@section('title')
    Home
@endsection
@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="jumbotron">
            <h1 class="display-4">Hello, {{$User->nick}}!</h1>
            <hr class="my-4">
            <p>Your user ID: {{$User->user->id}}</p>
            <p>Your discriminator: #{{$User->user->discriminator}}</p>
            <p>If you haven't already, please change your server nickname to your real name!</p>
        </div>
        <div class="row">
            @if(! in_array(912824895522627644 , $User->roles))
            <div class="col-md-3">
                <div class="card mb-3">
                    <form action="/course" method="post">
                        @csrf
                        <div class="card-header bg-white font-weight-bold">
                            Select Course
                        </div>
                        <div class="card-body">
                            <select name="course" class="form-control">
                                @foreach($CourseList as $CourseID => $Course)
                                    <option value="{{$CourseID}}">{{$Course['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <form action="/year" method="post">
                        @csrf
                        <div class="card-header bg-white font-weight-bold">
                            Select Year of Study
                        </div>
                        <div class="card-body">
                            <select name="year" class="form-control">
                                @foreach($YearOfStudyList as $YearID => $Year)
                                    <option value="{{$YearID}}">{{$Year['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <form action="{{route('accommodation')}}" method="post">
                        @csrf
                        <div class="card-header bg-white font-weight-bold">
                            Select Accommodation<br>
                        </div>
                        <div class="card-body">

                            <select name="accommodation" class="form-control">
                                @foreach($AccommodationList as $AccommodationID => $Accommodation)
                                    <option value="{{$AccommodationID}}">{{$Accommodation['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @if(! in_array(912824895522627644 , $User->roles))
            <div class="col-md-3">
            @else
            <div class="col-md-12">
                <div class="alert alert-info">Courses, Accommodation & Year of Study options are not accessible by Staff. Please choose the modules you are interested in/teach below to access these.</div>
                @endif
                <div class="card mb-3">
                    <form action="{{route('module')}}" method="post">
                        @csrf
                        <div class="card-header bg-white font-weight-bold">
                            Module Chats<br>
                        </div>
                        <div class="card-body">
                            @foreach($ModuleList as $ModuleID => $Module)
                                @if(in_array($ModuleID, $User->roles))
                                <input type="checkbox" name="module_choice[]" value="{{$ModuleID}}" id="{{$ModuleID}}" style="margin-right: 5px" checked><label for="{{$ModuleID}}">{{$Module['name']}}</label><br>
                                @else
                                <input type="checkbox" name="module_choice[]" value="{{$ModuleID}}" id="{{$ModuleID}}" style="margin-right: 5px"><label for="{{$ModuleID}}">{{$Module['name']}}</label><br>
                                @endif
                            @endforeach
                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
