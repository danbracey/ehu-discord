@extends('layout')
@section('title')
    500
@endsection
@section('content')
        <h2 class="mb-4">500 - Oh Noot! / Internal Server Error</h2>

        <div class="card mb-4">
            <div class="card-body">
                {{ $exception->getMessage() }}
            </div>
        </div>
@endsection
