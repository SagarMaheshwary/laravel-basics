<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- asset() helper is used to generate urls to assets from the public directory --}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <style>
        /*
            these styles will animate bootstrap alerts.
        */
        .alert{
            z-index: 99;
            top: 60px;
            right:18px;
            min-width:30%;
            position: fixed;
            animation: slide 0.5s forwards;
        }

        @keyframes slide {
            100% { top: 30px; }
        }

        @media screen and (max-width: 668px) {
            .alert{ /* center the alert on small screens */
                left: 10px;
                right: 10px; 
            }
        }
    </style>

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
    
    {{-- Flash Message --}}
    @if(session('status')) {{-- <- If session key exists --}}
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('status')}} {{-- <- Display the session value --}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <script>
        //close the alert after 3 seconds.
        $(document).ready(function(){
			setTimeout(function() {
	        	$(".alert").alert('close');
	    	}, 3000);
    	});
    </script>
    
</body>
</html>