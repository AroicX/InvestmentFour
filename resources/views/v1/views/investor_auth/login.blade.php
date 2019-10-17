@extends('v1.master.public')

@section('title', 'login')

<!--START: navbar-->
<section class="navbar-fixed-top no-margin no-padding x10-width">
    <div class="container-fluid no-padding no-margin ">
        <div class="row no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding">
                @include('v1.components.navigations.homenavbar')
            </div>
        </div>
    </div>
</section>
<!--END: navbar-->

@section('form')
<section class="no-margin-right no-margin-left margin-top-header">
    <div class="container-fluid no-margin text-left x5-padding-top x2-padding-bottom">
    @if(session('status'))
            <div class="row x1-padding mini-width center x3-radius alert alert-success animated fadeIn delay-1s" id="success-bag">
                <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding">
                    <label for="status" class="x12-font-size">{{session('status')}} <i class="fa fa-check-circle animated fadeIn delay-2s"></i></label>
                </div>
            </div>
        @endif
        <div class="row x1-padding mini-width center x3-radius alert alert-warning animated fadeIn delay-1s" id="error-bag" style="display:none">
            <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding">
                <label for="status" class="x12-font-size maroon"><span id="error"></span> <i class="fas fa-info-circle animated fadeIn delay-2s x14-font-size normal-text"></i></label>
            </div>
        </div>
        @if(session('error'))
            <div class="row x1-padding mini-width center x3-radius alert alert-warning animated fadeIn delay-1s" id="laravel-error">
                <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding">
                    <label for="status" class="x12-font-size maroon">{{session('error')}} <i class="fas fa-info-circle animated fadeIn delay-2s x14-font-size normal-text"></i></label>
                </div>
            </div>
        @endif
        <div class="row x1-padding no-margin form-border mini-width center x3-radius white-bg animated fadeIn slow">
            <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding">
                <div class="x2-margin text-center">
                    <i class="fas fa-user-circle large-icon light-blue 3dicon"></i>
                </div>
                <form action="{{ route('login') }}" method="post" id="login_form">
                    @csrf() <!--csrf() field-->
                    <div class="form-group">
                        <label for="email" class="grey normal">
                            Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control input-lg no-radius" placeholder="Email" value="{{(Request::old('email') ? Request::old('email') : session('email')) }}"/>
                        @if($errors -> has('email'))
                            <span class="maroon normal">{{$errors -> first('email')}} <i class="fa fa-times"></i></span>
                        @endif
                        <span class="maroon" id="email-error"></span>
                    </div>
                    <div class="form-group x7-margin-top">
                        <label for="password" class="grey normal">
                            Password
                        </label>
                        <input type="password" name="password" id="password" class="form-control input-lg no-radius" placeholder="Password"/>
                        @if($errors -> has('password'))
                            <span class="maroon normal">{{$errors -> first('password')}} <i class="fa fa-times"></i></span>
                        @endif
                        <p class="maroon" id="password-error"></p>
                    </div>
                    <div class="form-group">
                        <span class="light-blue x14-font-size">
                            <input type="checkbox" name="remember" id="remember" class="no-radius" />
                            <span>Remember me</span>
                        </span>
                    </div>
   
                    <div class="form-group x2-margin-top">
                        <button  class="btn btn-info btn-lg no-radius btn-20" type="submit" id="login-button">
                            <object data="your.svg" type="image/svg+xml" id="gif" style="visibility:hidden" class="svg-30 no-padding">
                                <img src="/svg/index.circle-slack-loading-icon.svg"/>
                            </object>
                            Login <i class="fas fa-sign-in-alt"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row x1-padding no-margin form-border mini-width x2-radius center white-bg animated fadeIn slow">
            <span class="grey x14-font-size">Forgot your password? </span><a href=" {{route('password-forgot')}} " class="normal-link x14-font-size">recover password</a>
        </div>
    </div>

    <script type="text/javascript">
        var url = window.location.href;
        //code snippet is for login
       $(document).on('click', '#login-button', function(e){
           e.preventDefault();
           $.ajax({
                url: "{{route('login')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data:{
                    email   : $('#email').val(),
                    password : $('#password').val(),
                },
                beforeSend: function(data){
                    $('#error-bag').css('display', 'none');
                    $('#gif').css('visibility', 'visible');
                    $('#success-bag').css('display', 'none');
                    $('#laravel-error').css('display', 'none').addClass('animated fadeOut slower');
                    $('#email-error').text('');
                    $('#password-error').text('');
                },
                success: function(data){
                    if(data.index){
                        window.location.href = data.index;
                    }else if(data.twoFa){
                        window.location.href = data.twoFa;
                    }
                    else if (data.message){
                        $('#laravel-error').css('display', 'none');
                        $('#error-bag').css('display', 'block').addClass('animated fadeIn slower delay-2s');
                        $('#error').text(data.message);
                        $('#gif').css('visibility', 'hidden');
                    }
                },
                error: function(data){
                    var jsonResponse = JSON.parse(data.responseText);
                    $('#gif').css('visibility', 'hidden');
                    $('#email-error').text(jsonResponse.errors.email).addClass('animated fadeIn slower delay-1s');
                    $('#password-error').text(jsonResponse.errors.password).addClass('animated fadeIn slower delay-1s');
                }
           });
        });
    </script>
</section>
@endsection
