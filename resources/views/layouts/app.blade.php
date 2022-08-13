<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/bootstrap.js') }}" defer></script> --}}
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="height: 60">
            <div class="container-fluid">
                <a class="navbar-brand px-3" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @auth
                    <p style="font: italic small-caps bold 16px/2 cursive;" class="fs-3"> hello {{Auth::user()->name}} !!</p> 
                @endauth
                <div class="d-flex">
                    @guest                   
                        <a class="nav-link px-2"  href="{{ route('login') }}">{{ __('Login') }}</a>                                          
                        <a class="nav-link px-2"  href="{{ route('register') }}">{{ __('Register') }}</a>                        
                    @else                    
                        <a class="nav-link px-2"  href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>                    
                    @endguest
                </div>
                
              
            </div>
          </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
    
    <script src="./js/app.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    @auth
    <script>
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher('34ce12ba848cc69381f4', {
        cluster: 'eu'
        });
        
        var channel = pusher.subscribe('chat');
        channel.bind('message', function(data) {
            console.log(data.message);
            let msg = data.message.msg;
            let friend = data.message.friend;
            if (data.message.sender_id=={{Auth::user()->id}}){
                let html_me =`<div class="balon1 p-2 m-0 position-relative justify-content-end" data-is="You - now">                          
                                <a class="float-right text-end"> ${msg} </a></div>`
                $('.messages').append(html_me)
            }
            if({{Auth::user()->id}}==friend.id && data.message.sender_id==friend.id){
                let html_other = `<div class="balon2 p-2 m-0 position-relative" data-is="${friend.name} - now">
                                    <a class="float-left sohbet2"> ${msg} </a></div>`
                $('.messages').append(html_other)
            }
            
            let scroll_to_bottom = document.getElementById('sohbet');
            scroll_to_bottom.scrollTop = scroll_to_bottom.scrollHeight;
        });
    </script>
    @endauth
</body>
</html>
