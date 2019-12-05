@extends('v1.master.investor')

@section('title', 'Market Place')

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
                <button class="close" data-dismiss="modal"
                    onclick="$('.modal').removeClass('show').addClass('fade');">&times;</button>
                <h4 class="green bold no-margin x14-font-size text-left"> <i class="fas fa-info-circle"></i> Search
                    Result </h4>
            </div>
            <div class="modal-body">
                <p class="grey x14-font-size text-left">{{session('status')}}</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-den btn-lg white no-radius" data-dismiss="modal"
                    onclick="$('.modal').addClass('animated fadeOut slower').removeClass('show');"> Close &times;
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@section('content')
<section>
    <div class="container-fluid flex x1-margin-bottom x9-width x14-font-size">
        <div class="row">

            <!--START: main content column-->
            <div class="col-md-12 col-sm-12 col-lg-12 margin-left-content x2-margin-bottom no-padding">
                <!--START: nav result container-->
                <div class="container-fluid">
                    <!--START: result row-->
                    <div class="row no-padding  form-border white-bg animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <h1 class="grey bold text-center">Market Place</h1>
                        </div>
                    </div>

                    <div class="row x1-padding white-bg form-border bottom-border-radius animated fadeIn delay-1s x14-font-size"
                        id="target">
                        <div class="container-fluid no-padding" id="result"
                            data-next-page=" {{$houses->nextPageUrl()}} ">
                            <div class="row no-padding" id="new-result">
                                @if($houses)
                                    @foreach($houses as $property)
                                       
                                            <div class="col-md-6 col-sm-12 col-lg-4 x2-padding-top no-padding-bottom no-margin">
                                                <figure class="form-border x5-radius white-bg no-margin">
        
                                                    {{-- {{$property->investment->property_upload->property_upload_image}} --}}
                                                    <img src="/images/{{$property->investment->property_upload->property_type}}/{{$property->investment->property_upload->property_upload_image->front_image}}"
                                                        alt="property_img" class="img-responsive image x10-width x1-padding">
                                                    <figcaption style="position: absolute; top:15px"
                                                        class="{{e($property->investment->avail_slots == 0 ? 'maroon-bg' : 'available-bg')}} x3-padding white bold x1-margin-left x5-radius x16-font-size">
                                                        {{e($property->investment->avail_slots == 0 ? 'Unavailable' : 'Available')}}
                                                    </figcaption>
                                                    <h4 class="header-bg text-center x9-bold  x5-padding no-margin x14-font-size">
                                                        {{strtoupper($property->investment->property_upload->title)}}</h4>
                                                    <!--START: property information table-->
                                                    <table
                                                        class="table table-responsive table-stripped grey x14-font-size no-margin">
                                                        <tr>
                                                            <td>Property Region</td>
                                                            <td class="text-right">
                                                                {{e(ucfirst($property->investment->property_upload->property_region))}}
                                                            </td>
                                                        </tr>
                                                        <tr class="active">
                                                            <td>Property Type</td>
                                                            <td class="text-right">
                                                                {{e(ucfirst($property->investment->property_upload->property_type))}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Available Slot(s)</td>
                                                            <td class="text-right">
                                                                {{e($property->investment->property_upload->investment->avail_slots)}}
                                                            </td>
                                                        </tr>
                                                        <tr class="active">
                                                            <td>Rentage</td>
                                                            <td class="text-right">
                                                                {{($property->investment->property_upload->rentage == 0 ? 'No' : 'Yes')}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Slots</td>
                                                            <td class="text-right">{{$property->slots}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Property Cost</td>
                                                            <td class="text-right">
                                                                &#8358;{{e(number_format(doubleval($property->price), 2))}}</td>
                                                        </tr>
                                                    </table>
                                                    <!--END: property information table-->
                                                    <div
                                                        class="border-left border-right border-bottom x5-padding bottom-border-radius header-bg">
                                                        @if($property->investment->filled === 1 ||
                                                        $property->investment->avail_slots == 0)
                                                        <p class="lead x14-font-size maroon bolder text-center no-margin">PROPERTY
                                                            SLOTS FILLED</p>
                                                        @else
        
                                                        {{-- <form action="{{ route('buy-property') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="property" value="{{$property->id}}">
        
                                                        <button class="btn btn-success">Buy Now <i
                                                                class="icon ion-md-checkmark-circle-outline"></i> </button>
                                                        </form> --}}
                                                        @if(Auth::user()->investor_id != $property->investor_id)
                                                            <form>
                                                                <script src="https://js.paystack.co/v1/inline.js"></script>
                                                                <button class="btn btn-success" type="button"
                                                                    onclick="payWithPaystack()"> Buy </button>
                                                            </form>
                                                        @else 
                                                        <form>
                                                            
                                                            <button class="btn btn-success disabled" type="button"
                                                               > Cannot purchase property posted by you </button>
                                                        </form>
                                                    
                                                        @endif
        
                                                        
        
                                                        <script>
                                                            const investor = '{{ Auth::User()->investor_id }}';
                                                            const slot = '{{ $property->slots }}';
                                                            const property = '{{ $property->id }}';
                                                            const price = '{{ $property->price }}';
        
                                                            function payWithPaystack() {
                                                                var handler = PaystackPop.setup({
                                                                    key: 'pk_test_5d5fb23f7643ea0c027b0754c6b8e5861b71c5f4',
                                                                    email: '{{ Auth::User()->email }}',
                                                                    amount: '{{$property->price}}' * 100,
                                                                    currency: "NGN",
                                                                    ref: '' + Math.floor((Math.random() * 1000000000) +
                                                                        1
                                                                    ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                                                                    metadata: {
                                                                        custom_fields: [{
                                                                            display_name: "Mobile Number",
                                                                            variable_name: "mobile_number",
                                                                            value: "+2348012345678"
                                                                        }]
                                                                    },
                                                                    callback: function (response) {
        
                                                                        
                                                                        addToTransaction(investor, slot, price,
                                                                            property);
                                                                    },
                                                                    onClose: function () {
                                                                        // alert('window closed');
                                                                    }
                                                                });
                                                                handler.openIframe();
                                                            }
        
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                                                                }
                                                            });
        
                                                            function addToTransaction(investor, slot, price, property) {
        
                                                                const data = {
                                                                    investor,
                                                                    slot,
                                                                    price,
                                                                    property
                                                                };
                                                                
                                                                $.ajax({
                                                                    url: "/investor/dashboard/marketplace-buy",
                                                                    headers: {
                                                                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                                                                    },
                                                                    type: "POST",
                                                                    data: data,
                                                                  
                                                                    success: function (data) {
                                                                        console.log(data);
                                                                    },
                                                                    error: function (jqXHR, textStatus, errorThrown) {
                                                                        alert('Error Retrieving Data!');
                                                                    }
                                                                });
        
        
                                                            }
        
                                                        </script>
        
                                                        {{-- <a href="{{route('offerInvest',Crypt::encrypt($proper÷ty->investment->id))}}"
                                                        class="x16-font-size footer-nav">Buy Now <i
                                                            class="icon ion-md-checkmark-circle-outline"></i> </a> --}}
        
        
                                                        @endif
                                                    </div>
                                                </figure>
                                            </div>
                                      
                                    @endforeach

                                @else
                                    
                                <div class="alert alert-primary" role="alert">
                                  No Property Up for sale
                                </div>

                                @endif
                                <div
                                    class='appended-data x2-padding-left x2-padding-right no-padding-bottom x3-margin-bottom'>
                                </div>
                            </div>
                        </div>
                        <div class="row x1-margin-top animated fadeIn delay-2s text-right x2-padding-right">
                            <!--START: load more div-->
                            <div class="col-md-12 col-sm-12 col-lg-12 no-padding" id="paginated-links">
                                {{-- {{$properties->appends(Request::except('page'))->links()}} --}}
                            </div>
                        </div>
                        <!--END: Load more div-->
                    </div>
                    <!--END: result row-->
                </div>
                <!--END: nav result container-->
            </div>
            <!--END: main content column-->
        </div>
        <!--END: overall row-->
        <script type="text/javascript">
            //code snippet is for wishlisting item
            $(document).on('click', '.wishlisting', function (e) {
                e.preventDefault();

                var page = $(this).attr('href');
                var reload = "{{route('offer')}}";
                var link = $(this);
                $.ajax({
                    url: page,
                    type: "GET",
                    datatype: "json",
                    success: function (data) {
                        if (!data.remove) {
                            // link.removeClass('footer-nav').addClass('footer-continue');
                            link.find('.icon').removeClass(
                                'ion-md-add-circle-outline animated fadeIn slow').addClass(
                                'fas fa-heart animated heartBeat slow');
                            $('#wishlist-count-container').load(reload + ' #wishlist-count',
                                function (e) {
                                    //wishlist count has been updated//
                                    $('#notification-count-container').load(reload +
                                        ' #notification-count',
                                        function (e) {
                                            //notification count updated//
                                            $('#notification-notes').load(reload +
                                                ' #notes',
                                                function (e) {
                                                    //notification notes updated//

                                                });
                                        });
                                });
                        } else {
                            link.removeClass('footer-continue').addClass('footer-nav');
                            link.find('.icon').removeClass('fas fa-heart animated heartBeat slow')
                                .addClass('ion-md-add-circle-outline');
                            $('#wishlist-count-container').load(reload + ' #wishlist-count',
                                function (e) {
                                    //wishlist count has been updated//
                                    $('#notification-count-container').load(reload +
                                        ' #notification-count',
                                        function (e) {
                                            //notification count updated//
                                            $('#notification-notes').load(reload +
                                                ' #notes',
                                                function (e) {
                                                    //notification notes updated//
                                                });
                                        });
                                });
                        }
                    },
                    error: function (data) {
                        alert('data.error');
                    },

                });
            });
            //end//

            //code snippet is for ajax enabled pagination
            $(document).on('click', '.pagination a', function (e) {
                e.preventDefault();

                var page = $(this).attr('href');
                getOffersPage(page);

                function getOffersPage(page) {
                    if (page === page) {
                        var resultSection = $('#new-result');
                        $('#target').load(page + ' #result, #paginated-links', function () {
                            $('#paginated-links').addClass('text-right x1-margin-top');
                            //take page focus to screen top
                            var body = $("html, body");
                            body.stop().animate({
                                scrollTop: 10
                            }, 500, 'swing', function () {
                                //focus placed on screen top//
                            });
                            //end//
                        });
                    }
                }
            });
            //end//

        </script>
    </div>
    <!--END: overall container-->
</section>
@endsection
