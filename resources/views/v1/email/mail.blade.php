<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--START: external/internal css-->
    <link rel="stylesheet" href="{{URL::to('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/animate.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/default.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/fontawesome/css/all.min.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
    <div class="center">
        <section>
            <div class="container-fluid" style="margin:1% auto; border-bottom:1px solid rgba(180, 180, 180, 0.4); width:70%; text-align:center; font-family:ariel">
                <div class="row" style="background-color:rgb(49, 148, 179); margin:0;">
                    <div class="col-md-12 col-sm-12 col-lg-12" style="margin:0; padding-right:2%; padding-left:2%; padding-top:0; padding-bottom:0; text-align:center;">
                        <h2 style="font-weight:bold; padding-top:8%; margin-bottom:8%; font-size:16pt; color:#fff"> {{$name}} </h2>
                        <p style="font-size:12pt; color:#fff; text-align:right; padding-bottom:0">Date: {{$date}}</p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12" style="margin:0; padding:3%; padding-bottom:4%; background-color:#fff; border-left:1px solid rgba(180, 180, 180, 0.4); border-right:1px solid rgba(180, 180, 180, 0.4);">
                        <p style="color:#888; font-size:12pt; text-align:left;">Hello;</p>
                        <pre style="color:#888; font-size:12pt; text-align:left">
<p>{{$body}} <a href="{{route('contact')}}" style="text-decoration:none; color:rgb(49, 148, 179)">Contact Us</a></p>
                        </pre>
                        @if (isset($code) || isset($token))
                        <a href="{{!isset($code) ? '#' : $code}}" style=" text-decoration: none;
                                            background-color: #fff;
                                            color: #888;
                                            padding: 2%;
                                            border: 1px solid #CCCCCC;
                                            ">
                            @if(isset($code))
                                {{'Complete Registration'}}
                            @else if (isset($token))
                                {{$token}}
                            @endif
                        </a>
                        @endif
                    </div>
                </div>
                <div class="row" style="background-color:rgba(240, 240, 240, 0.4); border:1px solid rgba(180, 180, 180, 0.4); margin:0; padding:3%; text-align:center">
                    <div class="margin-bottom:2%">
                        <p style="text-align:center; font-size:10pt; color:#888">You recieved this mail because an account on Site Name is associated with the email address {{$email}}</p>
                    </div>
                    <div>
                        <a href=" {{route('home')}}" style="text-decoration:none;margin:2%"><img src="{{ $message->embed(public_path().'/images/icons/facebook.png') }}" alt="Facebook" title="Facebook Page" style="width:10%" /></a>
                        <a href=" {{route('about')}} " style="text-decoration:none; margin:2%"><img src="{{ $message->embed(public_path().'/images/icons/twitter.png') }}" alt="Twitter" title="Twitter Page" style="width:10%" /></a>
                        <a href=" {{route('contact')}}" style="text-decoration:none; margin:2%"><img src="{{ $message->embed(public_path().'/images/icons/discord.png') }}" alt="Discord" title="Discord Server" style="width:8.5%" /></a>
                    </div>
                   
                </div>
            </div>
        </section>
    </div>
     <!--START: external/internal js-->
    <script src="{{URL::to('js/jquery.js')}}"></script>
    <script src="{{URL::to('js/modernizer.js')}}"></script>
  
    <script src="{{URL::to('js/bootstrap.js')}}"></script>
    <script src="{{URL::to('js/npm.js')}}"></script>
    <script src="{{URL::to('js/default.js')}}"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!--END: external/internal js-->
</body>
</html>