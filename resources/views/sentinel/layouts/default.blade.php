<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>@yield('title')</title>

    <!-- CSS  -->
    <link href="{{ asset('packages/rydurham/sentinel/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('packages/rydurham/sentinel/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="dist/sweetalert.css">
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="{{ asset('packages/rydurham/sentinel/js/materialize.min.js') }}"></script>
    <script src="{{ asset('packages/rydurham/sentinel/js/restfulizer.js') }}"></script>
<<<<<<< HEAD
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="countdown/jquery.countdown.js"></script>
    <script type="text/javascript" src="js/jquery.keepFormData.min.js"></script>
    <script src="dist/sweetalert.min.js"></script>
    <script>window.jQuery || document.write(unescape('%3Cscript type="text/javascript" src="jquery-2.1.0.min.js">%3C/script>'))</script>
=======
    <script src="countdown/jquery.countdown.js"></script>
    <script src="dist/sweetalert.min.js"></script>
>>>>>>> 7c418c3449949bd902fa4a63587579f395846ec9
</head>

<body>
    <nav class="red lighten-1" role="navigation">
        <div class="container">
<<<<<<< HEAD
            <div class="nav-wrapper"><a id="logo-container" href="{{ route('home') }}" class="brand-logo">DheZign</a>
=======
            <div class="nav-wrapper"><a id="logo-container" href="{{ route('home') }}" class="brand-logo">Sentinel</a>
>>>>>>> 7c418c3449949bd902fa4a63587579f395846ec9
                <ul id="nav-mobile" class="right side-nav">
                    @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
                        <li {!! (Request::is('users*') ? 'class="active"' : '') !!}><a href="{{ route('sentinel.users.index') }}">Users</a></li>
                        <li {!! (Request::is('groups*') ? 'class="active"' : '') !!}><a href="{{ route('sentinel.groups.index') }}">Groups</a></li>
                    @endif
                    @if (Sentry::check())
<<<<<<< HEAD
                        @if (Sentry::getUser()->hasAccess('admin'))
                            <li {!! (Request::is('profile') ? 'class="active"' : '') !!}>
                                <a href="{{ route('sentinel.profile.show') }}">{{ Sentry::getUser()->email }}</a>
                            </li>
                        @else
                            <li {!! (Request::is('profile') ? 'class="active"' : '') !!}>
                                    {{ Sentry::getUser()->email }}
                            </li>
                        @endif
=======
                        <li {!! (Request::is('profile') ? 'class="active"' : '') !!}>
                            <a href="{{ route('sentinel.profile.show') }}">{{ Sentry::getUser()->email }}</a>
                        </li>
>>>>>>> 7c418c3449949bd902fa4a63587579f395846ec9
                        <li><a href="{{ route('sentinel.logout') }}">Logout</a></li>
                    @else
                        <li {!! (Request::is('login') ? 'class="active"' : '') !!}><a href="{{ route('sentinel.login') }}">Login</a></li>
                    @endif
                </ul>
                <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <!-- Content -->
            @yield('content')
</script>
            <!-- ./ content -->
        </div>
    </div>
    <!-- ./ container -->

    <!-- Javascripts
    ================================================== -->

    <!-- Thanks to Zizaco for the Restfulizer script.  http://zizaco.net  -->
    <script language="javascript">
        (function($){
            $(function(){
                $('.button-collapse').sideNav();

                // Show session messages if necessary
                @if ($message = Session::get('success'))
                    toast("{!! $message !!}", 5000);
                @endif
                @if ($message = Session::get('error'))
                    toast("{!! $message !!}", 5000);
                @endif
                @if ($message = Session::get('warning'))
                    toast("{!! $message !!}", 5000);
                @endif
                @if ($message = Session::get('info'))
                    toast("{!! $message !!}", 5000);
                @endif
            }); // end of document ready
        })
        (jQuery); // end of jQuery name space
    </script>
    @yield('js')
    @include('sweet::alert')
</body>
</html>
