@extends('layout')
@section('title')
    403
@endsection
@section('content')
        <h2 class="mb-4">403 - Forbidden</h2>

        <div class="card mb-4">
            <div class="card-body">
                {{ $exception->getMessage() }}
            </div>
        </div>
@endsection
