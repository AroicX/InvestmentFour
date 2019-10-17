@extends('v1.master.public')

@section('title', 'register')

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
<section class="no-margin-left no-margin-right x2-margin-bottom margin-top-header">
    <div class="container-fluid no-margin text-left x5-padding-top x2-padding-bottom">
        @if(session('status'))
            <div class="row x1-padding status-border mini-width center x3-radius alert alert-success animated fadeIn delay-1s">
                <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding">
                    <label for="status" class="x12-font-size">{{session('status')}} <i class="fas fa-check-square"></i></label>
                </div>
            </div>
        @endif
        <div class="row x1-padding status-border mini-width center x3-radius alert alert-success animated fadeIn delay-1s" style="display:none" id="report-container">
                <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding">
                    <label for="status" class="x12-font-size"> <span id="report"></span> <i class="fas fa-check-square"></i></label>
                </div>
            </div>
        <div class="row x1-padding no-margin form-border mini-width center x3-radius white-bg animated fadeIn slow">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x2-margin text-center">
                    <i class="fas fa-user-plus large-icon light-blue 3dicon"></i>
                </div>
                <form action="{{ route('register') }}" method="post" id="login_form">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="form-group">
                        <label for="phone" class="grey normal">Phone</label>
                        <div class="row no-padding">
                            <div class="col-md-4 no-margin">
                                <select name="code" id="code" class="form-control input-lg no-radius">
                                    <option value="{{ !empty(Request::old('code')) ? Request::old('code') : '' }}" {{!empty(Request::old('code')) ? 'selected' : ''}}>{{ !empty(Request::old('code')) ? Request::old('code') : 'Code' }}</option>
                                    @for($i = 0; $i < count($country_prefix); $i++)
                                        <option value="{{ e($country_prefix[$i]) }}">{{ e(strtoupper($country_abbrev[$i])) }}</option>
                                    @endfor
                                </select>
                                @if($errors -> has('code'))
                                 <span class="maroon">{{$errors -> first('code')}} <i class="fas fa-times maroon"></i></span>
                                @endif
                                <p class="maroon" id="code-error"></p>
                            </div>
                            <div class="col-md-8 no-margin">
                                <input type="number" name="phone" id="phone" class="form-control input-lg no-radius" placeholder="e.g. 8103769601" value="{{e(Request::old('phone'))}}"/>
                                @if($errors -> has('phone'))
                                    <span class="maroon"> {{$errors -> first('phone')}} <i class="fas fa-times maroon"></i></span>
                                @endif
                                <p class="maroon" id="phone-error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="grey normal">Email</label>
                        <input type="email" name="email" id="email" class="form-control input-lg no-radius" placeholder="Email" value="{{e(Request::old('email'))}}"/>
                        @if($errors -> has('email'))
                            <span class="maroon">{{$errors -> first('email')}} <i class="fas fa-times maroon"></i></span>
                        @endif
                        <p class="maroon" id="email-error"></p>
                    </div>
                    <div class="form-group x7-margin-top">
                        <label for="password" class="grey normal">Password</label>
                        <input type="password" name="password" id="password" class="form-control input-lg no-radius" placeholder="Password"/>
                        @if($errors -> has('password'))
                            <span class="maroon">{{$errors -> first('password')}} <i class="fas fa-times maroon"></i></span>
                        @endif
                        <p class="maroon" id="password-error"></p>
                    </div>
                    <div class="form-group x7-margin-top">
                        <label for="confirm_password" class="grey normal">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg no-radius" placeholder="Confirm Password"/>
                        @if($errors -> has('password_confirmation'))
                            <span class="maroon">{{$errors -> first('password_confirmation')}} <i class="fas fa-times maroon"></i></span>
                        @endif
                        <p class="maroon" id="password-confirmation-error"></p>
                    </div>
                    <div class="form-group x3-margin-top">
                        <span class="light-blue x14-font-size">
                            <input type="checkbox" name="terms" id="terms"/>
                            Agree to <a href="#">Terms &amp Condtion</a>
                            @if($errors -> has('terms'))
                                <p class="maroon">{{$errors -> first('terms')}} <i class="fas fa-times maroon"></i></p>
                            @endif
                            <p class="maroon" id="terms-error"></p>
                        </span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info btn-lg no-radius" type="submit" id="registerButton">
                            <object data="your.svg" type="image/svg+xml" id="gif" style="visibility:hidden" class="svg-30 no-padding">
                                <img src="/svg/index.circle-slack-loading-icon.svg"/>
                            </object>
                            Register <i class="far fa-edit"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click', '#registerButton', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('register')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data:{
                    code                    : $('#code').val(),
                    phone                   : $('#phone').val(),
                    email                   : $('#email').val(),
                    password                : $('#password').val(),
                    password_confirmation   : $('#password_confirmation').val(),
                    terms                   : $('#terms').val()
                },
                beforeSend: function(data){
                    $('#gif').css('visibility', 'visible');
                    $('#code-error').text('');
                    $('#phone-error').text('');
                    $('#email-error').text('');
                    $('#password-error').text('');
                    $('#password-confirmation-error').text('');
                    $('#terms-error').text('');
                },
                success: function(data){
                    $('#gif').css('visibility', 'hidden');
                    $('#report').text(data.message);
                    $('#report-container').css('display', 'block').addClass('animated fadeIn slower delay-1s');
                    //clearing input field data//
                    $('#code').val('');
                    $('#phone').val('');
                    $('#email').val('');
                    $('#password').val('');
                    $('#password_confirmation').val('');
                    $('#terms').val('').prop('checked', false);
                    //end//
                    
                    //take page focus to screen top
                    var body = $("html, body");
                        body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                        //focus placed on screen top//
                    });
                    //end//
                },
                error: function(data){
                    var jsonResponse = JSON.parse(data.responseText);
                    $('#gif').css('visibility', 'hidden');
                    $('#code-error').text(jsonResponse.errors.code).addClass('animated fadeIn slower');
                    $('#phone-error').text(jsonResponse.errors.phone).addClass('animated fadeIn slower');
                    $('#email-error').text(jsonResponse.errors.email).addClass('animated fadeIn slower');
                    $('#password-error').text(jsonResponse.errors.password).addClass('animated fadeIn slower');
                    $('#password-confirmation-error').text(jsonResponse.errors.password_confirmation).addClass('animated fadeIn slower');
                    $('#terms-error').text(jsonResponse.errors.terms).addClass('animated fadeIn slower');
                }
            });
        });
    </script>
</section>
@endsection