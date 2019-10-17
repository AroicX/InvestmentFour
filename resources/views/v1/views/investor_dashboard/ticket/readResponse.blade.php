@extends('v1.master.investor')

@section('title', 'ticket')

<div class="modal fade x5-margin-top x10-margin-left" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content no-radius">
            <div class="modal-header navbar-bg">
                <button class="close  no-radius btn delete-link transparent" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');">x</button>
                <h4 class="white bold no-margin x16-font-size"> <i class="fas fa-info-circle"></i> <span id="report-title">Reply</span></h4>
            </div>
            <form method="post">
                @csrf()
                <div class="modal-body grey-bg-light">
                    <div id="reply-form">
                        <p class="x12-font-size report-message text-center"></p>
                        <input type="hidden" name="ticket_message_id" class="id" id="id" value="{{$ticket_message->id}}">
                        <div class="form-group">
                            <label for="message" class="grey">Message</label>
                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <span class="message-errror"></span>
                    </div>
                </div>
                <div class="modal-footer grey-bg-light">
                    <a class="btn btn-danger btn-lg no-radius btn-dan" data-dismiss="modal"> Close <i class="fas fa-times"></i> </a>
                    <button type="button" id="submit-reply" class="btn btn-info btn-lg btn-inf no-radius">Send Ticket <i class="fas fa-mail-bulk"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade x5-margin-top x10-margin-left" id="reportModal">
    <div class="modal-dialog">
        <div class="modal-content no-radius">
            <div class="modal-header navbar-bg">
                <button class="close  no-radius btn btn-primary" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');"></button>
                <h4 class=" header white bold no-margin x14-font-size"> <i class="fas fa-info-circle"></i> <span id="modal-title"></span></h4>
            </div>
            <div class="modal-body grey-bg-light">
                <p class="lead transparent x14-font-size">
                    <span class="grey" id="modal-report-message"></span>
                    <i class="fas fa-check-circle icon x20-font-size"></i>
                </p>
            </div>
            <div class="modal-footer grey-bg-light">
                <button type="button"  class="btn btn-danger btn-lg no-radius btn-dan" data-dismiss="modal"> Close <i class="fas fa-times"></i> </button>
            </div>
        </div>
    </div>
