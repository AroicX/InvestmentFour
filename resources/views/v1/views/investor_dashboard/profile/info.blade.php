@extends('v1.master.investor')

@section('title', 'my information')

<!-- START: Report modal -->
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

<!--START: add personal information modal-->
<div id="addInfo" class="modal animated slideInDown slower delay-2s x2-margin-top x10-margin-left" role="dialog">
    <div class="modal-dialog">
       <form method="post">
            @csrf()
             <!-- Modal content-->
            <div class="modal-content no-radius">
                <div class="modal-header navbar-bg">
                    <button type="button" class="close white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title bolder white x14-font-size "><i class="fas fa-info-circle"></i> <span class="title">Update Personal Information</span></h4>
                </div>
                <div class="modal-body grey-bg-light">
                   <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="text-center x1-margin">
                                    <span id="process-report" class="bold"></span>
                                </div>
                                <div class="form-group">
                                    <label for="first-name" class="grey">First name</label>
                                    <input type="text" name="firstName" id="firstName" class="form-control input-md">
                                    <p class="no-margin" id="firstName-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="last-name" class="grey">Last name</label>
                                    <input type="text" name="lastName" id="lastName" class="form-control input-md">
                                    <p class="no-margin" id="lastName-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="grey">Address</label>
                                    <input type="text" name="addresss" id="address" class="form-control input-md">
                                    <p class="no-margin" id="address-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="state" class="grey">State</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="">-Select State-</option>
                                        <option value="kano">Kano</option>
                                    </select>
                                    <p class="no-margin" id="state-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="grey">City</label>
                                    <input type="text" name="city" id="city" class="form-control input-md">
                                    <p class="no-margin" id="city-report"></p>
                                </div>
                            </div>
                        </div>
                   </div> 
                </div>
                <div class="modal-footer grey-bg-light">
                    <button type="button" class="btn btn-danger btn-lg no-radius no-delete x14-font-size" data-dismiss="modal"> <span class="no">Cancel</span> <i class="fa fa-times"></i> </button>
                    <button type="button" class="btn btn-info btn-lg no-radius yes-delete x14-font-size" id="addinfobutton"> <span class="yes">Update</span> <i class="fa fa-check"></i> </button>
                </div>
            </div>
       </form>
    </div>
</div>
<!--END-->

<!--START: add kin information modal-->
<div id="addKin" class="modal animated slideInDown slower delay-2s x2-margin-top x10-margin-left" role="dialog">
    <div class="modal-dialog">
       <form method="post">
            @csrf()
             <!-- Modal content-->
            <div class="modal-content no-radius">
                <div class="modal-header navbar-bg">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title bolder white x14-font-size "><i class="fas fa-info-circle"></i> <span class="title">Update N-Kin Information</span></h4>
                </div>
                <div class="modal-body grey-bg-light">
                   <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="text-center x1-margin">
                                    <span id="process-report-kin" class="bold"></span>
                                </div>
                                <div class="form-group">
                                    <label for="fullName" class="grey">Full name</label>
                                    <input type="text" name="fullName" id="fullName" class="form-control input-md" placeholder="FULL NAME" />
                                    <p class="no-margin" id="fullName-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="grey">Email</label>
                                    <input type="text" name="email" id="email" class="form-control input-md" placeholder="EMAIL"/>
                                    <p class="no-margin" id="kinEmail-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="grey">Phone</label>
                                    <input type="number" name="phone" id="phone" class="form-control input-md" placeholder="e.g 8101212313"/>
                                    <p class="no-margin" id="kinPhone-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="grey">Address</label>
                                    <input type="text" name="addressed" id="kin-address" class="form-control input-md" placeholder="ADDRESS" />
                                    <p class="no-margin" id="kinAddress-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="country" class="grey"> Country</label>
                                    <select name="country" id="country" class="form-control input-md">
                                        <option value="" selected>-Select Country-</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country}}">{{e(ucfirst($country))}}</option>
                                        @endforeach
                                    </select>
                                    <p class="no-margin" id="kinCountry-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="relationship" class="grey"> Relationship</label>
                                    <select name="relation" id="relationship" class="form-control input-md">
                                        <option value="" selected>-Relationship-</option>
                                            @foreach($relationships as $relationship)
                                                <option value="{{$relationship->id}}">{{ucfirst($relationship->type)}}</option>
                                            @endforeach
                                    </select>
                                    <p class="no-margin" id="kinRelation-report"></p>
                                </div>
                            </div>
                        </div>
                   </div> 
                </div>
                <div class="modal-footer grey-bg-light">
                    <button type="button" class="btn btn-danger btn-lg no-radius no-delete x14-font-size" data-dismiss="modal"> <span class="no">Cancel</span> <i class="fa fa-times"></i> </button>
                    <button type="submit" class="btn btn-info btn-lg no-radius yes-delete x14-font-size" id="addkinbutton"> <span class="yes">Update</span> <i class="fa fa-check"></i> </button>
                </div>
            </div>
       </form>
    </div>
