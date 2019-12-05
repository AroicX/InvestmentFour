@extends('v1.master.investor')

@section('title', 'wishlist')

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
            <div class="col-md-8 col-sm-12 col-lg-8 margin-left-content x2-margin-bottom no-padding">
                <!--START: nav result container-->
                <div class="container-fluid" id="target">
                    <!--START: heading row-->
                    <div class="row no-padding  animated fadeIn delay-1s x1-margin-bottom" id="header">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border">
                            <h1 class="text-center grey bold">My Wishlist</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom white-bg form-border x5-radius animated fadeIn delay-2s" id="result">
                        @if(count($wishlists))
                            @foreach($wishlists as $wishlist)
                                <div class="col-md-6 col-sm-12 col-lg-6 text-center x3-padding x2-margin-bottom">
                                    <figure class="form-border x5-radius x1-padding">
                                        <img src="/images/{{$wishlist->investment->property_upload->property_type}}/{{$wishlist->investment->property_upload->property_upload_image->front_image}}" alt="" class="img-responsive x400-img-height image x10-width img-thumbnail" />
                                        <figcaption style="position: absolute; top:20px" class="{{e($wishlist->investment->avail_slots == 0 ? 'maroon-bg' : 'green-bg')}} x3-padding white bold x1-margin-left x5-radius x16-font-size">{{e($wishlist->investment->avail_slots == 0 ? 'Unavailable' : 'Available')}}</figcaption>
                                        <h4 class="grey text-center x9-bold blue-bg x5-padding no-margin x14-font-size">{{strtoupper($wishlist->investment->property_upload->title)}}</h4>
                                        <!--START: property information table-->
                                        <table class="table table-responsive table-stripped grey x14-font-size no-margin">
                                            <tr>
                                                <td>Property Region</td>
                                                <td class="text-right">{{e(ucfirst($wishlist->investment->property_upload->property_region))}}</td>
                                            </tr>
                                            <tr>
                                                <td>Property Type</td>
                                                <td class="text-right">{{e(ucfirst($wishlist->investment->property_upload->property_type))}}</td>
                                            </tr>
                                            <tr>
                                                <td>Available Slot(s)</td>
                                                <td class="text-right">{{e($wishlist->investment->avail_slots)}}</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Rentage</td>
                                                <td class="text-right">{{($wishlist->investment->property_upload->rentage == 0 ? 'No' : 'Yes')}}</td>
                                            </tr>
                                            <tr>
                                                <td>Sell-off Profit</td>
                                                <td class="text-right">&#8358;{{e(number_format($wishlist->investment->profit_per_slot_on_sell_off, 2))}}</td>
                                            </tr>
                                            <tr class="active">
                                                <td>Property Cost</td>
                                                <td class="text-right"> &#8358;{{e(number_format(doubleval($wishlist->investment->property_upload->cost), 2))}}</td>
                                            </tr>
                                        </table><!--END: property information table-->
                                        <div class="form-border x5-padding">
                                            @if($wishlist->investment->filled === 1 || $wishlist->investment->avail_slots == 0)
                                                <p class="lead x14-font-size maroon bolder text-center no-margin">PROPERTY SLOTS FILLED</p>
                                            @else
                                                <span class="border-right text-center" style="padding-left:25%">
                                                    <a href="{{route('offerInvest',Crypt::encrypt($wishlist->investment->id))}}" class="absolute-link x16-font-size satisfied-link">Invest <i class="icon ion-md-checkmark-circle-outline"></i> </a>
                                                </span>
                                                <span class="x2-padding text-center">
                                                    <a href="{{route('addWishList', Crypt::encrypt($wishlist->investment->id))}}" class="x16-font-size delete-link normal-link">Remove <i class="fas fa-trash"></i></a>
                                                </span>
                                            @endif
                                        </div>
                                    </figure>
                                </div>
                            @endforeach
                        @else
                        <div class="col-md-12 col-sm-12 col-lg-12 text-center x10-padding  x14-font-size x1-margin-bottom">
                                <h1 class=" grey bolder x15-padding-top x10-margin-bottom x10-margin-top x10-padding-bottom" style="transform:skew(0deg, -10deg) translateY(-115px); opacity:0.5">You do not have any wishlisted property <i class="fa fa-exclamation"></i> </h1>
                            </div>
                        @endif                       
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
    $(document).on('click', '.delete-link', function(e){
        (e).preventDefault();
        var link = $(this).attr('href');
        var reload = "{{route('wishlist')}}";
        $.ajax({
            type:'GET',
            url: link,
            datatype: 'json',
            success: function(data){
                //new page contents loaded//
                $('#target').load(reload +' #result, #header', function(){
                    //take page focus to screen top
                    var body = $("html, body");
                    body.stop().animate({scrollTop:10}, 500, 'swing', function() { 
                        //focus placed on screen top//
                    });
                    //end//
                   $('#wishlist-count-container').load(reload + ' #wishlist-count', function(e){
                        //wishlist count has been updated//
                        $('#notification-count-container').load(reload +' #notification-count', function(e){
                            //notification count updated//
                            $('#notification-notes').load(reload +' #notes', function(e){
                                //notification notes updated//
                            });
                        });
                   });
                });
            },
            error: function(data){
                alert(data.message);
            }
        });
    });
</script>
</section>
@endsection