</div>

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
            <div class="col-md-8 col-sm-12 col-lg-8 margin-left-content x2-margin-bottom no-padding" id="target">
                <!--START: nav result container-->
                <div class="container-fluid" id="result">
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom  form-border white-bg animated fadeIn slow delay-1s">

                        @for($count = 0; $count < count($ticket_response->pluck('ticket_message_id')); $count++)
                            <div class="col-md-12 col-sm-12 col-lg-12 text-center response-box ticket-box border-bottom x3-padding animated slower fadeIn delay-{{$count}}s x12-font-size">
                                <div class="text-right">
                                    <span class="normal x2-margin-left border-right x2-padding-right {{$ticket_message->satisfied == 1 ? 'no-view' : 'response-menu'}} ">
                                        <a href="#" class="reply-link normal-link"><i class="fas fa-reply"></i> Reply</a>
                                    </span>
                                    <span class="normal x2-margin-left {{$ticket_message->satisfied == 1 ? '' : 'response-menu'}} ">
                                        <a href="#" class=" {{$ticket_message->satisfied == 1 ? 'satisfied' : 'satisfied-link'}} normal-link sat-link"><i class="fas fa-heart {{$ticket_message->satisfied == 1 ? 'animated slower heartBeat infinite' : ''}} satisfied-icon"></i> Satisfied</a>
                                    </span>
                                </div>
                                <p class="grey text-left no-margin x2-padding x14-font-size">
                                    <i class="fas fa-{{($ticket_response->pluck('responder_id')[$count]) != Auth::user()->investor_id ? 'user-shield' : 'user'}} light-blue x16-font-size"></i> 
                                    <span class="light-blue 16-font-size">
                                        {{($ticket_response->pluck('responder_id')[$count]) != Auth::user()->investor_id ? strtoupper('Admin Name') : strtoupper('Me')}}
                                    </span>
                                </p>
                                <h4 class="text-left grey x2-margin-left no-margin-top x2-margin-bottom bolder"> {{ strtoupper($ticket_response->pluck('created_at')[$count]) }} </h4>
                                <?php $messageResponse = nl2br($ticket_response->pluck('message')[$count]) ?>
                                    <p class="grey x14-font-size text-left x2-margin-left x4-margin-right message no-margin-bottom no-padding letters">
                                        {!! $messageResponse !!} 
                                    </p>
                            </div>
                        @endfor
                        <div class="col-md-12 col-sm-12 col-lg-12 text-center ticket-box  x3-padding animated slower fadeIn delay-1s x12-font-size">
                           <div class="text-right">
                                <span class="normal x2-margin-left border-right x2-padding-right {{$ticket_message->satisfied == 1 ? 'no-view' : 'response-menu'}} ">
                                    <a href="#" class="reply-link normal-link"><i class="fas fa-reply"></i> Reply</a>
                                </span>
                                <span class="normal x2-margin-left {{$ticket_message->satisfied == 1 ? '' : 'response-menu'}} ">
                                    <a href="#" class=" {{$ticket_message->satisfied == 1 ? 'satisfied' : 'satisfied-link'}} normal-link sat-link"><i class="fas fa-heart {{$ticket_message->satisfied == 1 ? 'animated slower heartBeat infinite' : ''}} satisfied-icon"></i> Satisfied</a>
                                </span>
                           </div>
                           <p class="grey text-left no-margin x2-padding x14-font-size">
                                <i class="fas fa-user light-blue x16-font-size"></i> <span class="grey"> {{strtoupper('Me')}} </span>
                           </p>
                           <h4 class="text-left grey x2-margin-left no-margin-top x2-margin-bottom bolder"> {{ strtoupper($ticket_message->created_at) }} </h4>
                            <?php $message = nl2br($ticket_message->message) ?>
                            <p class="grey x14-font-size text-left x2-margin-left x4-margin-right message no-margin-bottom no-padding letters">
                                {!! $message !!}
                            </p>
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
        //method gets user satisfied
        var url = window.location.href;
        $(document).on('click', '.sat-link', function() {
            var sat_links = $(this);
            $.ajax({
            'type':'GET',
            'url' : '{{route('satisfiedResponse', \Crypt::encrypt($ticket_message->id))}}',
            data  : {
                'id' : '{{\Crypt::encrypt($ticket_message->id)}}'
            },
            success : function(data)
            {
                $('#wishlist-count-container').load(url + ' #wishlist-count', function(e){
                    //wishlist count has been updated//
                    $('#notification-count-container').load(url +' #notification-count', function(e){
                        //notification count updated//
                        $('#notification-notes').load(url +' #notes', function(e){
                            sat_links.css({
                                'color':'green',
                                'font-weight':'bolder'
                            });
                            // sat-links.find('reply-link').removeClass('response-menu').addClass('no-view');
                            sat-links.find('.satisfied-icon').addClass('animated heartBeat slower');
                        });
                    });
                });
            },
            errors : function(data)
            {
                alert('failed');
            },

            });
        });
        //end//

        //method submits reply
        $(document).on('click', '#submit-reply', function(){
            var url = window.location.href;
            $.ajax({
                url: "{{route('replyResponse')}}",
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                data: { 
                    ticket_message_id: $('#id').val(),
                    responder_id: "{{Auth::user()->investor_id}}",
                    message: $('#message').val(),
                },
                beforeSend: function(data){
                    $('.report-message').css({'color':'green', 'font-weight':'bolder', 'opacity':1.0}).text('Sending...').removeClass('animated fadeOut slower');
                    $('.message-errror').text('Processing...').css('color', 'green');
                },
                success: function(data){
                    $('.report-message').css('opacity', 0.0);
                    $('.message-errror').text('');
                    $('#message').val('');
                    if(!data.error){
                        $('#myModal').modal('hide');
                        $('#target').load(url + " #result", function(response, status, xhr){
                            if(status == "success"){
                                $('.icon').css('color', 'rgb(39, 160, 39)').addClass('animated fadeIn slow delay-3s');
                                $('#modal-report-message').html(data.success);
                                $('#modal-title').html('Update Report');
                                $('#reportModal').modal('show').addClass('animated bounceInDown slower delay-1s');
                            }
                            //take page focus to screen top
                            var body = $("html, body");
                            body.stop().animate({scrollTop:0}, 500, 'swing', function() { 
                                //focus placed on screen top//
                            });
                                //end//
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

                    }else{
                        $('.message-errror').css('color', 'maroon').text(data.error).addClass('animated fadeIn slow delay-1s');
                    }
                },
                error: function(data){
                    $('.report-message').addClass('animated fadeIn slow').text(data.error);
                }
            });
        });
        //end//
    </script>
</section>
@endsection