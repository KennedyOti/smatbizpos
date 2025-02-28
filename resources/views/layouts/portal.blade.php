<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ('Smart Business Solutions') }}</title>
    <!-- icon -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/fa/css/all.min.css') }}">
    <!-- dataTables -->
    <link href="{{ asset('assets/libs/dataTables/css/dataTables.bootstrap5.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/css/adminlte.min.css') }}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!-- Include Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        <?php
        for ($i = 1; $i <= 100; $i++) {
            echo ".pw-" . $i . "{ width: " . $i . "%!important; }";
            echo ".ph-" . $i . "{ height: " . $i . "%!important; }";
            echo ".piw-" . $i . "{ width: " . $i . "px!important; }";
            echo ".pih-" . $i . "{ height: " . $i . "px!important; }";
        }
        ?>
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link" target="_blank"><i class="fas fa-globe"></i> Website</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown text-capitalize">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-right border-0 shadow">
                        <a href="{{ route('users.user_management', Auth::user()->id) }}" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out mr-2"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
                <span class="brand-text font-weight-bolder text-uppercase">{{ (ucwords(''.Auth::user()->category.' account')) }}</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar text-capitalize">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        @include('layouts.menus.'.Auth::user()->category.'_menu')

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @if(Auth::user()->category=='customer')
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 my-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header">
                                    APOLOGY FOR UN AVAILABILITY
                                </div>
                                <div class="card-body text-center h6">
                                    This is to let you know that the customer account portal is currently under mantanance
                                    <br>
                                    The content will be displayed once the process is complete
                                    <br>
                                    Thankyou for your interest to shop with us
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @else

            @yield('content')

            @endif

        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>
                Copyright &copy; 2024
                <a href="/">Smatbiz & POS</a>.
            </strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <a href="https://dijisoftwares.com/">Dijisoftwares IT Counsaltancies</a>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <!-- botstrap -->
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/popper.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('assets/adminlte/js/adminlte.js') }}"></script>
    <!-- text-editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <!-- validation -->
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <!-- datatables -->
    <script src="{{ asset('assets/libs/dataTables/js/dataTables.js') }}"></script>
    <script src="{{ asset('assets/libs/dataTables/js/dataTables.bootstrap5.js') }}"></script>
    <!-- sweet alert -->
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- script -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session("success") }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session("error") }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    @stack('script')
</body>

</html>