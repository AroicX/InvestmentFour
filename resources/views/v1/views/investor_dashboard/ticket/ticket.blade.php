@extends('v1.master.investor')

@section('title', 'ticket')

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

<div class="modal fade x5-margin-top x10-margin-left" id="myModal">
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
                <a href="{{route('ticketResponse')}}" class="btn btn-danger btn-lg no-radius btn-dan" > Close <i class="fas fa-times"></i> </a>
            </div>
        </div>
    </div>
</div>

@section('content')
<section>
    <style>
        .sclabled{object-fit: scale-down;
    transform: scale(1);}
    </style>
    <div class="container-fluid flex x1-margin-bottom x9-width">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-lg-3 x2-margin-bottom x5-padding-top white-bg form-border text-center no-padding-left no-padding-right animated fadeIn slower">
                <div class="x5-padding-bottom x0-margin-left x0-margin-right border-bottom">
                    <i class="fas fa-user-circle large-icon light-blue sclabled"></i>
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
                <div class="container-fluid" id="result">
                    <!--START: heading row-->
                    <div class="row no-padding  animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border">
                            <h1 class="text-center grey bold">Create Ticket</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg bottom-border-radius text-center x3-padding x2-margin-bottom border-left border-right border-bottom animated fadeIn delay-2s x14-font-size">
                            <form method="post" id="form-data">
                            @csrf()
                                <div class="form-group text-left x3-margin-top">
                                    <label for="subject" class="grey normal x4-margin-left">Subject</label>
                                    <select name="subject" id="subject" class="form-control input-lg x4-margin-left x9-width no-radius input grey">
                                        <option value="" selected>Select Subject</option>
                                        @foreach($ticket_subject as $ticket_subjects)
                                            <option value="{{$ticket_subjects->id}}">{{strtoupper($ticket_subjects->subject)}}</option>
                                        @endforeach
                                    </select>
                                    
                                        <span class=" x4-margin-left x10-font-size maroon" id="subject-error">{{$errors->first('subject')}}</span>
                                   
                                </div>

                                <div class="form-group text-left x3-margin-top">
                                    <label for="message" id="message-label" class="grey normal x4-margin-left">Message</label>
                                    <textarea name="message" id="message" cols="30" rows="15" class="form-control x4-margin-left x9-width"></textarea>
                                    
                                        <span class="x4-margin-left x10-font-size maroon" id="message-error">{{$errors->first('message')}} </span>
                                   
                                </div>
                                <div class="form-group text-right x4-margin-top x6-margin-right">
                                    <button class="btn btn-info btn-lg no-radius" id="submit" type="button">
                                        Send Ticket <i class="fas fa-mail-bulk"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--END: result row-->
                    <script type="text/javascript">
                        $(document).on('click', '#submit', function (e){
                            $.ajax({
                                url: "{{route('ticket')}}",
                                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                                type: 'POST',
                                dataType: 'json',
                                data: { 
                                    ticket_subject_id: $('#subject').val(),
                                    message: $('#message').val(),
                                    investor_id: "{{Auth::user()->investor_id}}"
                                },
                                beforeSend: function(data){
                                        $('#subject-error').css('color', 'green').text('Processing...');
                                        $('#message-error').css('color', 'green').text('Processing...');
                                },
                                success: function(data){
                                    $('#subject-error').text('');
                                    $('#message-error').text('');
                                    if (data.subject && data.message)
                                    {
                                        $('#report-title').text('Update Report');
                                        $('#subject-error').text(data.subject).css('color', 'maroon');
                                        $('#message-error').text(data.message).css('color', 'maroon');
                                    }
                                    if (!data.subject && !data.message)
                                   {
                                        $('.modal').modal('show').addClass('animated bounceInDown slower delay-1s');;
                                        $('#report').text(data.success);
                                        $('#report-title').text('Update Report');
                                        $('.icon').show().css('color', 'green').addClass('animated fadeIn slow delay-3s');
                                        $('#subject').val('');
                                        $('#message').val('');
                                   }
                                },
                                error: function(data) {
                                    var jsonResponse = JSON.parse(data.responseText)
                                    alert(jsonResponse);
                                }
                            });
                        });
                    </script>
                </div>
                <!--END: nav result container-->
            </div>
            <!--END: main content column-->
        </div>
        <!--END: overall row-->
    </div>
    <!--END: overall container-->
</section>
@endsection

