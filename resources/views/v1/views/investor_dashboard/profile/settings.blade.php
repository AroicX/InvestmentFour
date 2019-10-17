@extends('v1.master.investor')

@section('title', 'settings')

<!-- START: Report modal ajax -->
<div class="modal fade x5-margin-top x10-margin-left" id="reportModal">
    <div class="modal-dialog">
        <div class="modal-content no-radius">
            <div class="modal-header navbar-bg">
                <button class="close  no-radius btn btn-primary" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');"></button>
                <h4 class="header white bold no-margin x14-font-size"> <i class="fas fa-info-circle"></i> <span id="report-title"></span></h4>
            </div>
            <div class="modal-body grey-bg-light">
                <p class="lead transparent x14-font-size">
                    <span id="report"></span>
                    <i class="fas fa-check-circle icon x20-font-size"></i>
                </p>
            </div>
            <div class="modal-footer grey-bg-light">
                <a class="btn btn-danger btn-lg no-radius btn-dan" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');"> Close <i class="fas fa-times"></i> </a>
            </div>
        </div>
    </div>
</div>
<!-- END:: -->

 <!--START: disable-account modal-->
<div id="diableModal" class="modal animated slideInDown slower delay-2s x5-margin-top x10-margin-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content no-radius">
        <div class="modal-header navbar-bg">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title white bolder"><i class="fas fa-info-circle"></i> Are you sure you want to disable your account?</h4>
        </div>
        <div class="modal-body grey-bg-light">
            <p class="lead x14-font-size text-left grey x2-padding">
                Disabling your account means you no longer want to use our services, and this would automatically
                deactivate your account. Thereby you will be temporarily bared from using this account and/or any service attached to it.
            </p>
        </div>
        <div class="modal-footer grey-bg-light">
            <button type="button" class="btn btn-danger btn-den btn-lg no-radius" data-dismiss="modal">Cancel</button>
            <a href="{{route('disable-account')}}" class="btn btn-info btn-inf btn-lg no-radius">Disable Account</a>
        </div>
        </div>
    </div>
</div>
<!--END: disable-account modal-->

