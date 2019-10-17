@extends('v1.master.investor')

@section('title', 'ticket')

<!--START: disable-account modal-->
<div id="diableModal" class="modal animated slideInDown slower delay-2s x5-margin-top x10-margin-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content no-radius">
            <div class="modal-header navbar-bg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title bolder white x14-font-size"><i class="fas fa-info-circle"></i> <span class="title">Delete Ticket</span></h4>
            </div>
            <div class="modal-body grey-bg-light">
                <p class="lead x14-font-size text-left grey x2-padding">
                    <span class="display-text x14-font-size"> Are you sure you want to delete this ticket ? </span> <i class="fas fa-check-circle icon x20-font-size"></i>
                </p>
            </div>
            <div class="modal-footer grey-bg-light">
                <button type="button" class="btn btn-danger btn-lg no-radius no-delete x14-font-size" data-dismiss="modal"> <span class="no">No</span> <i class="fa fa-times"></i> </button>
                <a class="btn btn-info btn-lg no-radius yes-delete x14-font-size"> <span class="yes">Yes</span> <i class="fa fa-check"></i> </a>
            </div>
        </div>
    </div>
</div>
<!--END: disable-account modal-->

<!--START: report modal-->
<div id="reportModal" class="modal animated slideInDown slower delay-2s x5-margin-top x10-margin-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content no-radius">
            <div class="modal-header navbar-bg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="report-title bolder white x14-font-size"><i class="fas fa-info-circle"></i> <span class="title"></span></h4>
            </div>
            <div class="modal-body grey-bg-light">
                <p class="lead x14-font-size text-left grey x2-padding">
                    <span class="report-display-text x14-font-size"> </span> <i class="fas fa-check-circle report-icon x20-font-size"></i>
                </p>
            </div>
            <div class="modal-footer grey-bg-light">
                <button type="button" class="btn btn-danger btn-lg no-radius no-delete x14-font-size" data-dismiss="modal"> <span class="no">Close</span> <i class="fa fa-times"></i> </button>
            </div>
        </div>
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
    <div class="container-fluid flex x1-margin-bottom x9-width">
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
                <div class="container-fluid"  id="result">
                    <!--START: heading row-->
                    <div class="row no-padding  animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border">
                            <h1 class="text-center grey bold">Ticket Response</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom border-left border-right border-bottom bottom-border-radius white-bg animated fadeIn delay-2s">
                        @if(count($ticket_message->pluck('id')) > 0)
                            <?php $count = count($ticket_message->pluck('id'))  ?>
                            @for($i = 0; $i < count($ticket_message->pluck('id')); $i++)
                                <div class="col-md-12 col-sm-12 col-lg-12 text-center x3-padding ticket-box x14-font-size {{$count === $i+1 ? '' : 'border-bottom'}} ">
                                    <div class="container-fluid no-padding no-margin">
                                        <div class="row no-padding no-margin">
                                            <div class="col-md-12 col-sm-12 col-lg-12">
                                                <h3 class="text-left {{$ticket_message->pluck('satisfied')[$i] == 1 ? 'grey' : 'light-blue'}} bold">
                                                    <i class="far fa-envelope"></i> {{strtoupper($ticket_message->pluck('ticket_subject')->pluck('subject')[$i])}} 
                                                </h3>
                                                <p class="grey text-left x9-width letters">
                                                    {{str_limit(strip_tags($ticket_message->pluck('message')[$i]), 300)}}
                                                </p>
                                                <p class="grey text-left">
                                                    <i class="far fa-calendar"></i>
                                                    {{$ticket_message->pluck('created_at')[$i]}}
                                                </p>
                                                <div class="text-left x3-margin-top">
                                                    <a href="{{route('readResponse', \Crypt::encrypt($ticket_message->pluck('id')[$i]))}}" class="btn btn-default btn-lg btn-def no-radius">
                                                        Read <i class="fas fa-check-circle"></i>
                                                    </a>        
                                                    <!--delete modal trigger-->
                                                    <a class="btn btn-danger btn-lg no-radius btn-dan delete" data-id="{{\Crypt::encrypt($ticket_message->pluck('id')[$i])}}" data-toggle="modal" data-target="#diableModal">Delete <i class="fas fa-trash"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @else
                            <div class="col-md-12 col-sm-12 col-lg-12 text-center x5-radius white-bg x10-padding animated fadeIn delay-2s x14-font-size x1-margin-bottom">
                                <h1 class=" grey bolder x10-padding-top x10-margin-bottom x10-margin-top x10-padding-bottom" style="transform:skew(0deg, -10deg) translateY(-115px); opacity:0.5">No Messages <i class="fa fa-exclamation"></i> </h1>
                            </div>
                        @endif
                    </div>
                    @if(count($ticket_message->pluck('id')) > 0)
                        <div class="row x1-margin-top animated fadeIn delay-2s text-right"><!--START: load more div-->
                            <div class="col-md-12 col-sm-12 col-lg-12 no-padding">
                                {{$ticket_message->links()}}
                            </div>
                        </div><!--END: Load more div-->
                    @endif
                    <!--END: result row-->
                </div>
                <!--END: nav result container-->
            </div>
            <!--END: main content column-->
        </div>
        <!--END: overall row-->
    </div>
    <!--END: overall container-->
</section>
<script type="text/javascript">
   $(document).ready(function(){
       var url = window.location.href;
       $('.icon').hide();
       $(document).on('click', '.delete', function(){
           let ticket_id = $(this).attr("data-id");
           $(document).on('click', '.yes-delete', function(){
            $.ajax({
                type:'GET',
                url: "{{route('deleteTicket','')}}/"+ticket_id,
                datatype: 'json',
                beforeSend: function(){
                    $('.display-text').fadeIn().css('color', 'green').text('Processing.......');
                },
                success: function(data){
                    $('#diableModal').modal('hide');
                    $('#reportModal').modal('show').addClass('animated bounceInDown slower delay-2s');
                    $('.display-text').css('color', '#888').text('Are you sure you want to delete this ticket ?');
                    $('.title').text('Update Report');
                    $('.report-display-text').fadeIn().css('color', '#888').text('The selected ticket has been deleted successfully');
                    $('.report-icon').show().css('color', 'green').addClass('animated fadeIn slower delay-4s');
                    $('#target').load(url + " #result", function(e){
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
                },
                error: function(data){
                    $('.no').text('Close');
                    $('.yes-delete').hide();
                    $('.display-text').text('Sorry an error has occured. Kindly try again later.');
                }
            });
           });
       });
       
       $(document).on('click', '.pagination a', function(e){
           e.preventDefault();
           
           var page = $(this).attr('href');
           getTicketMessages(page);
           
           function getTicketMessages(page){
               var resultSection = $('#result');
               $('#target').load(page + ' #result', function(){
                    //take page focus to screen top
                    var body = $("html, body");
                    body.stop().animate({scrollTop:10}, 500, 'swing', function() { 
                      //focus placed on screen top//
                    });
                    //end//
               });
           }
       });
   });
</script>
@endsection

