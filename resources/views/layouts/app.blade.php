<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MSU Voting System Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->

    <link rel="stylesheet" href="{{ asset('bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <link href="{{ asset('css/bootstrap-glyphicons.css')}}" rel="stylesheet">
    <link href="{{ asset('css/selectize.bootstrap4.css')}}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="{{ asset('chosen/chosen.css')}}">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        html {
            zoom:0.75 !important;
            font-family: 'Inter', sans-serif;
        }

        @supports (font-variation-settings: normal) {
            html {
                font-family: 'Inter var', sans-serif;
            }
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"
        }

        .table-dark,
        .table-dark > td,
        .table-dark > th {
            background-color: #000000;
        }

        .badge-Low {
            background: #c8cbcf;
            color: #444;
        }

        .badge-Medium {
            background: limegreen;
            color: #fff;
        }

        .badge-High {
            background: gold;
            color: #000;
        }

        .badge-Urgent {
            background: red;
            color: #fff;
        }

        .badge-closed {
            background: limegreen;
            color: #fff;
        }

        .badge-open {
            background: #c6e0f5;
        }
    </style>
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark  shadow-sm" style="background: #2196f3 !important;">

        <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">MSU Voting System Admin
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest()
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase font-weight-bold" href="{{ url('/candidate') }}">Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase font-weight-bold" href="{{ url('/party') }}">Parties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase font-weight-bold" href="{{ url('/portfolio') }}">Portfolios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase font-weight-bold" href="{{ url('/election') }}">Elections</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white text-uppercase font-weight-bold" href="{{ url('/voter') }}">Voters Roll</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-uppercase" href="#"
                           role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <a class="nav-link btn btn-danger text-white font-weight-bold" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}</a>

                @endguest

            </ul>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/selectize.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/combodate.js')}}"></script>
<script src="{{asset('chosen/chosen.jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('chosen/docsupport/prism.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('chosen/docsupport/init.js')}}" type="text/javascript" charset="utf-8"></script>

<script>
    $(document).ready(function () {
        $('#table').DataTable();
    });
</script>