@section('nav')
<section class=" navbar-fixed-top no-margin x10-width animated fadeIn slower">
    <div class="container-fluid no-margin no-padding">
        <div class="row no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding">
                @include('v1.components.navigations.investorNav.genNav')
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section>
    <div class="container-fluid flex x1-margin-bottom x9-width x14-font-size">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-lg-3 x2-margin-bottom x5-padding-top white-bg form-border text-center no-padding-left no-padding-right animated fadeIn slower">
                <div class="x5-padding-bottom x0-margin-left x0-margin-right border-bottom">
                    <i class="fas fa-user-circle large-icon light-blue"></i>
                    <h4 class="grey">{{lcfirst(Auth::user()->email)}}</h4>
                    <div class="progress x3-margin">
                        <div class="progress-bar {{$progress}} {{$width}}" role="progressbar"
                            aria-valuemin="0" aria-valuemax="100">
                            <span class="text-center">{{e($title)}}</span>
                        </div>
                    </div> 
                </div>
            @include('v1.components.navigations.asidenav')
            </div>
            <!--START: main content column-->
            <div class="col-md-8 col-sm-12 col-lg-8 margin-left-content x2-margin-bottom no-padding">
                <!--START: nav result container-->
                <div class="container-fluid">
                    <!--START: heading row-->
                    <div class="row no-padding  animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border x2-radius">
                           <h1 class="text-center grey bold" style="">Settings</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom ">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg bottom-border-radius text-center no-padding x2-margin-bottom border-right border-left border-bottom animated fadeIn delay-2s">
                            <div class="container-fluid no-padding no-margin x14-font-size">
                                <div class="row x5-padding no-margin border-bottom ticket-box">
                                    <div class="col-md-12 col-sm-12 col-lg-12">
                                        @if(session('status'))
                                            <div class="modal show animated slideInDown slower delay-2s x5-margin-top x10-margin-left no-radius" id="myModal">
                                                <div class="modal-dialog no-radius">
                                                    <div class="modal-content no-radius">
                                                        <div class="modal-header navbar-bg">
                                                            <button class="close" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');">&times;</button>
                                                            <h4 class="white bold no-margin x16-font-size text-left"> <i class="fas fa-info-circle"></i> Update Report </h4>
                                                        </div>
                                                        <div class="modal-body grey-bg-light">
                                                            <p class="grey transparent x14-font-size text-left"> {{session('status')}} <i class="fas fa-check-circle green x20-font-size animated fadeIn slower delay-4s"></i></p>
                                                        </div>
                                                        <div class="modal-footer grey-bg-light">
                                                            <button class="btn btn-danger btn-dan btn-lg no-radius" data-dismiss="modal" onclick = "$('#myModal').addClass('animated fadeOut slower').removeClass('show');"> Close <i class="fas fa-times"></i> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <span class="text-left pull-left">
                                            <i class="fas fa-user-tie mini-icon grey"></i>
                                            <span class="grey">{{lcfirst(Auth::user()->email)}}</span>
                                        </span>
                                        <span class="pull-right x2-padding grey-border-left">
                                            <a href=" {{ route('logout') }} " class="normal-link">Logout <i class="fas fa-sign-out-alt"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <div class="row x5-padding no-margin border-bottom ticket-box">
                                    <div class="col-md-12 col-sm-12 col-lg-12 text-left">
                                        <i class="fas fa-key mini-icon grey"></i>
                                        <span class="grey">Change password</span>
                                        <span class="pull-right">
                                            <button type="button" class="btn btn-default btn-lg block no-radius" id="open" >Change <i class="fas fa-chevron-down"></i> </button>
                                            <button type="button" class="btn btn-default btn-lg no-radius" id="close"> Hide <i class="fas fa-chevron-up"></i> </button>
                                        </span>
                                        <div class="password-change-div x7-margin-top x2-margin-bottom x10-margin-left x10-margin-right {{$errors -> has('password') || $errors -> has('password_confirmation') ? 'block' : 'no-display'}} " id="password_change_div">
                                           <form action="{{ route('settings') }} " method="post">
                                           @csrf() <!--csrf() field-->
                                            <div class="form-group">
                                                    <label for="password-label" class="grey normal" id="password-label">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control input input-lg" placeholder="Enter Password" />
                                                    @if($errors -> has('password'))
                                                        <span class="maroon normal">{{$errors -> first('password')}} <i class="fa fa-times"></i></span>
                                                    @endif
                                                    <span class="maroon x11-font-size" id="password-error"></span>
                                                </div>
                                                <div class="form-group x6-margin-top">
                                                    <label for="password-label" class="grey normal" id="password-label">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input input-lg"  placeholder="Confirm Password"/>
                                                    @if($errors -> has('password_confirmation'))
                                                        <span class="maroon normal">{{$errors -> first('password_confirmation')}} <i class="fa fa-times"></i></span>
                                                    @endif
                                                    <span class="maroon x11-font-size" id="password-confirmation-error"></span>
                                                </div>
                                                <div class="form-group x3-margin-top">
                                                    <button type="submit" class="btn btn-info btn-lg no-radius" id="changePasswordButton">
                                                        Proceed <i class="fas fa-check"></i>
                                                    </button>
                                                </div>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row x5-padding no-margin border-bottom ticket-box">
                                    <div class="col-md-12 col-sm-12 col-lg-12 text-left">
                                        <div class="container-fluid no-margin no-padding">
                                            <div class="row no-padding no-margin">
                                                <div class="col-md-6 col-sm-12 col-lg-6">
                                                    <i class="fas fa-exchange-alt mini-icon grey"></i>
                                                    <span class="grey">Enable 2FA</span>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-lg-6 text-right">
                                                    <form action="{{route('setting-2fa')}}" method="post">
                                                    @csrf() <!--csrf() field-->
                                                        <button type="submit" name="two-fa" class="btn transparent no-radius" id="twoFaButton">
                                                            <label class="switch no-radius">
                                                                <input type="checkbox" name="twoWayAuth" class="checkbox" id="twoFaCheckbox" {{Auth::user()->twoFA === 1 ? 'checked' : ''}}>
                                                                <span class="slider no-radius"></span>
                                                            </label>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row x5-padding no-margin border-bottom ticket-box">
                                    <div class="col-md-12 col-sm-12 col-lg-12 text-left">
                                        <i class="fas fa-user-alt-slash mini-icon grey"></i>
                                        <span class="grey">Disable account </span>
                                        <span class="pull-right">
                                            <button type="button" class="btn btn-danger btn-lg no-radius" data-toggle="modal" data-target="#diableModal">Disable <i class="fas fa-trash"></i> </button>
                                        </span>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                    <!--END: result row-->
                </div>
                <!--END: nav result container-->
            </div>
            <!--END: main content column-->
        </div>
        <!--END: overall row-->
    </div>
    <!--END: overall container-->
    <script type="text/javascript">
    var url = window.location.href;
        //code snippet is for 2fa
        $(document).on('click', '#twoFaButton', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('setting-2fa')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data:{},
                beforeSend: function(data){
                    $('.slider').css('background-color','rgb(99, 177, 201)');
                },
                success: function(data){
                    if(data.enabled){
                        $('.slider').css('background-color', 'rgb(49, 148, 179)');
                        $('.checkbox').prop('checked', true);
                        $('#reportModal').modal('show').addClass('animated bounceInDown slower delay-1s');
                        $('#report').addClass('grey').text(data.enabled);
                        $('#report-title').text('Update Report');
                        $('.icon').show().css('color', 'green').addClass('animated fadeIn slow delay-3s');
                    }else if(data.disabled){
                        $('.slider').css('background-color', 'rgba(180, 180, 180, 0.9)');
                        $('.checkbox').prop('checked', false);
                        $('#reportModal').modal('show').addClass('animated bounceInDown slower delay-1s');
                        $('#report').addClass('grey').text(data.disabled);
                        $('#report-title').text('Update Report');
                        $('.icon').show().css('color', 'green').addClass('animated fadeIn slow delay-3s');
                    }
                    $('#wishlist-count-container').load(url + ' #wishlist-count', function(e){
                        //wishlist count has been updated//
                        $('#notification-count-container').load(url +' #notification-count', function(e){
                            //notification count updated//
                            $('#notification-notes').load(url +' #notes', function(e){
                                //notification notes updated//
                            });
                        });
                    });
                },
            });
        });
        //end//

        //code snippet is for password change
        $(document).on('click', '#changePasswordButton', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('settings')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data:{
                    password              : $('#password').val(),
                    password_confirmation : $('#password_confirmation').val()
                },
                beforeSend: function(data){
                    $('#password-confirmation-error').text('Processing...').css('color', 'green');
                    $('#password-error').text('Processing...').css('color', 'green');
                },
                success: function(data){
                        $('#reportModal').modal('show').addClass('animated bounceInDown slower delay-2s');
                        $('#report').addClass('grey').text(data.message);
                        $('#report-title').text('Update Report');
                        $('.icon').show().css('color', 'green').addClass('animated fadeIn slow delay-4s');
                        $('#password_change_div').hide();
                        $('#open').show();
                        $('#close').hide();
                },
                error: function(data){
                    var jsonResponse = JSON.parse(data.responseText);
                    $('#password-confirmation-error').text(jsonResponse.errors.password_confirmation).addClass('animated fadeIn slower').css('color', 'maroon');
                    $('#password-error').text(jsonResponse.errors.password).addClass('animated fadeIn slower').css('color', 'maroon');
                }
            });
        });
        //end//
    </script>
</section>
@endsection