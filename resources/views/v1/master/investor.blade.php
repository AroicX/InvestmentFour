<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <!--START: external/internal css-->
    <link rel="stylesheet" href="{{URL::to('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/animate.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/default.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/fontawesome/css/all.min.css')}}">
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:250" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
    
    <title>@yield('title')</title>
</head>

<body class="grey-bg">
   
        @yield('nav')
        <div class="margin-top-header">
            @yield('content')    
        </div>
        @include('v1.components.footers.investor_footer')
 
     <!--START: external/internal js-->
     <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/modernizer.js')}}"></script>
  
    <script src="{{URL::to('js/bootstrap.js')}}"></script>
    <script src="{{URL::to('js/npm.js')}}"></script>
    <script src="{{URL::to('js/default.js')}}"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>


    @yield('js')
    <!--END: external/internal js-->
</body>
</html>