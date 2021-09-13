<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    {{-- Which theme should be returned to the user? --}}
    <link rel="stylesheet" href="/css/dark/darktheme.css">
    <link rel="stylesheet" href="/css/bootadmin.min.css?v=2">

    <script src='/js/moment.min.js' defer></script>
    <script src="/js/jquery-ui.custom.min.js" defer></script>
    <script src='/js/fullcalendar.min.js' defer></script>
    <link rel="stylesheet" href="/css/fullcalendar.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js" defer></script>
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
    <div class="d-flex">
    @include ('navigation.sidebar.public')
@endguest
@auth
    @include ('navigation.navbar.authenticated')
    <div class="d-flex">
    @include ('navigation.sidebar.authenticated')
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
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/datatables.min.js"></script>
<script src="/js/bootadmin.min.js"></script>
@yield('footer')
<script>
$(document).ready( function () {
    $('#example').DataTable();
    $('textarea').summernote({
        callbacks: {
            onImageUpload: function (data) {
                data.pop();
            },
            onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            }
        },
        disableDragAndDrop: true,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['fontfamily','fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['fullscreen', ['fullscreen']],
            ['insert', ['link']]
        ]
    });
} );
</script>
</body>
</html>
