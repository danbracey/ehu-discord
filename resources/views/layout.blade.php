<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    {{-- Which theme should be returned to the user? --}}
    <link rel="stylesheet" href="/css/dark/darktheme.css">
    <link rel="stylesheet" href="/css/bootadmin.min.css?v=2">
    <style>
        @yield('css')
    </style>

    {{-- Open Graph Metadata --}}
    <meta charset="utf-8" />
    <meta property="og:title" content="EHU Computer Science" />
    <meta property="og:site_name" content="EHU Computer Science" />
    <meta property="og:image" content="/images/plasma_logo.png"/>
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="500" />

    <title>@yield('title') | EHU Computer Science</title>
</head>
<body class="bg-light">
{{-- Navigation --}}
@guest
    @include ('navigation.navbar.public')
@endguest
@auth
    @include ('navigation.navbar.authenticated')
@endauth
<div class="content p-4">
    {{-- Session Alerts --}}
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('info'))
        <div class="alert alert-info alert-dismissible">{{ Session::get('info') }}</div>
    @endif
    @if (Session::has('warning'))
        <div class="alert alert-info alert-dismissible">{{ Session::get('warning') }}</div>
    @endif
    @if (Session::has('danger'))
        <div class="alert alert-danger alert-dismissible">{{ Session::get('danger') }}</div>
    @endif
    <div class="text-center mb-4">
    </div>
@yield('content')
</div>
@yield('footer')
</body>
</html>
