<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- asset() helper is used to generate urls to assets from the public directory --}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>@yield('title','Laravel 5.8 Basics')</title>
</head>
<body>

    {{-- That's how you write a comment in blade --}}
    
    {{-- Navbar --}}
    @include('inc.navbar')
    <main class="container mt-4">
        {{-- content from the view that extends this layout --}}
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('inc.footer')

    <script src="{{asset('js/app.js')}}"></script>
    
</body>
</html>