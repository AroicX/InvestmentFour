<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Multi Auth Guard') }}</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('css/animate.css')}}">
    <link href="/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/admin/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">
</head>

<body id="page-top">

    <style>
        div.dt-buttons {
            position: relative;
            float: none !important;
        }

        .buttons-html5 {
            background: #4e73df !important;
            color: #fff !important;
            border-radius: 20px !important;
            border: none !important;
            transition: all 0.5s ease-in;
        }

        .buttons-print {
            background: #4e73df !important;
            color: #fff !important;
            border-radius: 20px !important;
            border: none !important;
            transition: all 0.5s ease-in;
        }

        .buttons-html5:hover {
            background: #4e73dc !important;
            font-size: 12px;
            transition: all 0.2s ease-out;

        }

        .buttons-print:hover {
            background: #4e73dc !important;
            font-size: 12px;
            transition: all 0.2s ease-out;

        }

        .dataTables_filter {
            /* margin-top: -40px; */
            padding: 0px 20px;
        }


        .dataTables_filter input {
            width: 250px !important;
            border: none !important;
            border-bottom: 1px solid #4e73dc !important;
            outline: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            cursor: default;
            color: #4e73df !important;

        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            *cursor: hand;
            color: #4e73df !important;
            border: 1px solid transparent;
            border-radius: 2px;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            border-radius: 50%;
            color: #fff !important;
            font-size: 18px;
            border: 1px solid #979797;
            background-color: #4e73df !important;
            background: #4e73df !important;

            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #dcdcdc));
            background: -webkit-linear-gradient(top, #fff 0%, #dcdcdc 100%);
            background: -moz-linear-gradient(top, #fff 0%, #dcdcdc 100%);
            background: -ms-linear-gradient(top, #fff 0%, #dcdcdc 100%);
            background: -o-linear-gradient(top, #fff 0%, #dcdcdc 100%);
            background: linear-gradient(to bottom, #fff 0%, #dcdcdc 100%);
        }

    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">


        @if(Auth::user()->role == 'super_admin')
           @include('admin.layout.sidebar')
        @endif
        @if(Auth::user()->role == 'normal_admin')
          @include('admin.layout.normal')
        @endif
        @if( Auth::user()->role == 'content_developer' )
           @include('admin.layout.content')
        @endif
        @if(Auth::user()->role == 'customer_care')
           @include('admin.layout.customer')
        @endif


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.layout.navigation')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                    


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->








    <script src="/admin/vendor/jquery/jquery.min.js"></script>
    <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/admin/js/sb-admin-2.min.js"></script>
    {{-- <script src="/admin/vendor/chart.js/Chart.min.js"></script> --}}
    {{-- <script src="/admin/js/demo/chart-area-demo.js"></script> --}}
    {{-- <script src="/admin/js/demo/chart-pie-demo.js"></script> --}}
    <script src="/admin/js/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert', 'info') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif

    </script>

    @yield('js')
</body>

</html>
