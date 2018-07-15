<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SD - Mahasiswa</title>
    <meta name="description:" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('/img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- Font-Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('/css/fontawesome-all.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootadmin.min.css') }}">
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('/css/datatables.min.css') }}">

    <style>
        /*--------------------------------------------------------------
        # Footer
        --------------------------------------------------------------*/        
        .footer {
            background: #292e33;
            bottom: 0;
            width: 100%;
            color: #fff;
            font-size: 14px;
        }

        .footer a {
            color: #999;
            text-decoration: none;
        }
    </style>

</head>
<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="#">Mahasiswa</a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->nama }}</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="/ganti-password" class="dropdown-item">
                            <i class="fa-key fa"></i> Ganti Password
                        </a>
                        <a class="dropdown-item" href="/logout">
                            <i class="fa fa-power-off"></i>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('user.logout') }}" method="get" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            <ul class="list-unstyled">
                <li class="@yield('active1')"><a href="{{ route('beranda-sd.index') }}"><i class="fa fa-fw fa-home"></i> Beranda</a></li>
                <li class="@yield('active2')"><a href="{{ route('beranda-sd.biodata') }}"><i class="fa fa-fw fa-user"></i> Biodata</a></li>
                <li class="@yield('active4')"><a href="/prestasi"><i class="fa fa-fw fa-trophy"></i> Prestasi</a></li>
                <li class="@yield('active5')"><a href="/organisasi"><i class="fa fa-fw fa-building"></i> Organisasi</a></li>
                <li class="@yield('active3')"><a href="{{ route('beranda-sd.cetak-berkas') }}"><i class="fa fa-fw fa-print"></i> Cetak berkas</a></li>
            </ul>
        </div>

        <div class="content" style="background-color:#f5f5f5">
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="py-2 footer text-center">
        &copy; 2018 <a href="/"><strong>SMFT</strong></a>. All Rights Reserved
    </div>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/bootadmin.min.js') }}"></script>
    <script src="{{ asset('/js/datatables.min.js') }}"></script>
    @yield('custom_javascript')
</body>
</html>