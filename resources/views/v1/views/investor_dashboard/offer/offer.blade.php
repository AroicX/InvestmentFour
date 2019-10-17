@extends('v1.master.investor')

@section('title', 'potfolio')

@section('nav')
<section class="navbar-fixed-top no-margin x10-width">
    <div class="container-fluid no-margin no-padding">
        <div class="row no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding ">
                @include('v1.components.navigations.investorNav.genNav')
            </div>
        </div>
    </div>
</section>
@endsection

@if(session('status'))
    <div class="modal show animated slideInDown slower delay-2s x5-margin-top x10-margin-left no-radius" id="myModal">
        <div class="modal-dialog no-radius">
            <div class="modal-content no-radius">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');">&times;</button>
                    <h4 class="green bold no-margin x14-font-size text-left"> <i class="fas fa-info-circle"></i> Search Result </h4>
                </div>
                <div class="modal-body">
                    <p class="grey x14-font-size text-left">{{session('status')}}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-den btn-lg white no-radius" data-dismiss="modal" onclick = "$('.modal').addClass('animated fadeOut slower').removeClass('show');"> Close  &times; </button>
                </div>
            </div>
        </div>
    </div>
@endif

@section('content')
<section>
    <div class="container-fluid flex x1-margin-bottom x9-width x14-font-size">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-lg-3 x2-margin-bottom x5-padding-top white-bg form-border text-center no-padding-left no-padding-right animated fadeIn slow">
                <div class="x5-padding-bottom x0-margin-left x0-margin-right border-bottom ">
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
                    <!--START: result row-->
                    <div class="row no-padding  form-border white-bg animated fadeIn delay-1s">
                       <div class="col-md-12 col-sm-12 col-lg-12">
                            <h1 class="grey bold text-center">Offers</h1>
                       </div>
                    </div>
                    <div class="row x1-padding animated fadeIn delay-1s white-bg border-right border-left ">
                        <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding-left">
                            <form method="get" action=" {{route('offerSearch')}} ">
                            @csrf() <!--CSRF Protection-->
                                <div class="row no-margin x1-padding">
                                    <div class="col-md-3 col-sm-12 col-lg-3 no-margin-left no-padding-left">
                                        <div class="form-group">
                                            <label for="result" class="grey x6-bold">
                                                Region
                                            </label>
                                            <select name="region" id="region" class="form-control no-radius input-lg">
                                                <option value="*" selected>All</option>
                                               @if($region)
                                                @foreach($region as $region)
                                                    <option value="{{e($region->region)}}">{{e(ucfirst($region->region))}}</option>
                                                @endforeach
                                               @endif
                                            </select>
                                            @if($errors->has('region'))
                                                <span class="maroon x10-font-size">{{$errors->first('region')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-lg-3">
                                        <div class="form-group">
                                            <label for="type" class="grey x6-bold" style="display:block">
                                                Property Type
                                            </label>
                                            <select name="type" id="type" class="form-control no-radius input-lg">
                                                <option value="*" selected>All</option>
                                                @if($property_type)
                                                   @foreach($property_type as $property_type)
                                                    <option value="{{e($property_type->type)}}">{{e(ucfirst($property_type->type))}}</option>
                                                   @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('type'))
                                                <span class="x10-font-size maroon">{{ $errors->first('type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-lg-3">
                                        <div class="form-group">
                                            <label for="price" class="grey x6-bold">
                                                Price Range
                                            </label>
                                            <!--The below select will be converted to dropdown link-->
                                            <select name="price" id="price" class="form-control no-radius input-lg">
                                                <option value="*">All</option>
                                                @if($price_range)
                                                    @foreach($price_range as $price_range)
                                                        <option value="{{$price_range->price}}">&#8358;{{number_format($price_range->price, 2)}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-lg-3">
                                        <div class="form-group x10-margin-top x4-padding-left">
                                            <button type="submit" id="submit" class="btn btn-info btn-inf btn-lg x5-margin-top no-radius">
                                                <span id="submit-text">Get offers</span> 
                                                <i class="fas fa-box-open"></i>
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row x1-padding white-bg form-border bottom-border-radius animated fadeIn delay-1s x14-font-size" id="target">
                       <div class="container-fluid no-padding"  id="result" data-next-page=" {{$properties->nextPageUrl()}} ">
                            <div class="row no-padding" id="new-result">
                                @if($properties)
                                    @foreach($properties as $property)
                                        <div class="col-md-6 col-sm-12 col-lg-6 x2-padding-top no-padding-bottom no-margin">
                                            <figure class="form-border x5-radius white-bg no-margin">
                                                <img src="/images/{{$property->property_type}}/{{$property->property_upload_image->front_image}}" alt="property_img" class="img-responsive image x10-width x1-padding">
                                                <figcaption style="position: absolute; top:15px" class="{{e($property->investment->avail_slots == 0 ? 'maroon-bg' : 'available-bg')}} x3-padding white bold x1-margin-left x5-radius x16-font-size">{{e($property->investment->avail_slots == 0 ? 'Unavailable' : 'Available')}}</figcaption>
                                                <h4 class="header-bg text-center x9-bold  x5-padding no-margin x14-font-size">{{strtoupper($property->title)}}</h4>
                                                <!--START: property information table-->
                                                <table class="table table-responsive table-stripped grey x14-font-size no-margin">
                                                    <tr>
                                                        <td>Property Region</td>
                                                        <td class="text-right">{{e(ucfirst($property->property_region))}}</td>
                                                    </tr>
                                                    <tr class="active">
                                                        <td>Property Type</td>
                                                        <td class="text-right">{{e(ucfirst($property->property_type))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Available Slot(s)</td>
                                                        <td class="text-right">{{e($property->investment->avail_slots)}}</td>
                                                    </tr>
                                                    <tr class="active">
                                                        <td>Rentage</td>
                                                        <td class="text-right">{{($property->rentage == 0 ? 'No' : 'Yes')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sell-off Profit</td>
                                                        <td class="text-right">&#8358;{{e(number_format($property->investment->profit_per_slot_on_sell_off, 2))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Property Cost</td>
                                                        <td class="text-right"> &#8358;{{e(number_format(doubleval($property->cost), 2))}}</td>
                                                    </tr>
                                                </table><!--END: property information table-->
                                                <div class="border-left border-right border-bottom x5-padding bottom-border-radius header-bg">
                                                @if($property->investment->filled === 1 || $property->investment->avail_slots == 0)
                                                    <p class="lead x14-font-size maroon bolder text-center no-margin">PROPERTY SLOTS FILLED</p>
                                                @else
                                                    <span class="border-right text-center" style="padding-left:25%">
                                                        <a href="{{route('offerInvest',Crypt::encrypt($property->investment->id))}}" class="x16-font-size footer-nav">Invest <i class="icon ion-md-checkmark-circle-outline"></i> </a>
                                                    </span>
                                                    <span class="x2-padding text-center">
                                                        <a href="{{route('addWishList', Crypt::encrypt($property->investment->id))}}" class="wishlisting {{App\Http\Controllers\GlobalMethods::checkWishlist(Crypt::encrypt($property->investment->id)) ? 'footer-continue' : 'footer-nav'}} x16-font-size">Wishlist <i class="icon {{App\Http\Controllers\GlobalMethods::checkWishlist(Crypt::encrypt($property->investment->id)) ? 'fas fa-heart' : 'ion-md-add-circle-outline'}}"></i></a>
                                                    </span>
                                                @endif
                                                </div>
                                            </figure>
                                        </div>
                                    @endforeach
                                @endif
                                <div class='appended-data x2-padding-left x2-padding-right no-padding-bottom x3-margin-bottom'></div>
                            </div>
                       </div>
                       <div class="row x1-margin-top animated fadeIn delay-2s text-right x2-padding-right"><!--START: load more div-->
                        <div class="col-md-12 col-sm-12 col-lg-12 no-padding" id="paginated-links">
                            {{$properties->appends(Request::except('page'))->links()}}
                        </div>
                    </div><!--END: Load more div-->
                    </div><!--END: result row-->
                </div><!--END: nav result container-->
            </div><!--END: main content column-->
        </div><!--END: overall row-->
        <script type="text/javascript">
            
            //code snippet is for wishlisting item
            $(document).on('click', '.wishlisting', function(e){
                e.preventDefault();
                
                var page = $(this).attr('href');
                var reload = "{{route('offer')}}";
                var link = $(this);
                $.ajax({
                    url: page,
                    type:"GET",
                    datatype: "json",
                    success: function(data){
                        if(!data.remove){
                             // link.removeClass('footer-nav').addClass('footer-continue');
                             link.find('.icon').removeClass('ion-md-add-circle-outline animated fadeIn slow').addClass('fas fa-heart animated heartBeat slow');
                            $('#wishlist-count-container').load(reload + ' #wishlist-count', function(e){
                                //wishlist count has been updated//
                                $('#notification-count-container').load(reload +' #notification-count', function(e){
                                    //notification count updated//
                                    $('#notification-notes').load(reload +' #notes', function(e){
                                        //notification notes updated//
                                       
                                    });
                                });
                            });
                        }else{
                             link.removeClass('footer-continue').addClass('footer-nav');
                             link.find('.icon').removeClass('fas fa-heart animated heartBeat slow').addClass('ion-md-add-circle-outline');
                            $('#wishlist-count-container').load(reload + ' #wishlist-count', function(e){
                                //wishlist count has been updated//
                                $('#notification-count-container').load(reload +' #notification-count', function(e){
                                    //notification count updated//
                                    $('#notification-notes').load(reload +' #notes', function(e){
                                        //notification notes updated//
                                    });
                                });
                            });
                        }
                    },
                    error: function(data){
                        alert('data.error');
                    },

                });
            });
            //end//

            //code snippet is for ajax enabled pagination
            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                
                var page = $(this).attr('href');
                getOffersPage(page);
                
                function getOffersPage(page){
                    if(page === page){
                        var resultSection = $('#new-result');
                        $('#target').load(page + ' #result, #paginated-links', function(){
                            $('#paginated-links').addClass('text-right x1-margin-top');
                            //take page focus to screen top
                            var body = $("html, body");
                            body.stop().animate({scrollTop:10}, 500, 'swing', function() { 
                                //focus placed on screen top//
                            });
                            //end//
                        });
                    }
                }
            });
            //end//
        </script>
    </div><!--END: overall container-->
</section>
@endsection