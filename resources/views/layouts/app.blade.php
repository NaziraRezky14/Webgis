<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>WEBGIS RAWAN BANJIR KABUPATEN ACEH UTARA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @notifyCss
    @notifyJs

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/dt-1.11.4/fh-3.2.1/sc-2.0.5/datatables.min.css" />

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.4/fh-3.2.1/sc-2.0.5/datatables.min.js">
    </script>
    @if (request()->route()->getName() == 'index')
        <link href="{{ asset('storage/css/tooplate-style.css') }}" rel="stylesheet">
    @else
        @guest
            <link href="{{ asset('storage/css/tooplate-style.css') }}" rel="stylesheet">
        @endguest
        <link href="{{ asset('storage/css/adminlte.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('storage/css/halaman-data.css') }}">
    @endif

    <style>
        .item {
            background-color: transparent;
            display: block;
            width: 100%;
            padding: 0.25rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            border: 0;
            text-decoration: none;
        }

        .item.active {
            background-color: #1A3C40;
        }

        .nav-link.active {
            background-color: #1A3C40 !important;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div id="app">
        @guest

            @if (request()->route()->getName() != 'index')
                <section class="w-100" style="background-color: #5F763F">
                    <a href="{{ route('login') }}"
                        class="text-decoration-none text-white m-4 py-1 btn btn-outline-info me-2">
                        <h4>Log in</h4>
                    </a>
                    <a href="/" class="text-decoration-none text-white m-4 py-1 me-2 btn">
                        <h4>Home</h4>
                    </a>
                    <a href="{{ route('maps') }}" class="text-decoration-none text-white m-4 py-1 me-2 btn"
                        style="{{ request()->route()->getName() == 'maps'? 'border-bottom:1px solid cyan;': '' }}">
                        <h4>Maps</h4>
                    </a>
                    <a href="{{ route('heatmap') }}" class="text-decoration-none text-white m-4 py-1 me-2 btn"
                        style="{{ request()->route()->getName() == 'heatmap'? 'border-bottom:1px solid cyan;': '' }}">
                        <h4>Heatmaps</h4>
                    </a>
                    <a href="{{ route('halaman data2') }}" class="text-decoration-none text-white m-4 py-1 me-2 btn"
                        style="{{ request()->route()->getName() == 'halaman data2'? 'border-bottom:1px solid cyan;': '' }}">
                        <h4>Laporan</h4>
                    </a>
                    <a href="{{ route('terdampak',['year'=>Date('Y')]) }}" class="text-decoration-none text-white m-4 py-1 me-2 btn"
                        style="{{ request()->route()->getName() == 'terdampak'? 'border-bottom:1px solid cyan;': '' }}">
                        <h4>Terdampak</h4>
                    </a>
                    <a href="{{ route('panduan') }}" class="text-decoration-none text-white m-4 py-1 me-2 btn"
                        style="{{ request()->route()->getName() == 'panduan'? 'border-bottom:1px solid cyan;': '' }}">
                        <h4>Panduan</h4>
                    </a>
                   
                </section>
            @endif
        @else
            <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #EDE6DB">

                <div class="text-center w-100">
                    <h3>KAWASAN BAHAYA BANJIR ACEH UTARA</h3>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <li class="nav-item dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#drop" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div id="drop" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="item btn" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    </li>
                </ul>
            </nav>
        @endguest
        @if (request()->route()->getName() == 'login')
        @else
            @guest
            @else
                <aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed"
                    style="background-color: #5F763F">
                    <!-- Brand Logo -->
                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar user panel (optional) -->

                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="text-white h4 text-center w-100">
                                {{ Auth::user()->name }}
                            </div>
                        </div>


                        <!-- Sidebar Menu -->
                        <nav class="mt-2">

                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">

                                @if (auth()->user()->level == 'admin')
                                    <li class="nav-item">
                                        <a href="{{ route('home') }}"
                                            class="nav-link item btn {{ request()->route()->getName() == 'home'? 'text-white active': '' }} text-white text-start">
                                            <i class="nav-icon fas fa-th"></i>
                                            <p>
                                                Dashboard
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a data-bs-toggle="collapse" href="#maps"
                                            class="nav-link btn bg-transparent text-white text-start w-100"
                                            aria-controls="manajemen" role="button" aria-expanded="true">
                                            <i class="nav-icon fa-solid fa-map"></i>
                                            Maps
                                            <i class="fas fa-sort-down float-end"></i>
                                        </a>

                                        <div class="collapse  {{ in_array(request()->route()->getName(),[ 'maps desa', 'maps', 'Rute','terdampak'])? 'show': '' }}"
                                            id="maps" style="">
                                            <ul class="nav ms-4 ps-3">
                                                <li class="nav-item w-100">
                                                    <a class="item {{ request()->route()->getName() == 'maps'? 'text-white active': '' }}"
                                                        href="{{ route('maps') }}">Lokasi</a>
                                                </li>
                                                <li class="nav-item w-100">
                                                    <a class="item {{ request()->route()->getName() == 'heatmap'? 'text-white active': '' }}"
                                                        href="{{ route('heatmap') }}">Heatmap</a>
                                                </li>
                                                <li class="nav-item w-100">
                                                    <a class="item {{ request()->route()->getName() == 'terdampak'? 'text-white active': '' }}"
                                                        href="{{ route('terdampak',['year'=>Date('Y')]) }}">Terdampak</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a data-bs-toggle="collapse" href="#data"
                                            class="nav-link btn bg-transparent text-white text-start w-100"
                                            aria-controls="manajemen" role="button" aria-expanded="true">
                                            <i class="nav-icon fa-solid fa-database"></i>
                                            Data
                                            <i class="fas fa-sort-down float-end"></i>
                                        </a>
                                        <div class="collapse  {{ in_array(request()->route()->getName(),['halaman data', 'halaman data2', 'halaman desa', 'halaman tematik', 'rumah sakit'])? 'show': '' }}"
                                            id="data" style="">
                                            <ul class="nav ms-4 ps-3">

                                                <li class="nav-item  w-100">
                                                    <a class="item {{ request()->route()->getName() == 'halaman data2'? 'text-white active': '' }}"
                                                        href="{{ route('halaman data2') }}">Laporan Banjir</a>
                                                </li>
                                                <li class="nav-item w-100">
                                                    <a class="item {{ request()->route()->getName() == 'halaman tematik'? 'text-white active': '' }}"
                                                        href="{{ route('halaman tematik') }}">Data
                                                        Kecamatan</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('rs dashboard') }}"
                                            class="nav-link btn {{ request()->route()->getName() == 'rs dashboard'? 'text-white active': '' }}  text-white text-start">
                                            <i class="nav-icon fas fa-th"></i>
                                            <p>
                                                Data Pendaftaran
                                            </p>
                                        </a>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    <a href="{{ route('panduan') }}"
                                        class="nav-link btn {{ request()->route()->getName() == 'panduan'? 'active': '' }} text-white text-start w-100">
                                        <i class="nav-icon fa-solid fa-book"></i>
                                        <p>
                                            Panduan
                                        </p>
                                    </a>
                                </li>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>
            @endguest
        @endif
        @guest
            <main>
            @else
                <main class="content-wrapper mt-4">
                @endguest
                @yield('content')
            </main>
    </div>
    @guest
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li><a href="https://www.facebook.com/tooplate"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                        <p class="text-white">Copyright &copy; 2022 Informatika USK

                            | Nazira Rezky Afifah</a></p>
                    </div>
                </div>
            </div>
        </footer>

    @endguest
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('DataTables')
    @stack('scripts')
</body>

</html>
