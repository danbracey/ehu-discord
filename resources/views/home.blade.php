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
                                <option value="878625591425908767">CM17 - Computer Science & Mathematics</option>
                                <option value="878625447427055647">CS12 - Computer Science</option>
                                <option value="878625645557612586">G401 - Computing</option>
                                <option value="878988527122120734">GH76 - Robotics & Artificial Intelligence</option>
                                <option value="878625867453050920">GI11 - Data Science</option>
                                <option value="878625531552215110">I1I4 - Computer Science & Artificial Intelligence</option>
                                <option value="878625750377463810">I290 - Computing (Networking, Security and Forensics)</option>
                                <option value="878625687899078676">I610 - Computing (Games Programming)</option>
                                <option value="878989312505552976">II33 - Software Engineering</option>
                                <option value="878625966300217457">W4D7 - Web Design & Development</option>
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
                                <option value="884499064438263809">Chancellors Court</option>
                                <option value="884499127239598160">Chancellors South</option>
                                <option value="884499188514160701">Founders East</option>
                                <option value="884499203290705960">Founders West</option>
                                <option value="884499230486577242">Palatine Court</option>
                                <option value="884499271058088026">Graduates Court</option>
                                <option value="884499307498192896">Forest Court</option>
                                <option value="884499357527851009">Back Halls</option>
                                <option value="884499396056727644">Main Halls</option>
                                <option value="884499426234748939">Woodland Court</option>
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