</div>
<!--END-->

<!--START: add bank information modal-->
<div id="addBank" class="modal animated slideInDown slower delay-2s x2-margin-top x10-margin-left" role="dialog">
    <div class="modal-dialog">
       <form method="post">
            @csrf()
             <!-- Modal content-->
            <div class="modal-content no-padding no-radius">
                <div class="modal-header navbar-bg">
                    <button type="button" class="close white" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title bolder white x14-font-size"><i class="fas fa-info-circle"></i> <span class="title">Update Bank Information</span></h4>
                </div>
                <div class="modal-body grey-bg-light">
                   <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="text-center x1-margin">
                                    <span id="process-report-bank" class="bold"></span>
                                </div>
                                <div class="form-group">
                                    <label for="accountName" class="grey">Account name</label>
                                    <input type="text" name="acc_name" id="accountName" class="form-control input-md" placeholder="ACCOUNT NAME" />
                                    <p class="no-margin" id="accName-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="accountNumber" class="grey">Account number</label>
                                    <input type="number" name="acc_number" id="accountNumber" class="form-control input-md" placeholder="ACCOUNT NUMBER"/>
                                    <p class="no-margin" id="accNumber-report"></p>
                                </div>
                                <div class="form-group">
                                    <label for="bank" class="grey"> Bank</label>
                                    <select name="bank" id="bank" class="form-control input-md">
                                        <option value="" selected>-SELECT BANK-</option>
                                        @foreach($banks as $bank)
                                            <option value="{{$bank->bank_id}}">{{e(ucfirst($bank->bank))}}</option>
                                        @endforeach
                                    </select>
                                    <p class="no-margin" id="bank-report"></p>
                                </div>
                            </div>
                        </div>
                   </div> 
                </div>
                <div class="modal-footer grey-bg-light">
                    <button type="button" class="btn btn-danger btn-lg no-radius no-delete x14-font-size" data-dismiss="modal"> <span class="no">Cancel</span> <i class="fa fa-times"></i> </button>
                    <button type="submit" class="btn btn-info btn-lg no-radius yes-delete x14-font-size" id="addBankButton"> <span class="yes">Update</span> <i class="fa fa-check"></i> </button>
                </div>
            </div>
       </form>
    </div>
