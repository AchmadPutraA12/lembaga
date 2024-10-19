<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sistem Informasi Kelembagaan</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet" />
    <link href="{{ asset('dist-assets/css/themes/lite-blue.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist-assets/css/plugins/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/fontawesome-5.css') }}" />
    <link href="{{ asset('dist-assets/css/plugins/metisMenu.min.css') }}" rel="stylesheet" />

    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" href="{{ asset('dist-assets/images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dist-assets/images/logo.png') }}" type="image/x-icon">

    {{-- data table button  --}}
    <link rel="stylesheet" href="{{ asset('dist-assets/css/plugins/datatables.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.css" rel="stylesheet">
    
    @yield('page-css')
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-vertical sidebar-full">

        @include('layouts.sidebar.sidebar')

        <div class="switch-overlay"></div>
        <div class="main-content-wrap mobile-menu-content bg-off-white m-0">
            @include('layouts.header')

            @yield('main-content')

            <div class="sidebar-overlay open"></div>
            <!-- Footer Start -->
            <div class="flex-grow-1"></div>
            <div class="app-footer">
                <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                    <span class="flex-grow-1"></span>
                    <div class="d-flex align-items-center">
                        <img class="logo" src="{{ asset('dist-assets/images/logo.png') }}" alt="">
                        <div>
                            <p class="m-0">&copy; {{ date('Y') }} LLDIKTI VII</p>
                            <p class="m-0">All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fotter end -->
        </div>
    </div><!-- ============ Search UI Start ============= -->
    <!-- ============ Search UI End ============= -->
    <script src="{{ asset('dist-assets/js/plugins/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/scripts/tooltip.script.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/scripts/script.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/scripts/script_2.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/scripts/sidebar.large.script.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/plugins/metisMenu.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/scripts/layout-sidebar-vertical.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/plugins/echarts.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/scripts/echart.options.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/scripts/dashboard.v1.script.min.js') }}"></script>

    <script src="{{ asset('dist-assets/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('dist-assets/js/scripts/datatables.script.min.js') }}"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.8/datatables.min.js"></script>

    @yield('page-js')

    @include('sweetalert::alert')
</body>

</html>