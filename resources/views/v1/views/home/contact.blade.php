@extends('v1.master.public')

@section('title', 'contact us')

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
<section>
    <div class="container-fluid x8-width no-padding-top no-margin-top-header x2-margin-bottom animated fadeIn slow delay-1s">
        <div class="row no-padding white-bg form-border x1-margin-bottom bottom-border-radius">
            <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding no-margin text-center">
                <img src="/images/contact_us.jpg" alt="Contact Us Image" title="Contact Us" class="img img-responsive" />
                <div class="container-fluid">
                    <div class="row x2-padding">
                        <div class="col-md-3 col-sm-12 col-lg-3 text-left">
                            <a href="tel:{!! App\Http\Controllers\AppController::getSupportLine() ? App\Http\Controllers\AppController::getSupportLine()->first() : '' !!}" class="btn btn-primary btn-inf no-radius btn-lg">Call Us <i class="fas fa-check-circle"></i> </a>
                        </div>
                        <div class="col-md-9 col-sm-12 col-lg-9 text-right-footer no-padding-right">
                            <span class="bolder grey x14-font-size"><span class="light-blue">Follow U</span>s:</span>
                            @if(App\Http\Controllers\AppController::getFacebookLink())<a target="_blank" href="{!! App\Http\Controllers\AppController::getFacebookLink() !!}" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-facebook-square x16-font-size"></i></a>@endif
                            @if(App\Http\Controllers\AppController::getTwitterLink())<a target="_blank" href="" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-twitter-square x16-font-size"></i></a>@endif
                            @if(App\Http\Controllers\AppController::getDiscordLink())<a target="_blank" href="" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-discord x16-font-size"></i></a>@endif
                            @if(App\Http\Controllers\AppController::getInstagramLink())<a target="_blank" href="" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-instagram x16-font-size"></i></a>@endif
                            @if(App\Http\Controllers\AppController::getTelegramLink())<a target="_blank" href="" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-telegram x16-font-size"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-padding-left no-padding-right x5-padding-bottom white-bg form-border x4-radius">
        <h3 class="bolder grey about-margin x2-margin-left x3-margin-top heading"> <span class="light-blue">CONTA</span>CT US </h3>
            <div class="col-md-5 col-sm-12 col-lg-5 x4-padding-left x1-padding-top x2-padding-right ">
                <div class="x2-margin-top">
                     <!-- START: Support Contacts -->
                     @if(App\Http\Controllers\AppController::getSupportLine ())
                     <div id="support-div">
                        <h4 class="x15-font-size grey no-margin bolder border-bottom-footer-color x2-padding-bottom heading-2"> <i class="fas fa-user-clock light-blue"></i> Support </h4>
                        @foreach(App\Http\Controllers\AppController::getSupportLine () as $support)
                            <p class="x14-font-size grey normal x5-margin-top" id="support-1-paragraph">
                                <i class="fas fa-phone-square"></i>
                                {!! $support !!}
                            </p>
                        @endforeach
                    </div>
                    @endif
                    <!-- END -->
                    <!-- START: address -->
                    @if(App\Http\Controllers\AppController::getContactAddress())
                    <div class="address-div" style="margin-top:15%">
                        <h4 class="x15-font-size grey no-margin bolder border-bottom-footer-color x2-padding-bottom heading-2"> <i class="fas fa-map-marker light-blue"></i> Address </h4>
                        @foreach(App\Http\Controllers\AppController::getContactAddress() as $address)
                            <p class="grey normal x14-font-size x4-margin-top">
                                {!! nl2br(ucwords($address)) !!}
                            </p>
                        @endforeach
                    </div>
                    @endif
                    <!-- END -->
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-6 margin-left-content x1-padding-top x2-padding-right">
                <!-- START: contact form -->
                <div class="margin-left-content form-border form-border">
                    <h4 class="bolder grey no-margin x2-padding heading-2">
                        <i class="fas fa-edit light-blue"></i> CONTACT FORM
                    </h4>
                    <p class="x3-margin no-radius no-view x13-font-size" id="report-section"> <span id="report-text"></span><i class="fas fa-times grey pull-right hand-cursor" onclick="$('#report-section').css('display', 'none')"></i></p>
                    @if(session('successBag')) 
                        <p id="successBag" class="x13-font-size x3-margin alert alert-success no-radius animated fadeIn slow delay-2s">{{session('successBag')}} <i class="fas fa-check-circle"></i> <i class="fas fa-times grey pull-right hand-cursor" onclick="$('#successBag').slideUp()"></i></p>
                    @elseif(session('errorBag'))
                        <p id="errorBag" class="x13-font-size x3-margin alert alert-danger no-radius animated fadeIn slow delay-2s">{{session('errorBag')}} <i class="fas fa-times-circle"></i>  <i class="fas fa-times grey pull-right hand-cursor" onclick="$('#errorBag').slideUp()"></i></p>
                    @endif
                    <form action="{{route('contact')}}" method="post">
                        @csrf() 
                        <div class="x3-margin x12-font-size text-normal" id="form-div">
                            <div class="form-group">
                                <label for="email" id="emal-label" class="grey normal">Email <span class="email-asterisk {{$errors->has('email') ? 'maroon' : ''}} ">*</span> </label>
                                <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control no-radius input-lg"/>
                                @if($errors->has('email'))<p class="maroon x11-font-size">{{$errors->first('email')}}</p>@endif
                                <p class="maroon x11-font-size" id="email-error"></p>
                            </div>
                            <div class="input-group">
                                <div clas="row">
                                    <div class="col-md-6 col-sm-12 col-lg-6 no-padding">
                                        <label for="name" class="normal grey" id="name-label">Name <span class="name-asterisk {{$errors->has('name') ? 'maroon-2' : ''}}">*</span></label>
                                        <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control no-radius input-lg"/>
                                        @if($errors->has('name'))<p class="maroon x11-font-size">{{$errors->first('name')}}</p>@endif
                                        <p class="maroon x11-font-size" id="name-error"></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-6 no-padding-left-responsive no-padding-right">
                                        <label for="phone" class="normal grey" id="phone-label"> Phone <span class="phone-asterisk {{$errors->has('phone') ? 'maroon' : ''}} ">*</span></label>
                                        <input type="number" name="phone" id="phone" placeholder="Enter Phone" class="form-control no-radius input-lg" />
                                        @if($errors->has('phone'))<p class="maroon x11-font-size">{{$errors->first('phone')}}</p>@endif
                                        <p class="maroon x11-font-size" id="phone-error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group x3-margin-top">
                                <label for="message" id="message-label" class="normal grey"> Message <span class="message-asterisk {{$errors->has('message') ? 'maroon' : ''}} ">*</span> </label>
                                <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter Message" class="form-control no-radius input-lg"></textarea>
                                @if($errors->has('message'))<p class="maroon x11-font-size">{{$errors->first('message')}}</p>@endif
                                <p class="maroon x11-font-size" id="message-error"></p>
                            </div>
                            <div class="x2-margin-top text-right">
                                <button type="submit" class="btn btn-success btn-lg no-radius" id="message-submit-button">Send Message <i class="fas fa-check-circle"></i> </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END -->
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click', '#message-submit-button', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('contact')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data:{
                    email   : $('#email').val(),
                    name    : $('#name').val(),
                    phone   : $('#phone').val(),
                    message : $('#message').val()
                },
                beforeSend: function(data){
                    $('#email-error').removeClass('maroon').addClass('green').text('Processing...');
                    $('#name-error').removeClass('maroon').addClass('green').text('Processing...');
                    $('#phone-error').removeClass('maroon').addClass('green').text('Processing...');
                    $('#message-error').removeClass('maroon').addClass('green').text('Processing...');
                },
                success: function(data){
                    $('#email-error').text('');
                    $('#name-error').text('');
                    $('#phone-error').text('');
                    $('#message-error').text('');
                    $('#report-text').text('');
                    
                    //checking if message was submitted or error occured
                    if(data.successBag){
                        $('#report-section').css('display', 'block').addClass('animated fadeIn slow alert alert-success');
                        $('#report-text').append(data.successBag).append(' <i class="fas fa-check-circle"></i>');
                        $('#email').val('');
                        $('#name').val('');
                        $('#phone').val('');
                        $('#message').val('');
                    }else{
                        $('#report-section').css('display', 'block').addClass('animated fadeIn slow alert alert-danger');
                        $('#report-text').append(data.errorBag).append(' <i class="fas fa-times-circle"></i>');
                    }
                    // end //
                },
                error: function(data){
                    var jsonResponse = JSON.parse(data.responseText);
                    // checking if email field has error
                    if(jsonResponse.errors.email){
                        $('#email-error').removeClass('green').addClass('maroon').text(jsonResponse.errors.email).addClass('animated fadeIn slow');
                    }else{
                        $('#email-error').text('');
                    }
                    // end //
                    // checking if name field has error 
                    if(jsonResponse.errors.name){
                        $('#name-error').removeClass('green').addClass('maroon').text(jsonResponse.errors.name).addClass('animated fadeIn slow');
                    }else{
                        $('#name-error').text('');
                    }
                    // end //

                    // checking if phone field has error
                    if(jsonResponse.errors.phone){
                        $('#phone-error').removeClass('green').addClass('maroon').text(jsonResponse.errors.phone).addClass('animated fadeIn slow');
                    }else{
                        $('#phone-error').text('');
                    }
                    // end //

                    // checking if message has error
                    if(jsonResponse.errors.message){
                        
                        $('#message-error').removeClass('green').addClass('maroon').text(jsonResponse.errors.message).addClass('animated fadeIn slow');
                    }else{
                        $('#message-error').text('');
                    }
                    // end //
                }
            });
        });
    </script>
</section>
@endsection