</div>
<!--END-->

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
                    <div class="row no-padding  x1-margin-bottom animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border x2-radius">
                            <h1 class="text-center grey bold">My Information</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom x1-padding-top no-margin-top white-bg bottom-border-radius border-left border-right border-bottom animated fadeIn delay-2s">
                        <div class="col-md-12 col-sm-12 col-lg-12  x5-radius text-center x3-padding x2-margin-bottom" id="personal-target">
                            <div class="no-padding no-margin" id="personal">
                                <!--START: personal information-->
                                <h3 class="text-left bold light-blue border-bottom x1-padding-bottom">Personal Information <i class="pull-right fas fa-chevron-down hand-cursor" id="personal-hider"></i> </h3>
                                <div id="personal-data">
                                    <table class="table table-responsive table-stripped borderless grey x14-font-size">
                                        <tr>
                                            <td class="x3-width"><i class="far fa-user"></i> Name</td>
                                            <td><p class="text-right">{{ (Auth::user()->first_name === Null || Auth::user()->last_name === Null? 'Not supplied' : substr_replace(ucwords(Auth::user()->first_name.' '.Auth::user()->last_name), '********', 4))}}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="x3-width"><i class="far fa-envelope"></i> Email</td>
                                            <td><p class="text-right">{{e(Auth::user()->email)}}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="x4-width"><i class="fas fa-phone-square"></i> Phone</td>
                                            <td><p class="text-right"> +{{$country_prefix}} {{substr_replace(Auth::user()->phone, '**********', 1)}}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="x5-width"><i class="fas fa-address-card"></i> Address</td>
                                            <td><p class="text-right">{{Auth::user()->address === Null ? 'Not supplied' : e(ucwords(substr_replace(substr(Auth::user()->address, 0, 10), '*****************', 10 )))}}</p></td>
                                        </tr>
                                    </table>
                                    <div class="text-right">
                                            <a href="#" class="btn btn-default btn-def btn-lg light-blue no-radius" data-toggle="modal" data-target="#addInfo"> Update Personal Info <i class="far fa-edit"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!--END: personal information-->
                        </div>
                    <!--END: result row-->
                    </div>
                    <div class="row no-padding">
                    <div class="col-md-6 col-sm-12 col-lg-6 white-bg x5-radius text-center x3-padding x2-margin-bottom form-border animated fadeIn delay-2s" id="target-kin">
                           <div class="no-padding no-margin" id="kin">
                                <!--START: kin information-->
                                <h3 class="text-left bold light-blue x3-margin-top border-bottom x1-padding-bottom">Kin Information <i class="pull-right fas fa-chevron-down hand-cursor" id="kin-hider"></i> </h3>
                                <div id="kin-data">
                                    <table class="table table-responsive table-stripped grey x14-font-size">
                                        <tr>
                                            <td class="x4-width"><i class="fas fa-child"></i> Name</td>
                                            <td><p class="text-right">{{$kin_info === Null ? 'Not supplied' : e(ucwords(substr_replace($kin_info->full_name, '*******', 4)))}}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="x4-width"><i class="fas fa-phone-square"></i> Phone</td>
                                            <td><p class="text-right">{{$kin_info === Null ? 'Not supplied' : '+'.$kin_country_prefix.' ' .e(substr_replace($kin_info->phone, '**********', 0))}}</p></td>
                                        </tr>
                                        <tr>
                                            <td class="x4-width"><i class="fas fa-address-card"></i> Address</td>
                                            <td><p class="text-right">{{$kin_info === Null ? 'Not supplied' : e(ucwords(substr_replace($kin_info->address, '***************', 5)))}}</p></td>    
                                        </tr>
                                    </table>
                                    <div class="text-right">
                                        <a href="#" class="btn btn-default btn-def btn-lg light-blue no-radius" data-toggle="modal" data-target="#addKin"> Change Kin <i class="far fa-edit"></i></a>
                                    </div>
                                </div>
                           </div>
                           <!--END: kin information-->
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6  no-padding animated fadeIn delay-2s" id="target-bank">
                            <!--START: bank information-->
                            <div class="no-padding no-margin" id="bank-page">
                                <div class="white-bg x5-radius text-center x3-padding x2-margin-bottom margin-left-content form-border">
                                    <h3 class="text-left bold light-blue x7-margin-top border-bottom x1-padding-bottom">Bank Information  <i class="pull-right fas fa-chevron-down hand-cursor" id="bank-hider"></i></h3>
                                    <div id="bank-data">
                                        <table class="table table-responsive table-stripped grey x14-font-size">
                                            <tr>
                                                <td><i class="far fa-building"></i> Bank Name</td>
                                                <td><p class="text-right">{{$bank_name === '' ? 'Not supplied' : e(ucwords(substr_replace($bank_name, '******', 5)))}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-id-card "></i> Account Name</td>
                                                <td><p class="text-right">{{$bank_info === Null ? 'Not supplied' : e(ucwords(substr_replace(Crypt::decrypt($bank_info->acc_name), '*******', 4)))}}</p></td>
                                            </tr>
                                            <tr>
                                                <td><i class="fas fa-sort-numeric-up"></i> Account number</td>
                                                <td><p class="text-right">{{$bank_info === Null ? 'Not supplied' : substr_replace((Crypt::decrypt($bank_info->acc_number)), '*******', 4)}}</p></td>
                                            </tr>
                                        </table>
                                        <div class="text-right">
                                            <a href="#" class="btn btn-default btn-def btn-lg light-blue no-radius" data-toggle="modal" data-target="#addBank"> Change Bank <i class="far fa-edit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END: bank information-->
                        </div>
                    </div>
                    </div>
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
        //script for addInfo
        $(document).on('click', '#addinfobutton', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('addPersonal')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data:{
                    firstName   : $('#firstName').val(),
                    lastName    : $('#lastName').val(),
                    addresss    : $('#address').val(),
                    state       : $('#state').val(),
                    city        : $('#city').val()
                },
                beforeSend: function(data){
                    $('#process-report').css('color', 'green').text('Processing...').addClass('animated fadeIn slower');
                },
                success: function(data){
                    $('#addInfo').modal('hide');
                    $('#process-report').text('');
                    $('#firstName').val('');
                    $('#lastName').val('');
                    $('#lastName').val('');
                    $('#address').val('');
                    $('#state').val('');
                    $('#city').val('');
                    $('#process-report').text('');
                    $('#firstName-report').text('');
                    $('#lastName-report').text('');
                    $('#address-report').text('');
                    $('#state-report').text('');
                    $('#city-report').text('');
                    $('#reportModal').modal('show').addClass('animated bounceInDown slower delay-1s');
                    $('#report').addClass('grey').text(data.success);
                    $('#report-title').text('Update Report');
                    $('.icon').show().css('color', 'green').addClass('animated fadeIn slow delay-3s');
                    $('#personal-target').load(url +' #personal', function(e){
                        $('#wishlist-count-container').load(url + ' #wishlist-count', function(e){
                            //wishlist count has been updated//
                            $('#notification-count-container').load(url +' #notification-count', function(e){
                                //notification count updated//
                                $('#notification-notes').load(url +' #notes', function(e){
                                    //notification notes updated//
                                });
                            });
                        });
                    });
                },
                error: function(validator){
                    var jsonResponse = JSON.parse(validator.responseText);
                    // alert(jsonResponse.errors.firstName);
                    $('#process-report').css('color', 'maroon').text(jsonResponse.message).addClass('animated fadeIn slower');
                    $('#firstName-report').css('color', 'maroon').text(jsonResponse.errors.firstName).addClass('animated fadeIn slower');
                    $('#lastName-report').css('color', 'maroon').text(jsonResponse.errors.lastName).addClass('animated fadeIn slower');
                    $('#address-report').css('color', 'maroon').text(jsonResponse.errors.addresss).addClass('animated fadeIn slower');
                    $('#state-report').css('color', 'maroon').text(jsonResponse.errors.state).addClass('animated fadeIn slower');
                    $('#city-report').css('color', 'maroon').text(jsonResponse.errors.city).addClass('animated fadeIn slower');
                }
            });
        });
        //end//

        //code snippet is for kin
        $(document).on('click', '#addkinbutton', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('addKin')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data:{
                    fullName   : $('#fullName').val(),
                    email      : $('#email').val(),
                    phone      : $('#phone').val(),
                    addressed  : $('#kin-address').val(),
                    country    : $('#country').val(),
                    relation   : $('#relationship').val()
                },
                beforeSend: function(data){
                    $('#process-report-kin').css('color', 'green').text('Processing...').addClass('animated fadeIn slower');
                },
                success: function(data){
                    $('#process-report-kin').addClass('animated fadeOut slower').text('');
                    $('#addKin').modal('hide');
                    $('#fullName').val('');
                    $('#email').val('');
                    $('#phone').val('');
                    $('#kin-address').val('');
                    $('#country').val('');
                    $('#relationship').val('');
                    $('#reportModal').modal('show').addClass('animated bounceInDown slower delay-1s');
                    $('#report').addClass('grey').text(data.message);
                    $('#report-title').text('Update Report');
                    $('.icon').show().css('color', 'green').addClass('animated fadeIn slow delay-3s');
                    $('#process-report-kin').text('');
                    $('#fullName-report').text('');
                    $('#kinEmail-report').text('');
                    $('#kinPhone-report').text('');
                    $('#kinAddress-report').text('');
                    $('#kinCountry-report').text('');
                    $('#kinRelation-report').text('');
                    $('#target-kin').load(url +' #kin', function(e){
                        $('#wishlist-count-container').load(url + ' #wishlist-count', function(e){
                            //wishlist count has been updated//
                            $('#notification-count-container').load(url +' #notification-count', function(e){
                                //notification count updated//
                                $('#notification-notes').load(url +' #notes', function(e){
                                    //notification notes updated//
                                });
                            });
                        });
                    });
                },
                error: function(data){
                    var jsonResponse = JSON.parse(data.responseText);
                    $('#process-report-kin').css('color', 'maroon').text(jsonResponse.message).addClass('animated fadeIn slower');
                    $('#fullName-report').css('color', 'maroon').text(jsonResponse.errors.fullName).addClass('animated fadeIn slower');
                    $('#kinEmail-report').css('color', 'maroon').text(jsonResponse.errors.email).addClass('animated fadeIn slower');
                    $('#kinPhone-report').css('color', 'maroon').text(jsonResponse.errors.phone).addClass('animated fadeIn slower');
                    $('#kinAddress-report').css('color', 'maroon').text(jsonResponse.errors.addressed).addClass('animated fadeIn slower');
                    $('#kinCountry-report').css('color', 'maroon').text(jsonResponse.errors.country).addClass('animated fadeIn slower');
                    $('#kinRelation-report').css('color', 'maroon').text(jsonResponse.errors.relation).addClass('animated fadeIn slower');
                }
            });
        });
        //end//

        $(document).on('click', '#addBankButton', function(e){
            e.preventDefault();
        
            $.ajax({
                url: "{{route('addBank')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data:{
                    acc_name   : $('#accountName').val(),
                    acc_number : $('#accountNumber').val(),
                    bank       : $('#bank').val(),
                },
                beforeSend: function(data){
                    $('#process-report-bank').css('color', 'green').text('Processing...').addClass('animated fadeIn slower');
                },
                success: function(data){
                    $('#process-report-bank').addClass('animated fadeOut slower').text('');
                    $('#addBank').modal('hide');
                    $('#accountName').val('');
                    $('#accountNumber').val('');
                    $('#bank').val('');
                    $('#reportModal').modal('show').addClass('animated bounceInDown slower delay-1s');
                    $('#report').addClass('grey').text(data.message);
                    $('#report-title').text('Update Report');
                    $('.icon').show().css('color', 'green').addClass('animated fadeIn slow delay-3s');
                    $('#accName-report').text('');
                    $('#accNumber-report').text('');
                    $('#bank-report').text('');
                    $('#target-bank').load(url +' #bank-page', function(e){
                        $('#wishlist-count-container').load(url + ' #wishlist-count', function(e){
                            //wishlist count has been updated//
                            $('#notification-count-container').load(url +' #notification-count', function(e){
                                //notification count updated//
                                $('#notification-notes').load(url +' #notes', function(e){
                                    //notification notes updated//
                                });
                            });
                        });
                    });
                },
                error: function(data){
                    var jsonResponse = JSON.parse(data.responseText);
                    $('#process-report-bank').css('color', 'maroon').text(jsonResponse.message).addClass('animated fadeIn slower');
                    $('#accName-report').css('color', 'maroon').text(jsonResponse.errors.acc_name).addClass('animated fadeIn slower');
                    $('#accNumber-report').css('color', 'maroon').text(jsonResponse.errors.acc_number).addClass('animated fadeIn slower');
                    $('#bank-report').css('color', 'maroon').text(jsonResponse.errors.bank).addClass('animated fadeIn slower');
                }
            });
        });
    </script>
</section>
@endsection