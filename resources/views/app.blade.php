<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>SH league</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/common.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' href='{{ asset('css/print.css') }}' media='print' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('scripts/utils.js') }}"></script>
    <!-- MOZZILLA FIREFOX DATEPICKER -->
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script>
        webshims.setOptions('waitReady', false);
        webshims.setOptions('forms-ext', {types: 'date'});
        webshims.polyfill('forms forms-ext');
    </script>
    <!-- END OF MOZZILLA FIREFOX DATEPICKER -->
</head>

<body>
<div class="container">
    <div class="navbar text-center">
        <h1>SH League administration</h1>
        <nav class="menu text-vert-center text-center">
            <ul class="menu-items">
                <li>
                    <a href="/" >{{trans('messages.home')}}</a>
                </li>
                <li>
                    <a href="/users" >{{trans('messages.users')}}</a>
                </li>
                <li>
                    <a href="/leagues" >{{trans('messages.leagues')}}</a>
                </li>
                <li>
                    <a href="/tournaments" >{{trans('messages.tournaments')}}</a>
                </li>
                <li>
                    <a href="/teams">{{trans('messages.teams')}}</a>
                </li>
                <li>
                    <a href="/help">{{trans('messages.help')}}</a>
                </li>
            </ul>
        </nav>
    </div>
    @if(Auth::check())
    <div class="logged-user-div">
        <img src="@if(!is_null(Auth::user()->avatar) && !empty(Auth::user()->avatar)){{ asset('images/'.Auth::user()->avatar)}}@else{{asset('images/guest.png')}}@endif" alt="user avatar">
        <div class="user-info text-vert-center">
            <div>
            {{Auth::user()->nickname}}@if(Auth::user()->hasRole('admin'))(A)@endif<br>
            <a href="{{URL::to('users/show/'.Auth::user()->id)}}" class="" >{{trans('messages.details')}}</a><br>
            <a href="{{URL::to('auth/logout/')}}" class="" >{{trans('messages.logout')}}</a>
            </div>
        </div>
    </div>
    @else
        <div class="logged-user-div">
            <img src="{{asset('images/guest.png')}}" alt="guest">
            <div class="user-info text-vert-center">
                <div>
                    <a href="{{URL::to('auth/login')}}">{{trans('messages.login')}}</a><br>
                    <a href="{{URL::to('auth/register')}}">{{trans('messages.register')}}</a>
                </div>
            </div>
        </div>
    @endif

@yield('content')
</body>
</html>
