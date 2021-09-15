@extends('layout')
@section('title')
    Home
@endsection
@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron">
                    <h1 class="display-4">Hello, {{$User->nick}}!</h1>
                </div>
                <p>Your user ID: {{$User->user->id}}</p>
                <p>Your discriminator: #{{$User->user->discriminator}}</p>
                <p>If you haven't already, please change your server nickname to your real name!</p>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <form action="/course" method="post">
                        @csrf
                        <div class="card-header bg-white font-weight-bold">
                            Select Course
                        </div>
                        <div class="card-body">
                            <select name="course">
                                @foreach($CourseList as $CourseID => $Course)
                                    <option value="{{$CourseID}}">{{$Course['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
                            <select name="accommodation">
                                @foreach($AccommodationList as $AccommodationID => $Accommodation)
                                    <option value="{{$AccommodationID}}">{{$Accommodation['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer bg-white">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
