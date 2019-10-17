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
</head>

<body id="page-top">


  <!-- Page Wrapper -->
  <div id="wrapper">



    @include('admin.layout.sidebar')
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
  <script src="/admin/vendor/chart.js/Chart.min.js"></script>
  <script src="/admin/js/demo/chart-area-demo.js"></script>
  <script src="/admin/js/demo/chart-pie-demo.js"></script>
  <script src="/admin/js/toastr.min.js"></script>

    <script>
    @if(Session::has('message'))
      var type = "{{ Session::get('alert', 'info') }}";
      switch(type){
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