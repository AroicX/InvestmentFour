@extends('v1.master.investor')

@section('title', 'potfolio')

@if(session('status'))
<div class="modal show x5-margin-top x10-margin-left animated bounceInDown slower delay-1s" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content no-radius">
            <div class="modal-header navbar-bg">
                <button class="close transparent no-radius" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');"> <i class="fas fa-times"></i> </button>
                <h4 class="header white bold no-margin x14-font-size"> <i class="fas fa-info-circle"></i> <span id="report-title">Update Report</span></h4>
            </div>
            <div class="modal-body grey-bg-light">
                <p class="lead transparent x14-font-size">
                    <span id="report grey">{{session('status')}}</span>
                    <i class="fas fa-check-circle icon x20-font-size light-blue animated fadeIn slower delay-3s"></i>
                </p>
            </div>
            <div class="modal-footer grey-bg-light">
                <a data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');" class="btn btn-danger btn-lg no-radius btn-dan" > Close <i class="fas fa-times"></i> </a>
            </div>
        </div>
    </div>
</div>
@endif

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
                    <!--START: heading row-->
                    <div class="row no-padding  animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border x2-radius">
                            <h1 class="text-center grey bold">All Investments</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!-- START: search form div -->
                    <div class="row white-bg border-right border-left x2-padding-top animated fadeIn delay-1s">
                        <div class="col-md-11 col-sm-12 col-lg-11">
                            <div class="form-group center">
                                <div class="container-fluid center">
                                    <div class="row">
                                    <form action="{{route('investmentsearch')}}" method="" id="property-search">
                                        <div class="col-md-10 col-sm-12 col-lg-10 no-padding">
                                                <input type="text" name="search" id="search" class="form-control input-lg no-radius" placeholder="ENTER PROPERTY NAME">
                                                @if($errors->has('search'))
                                                    <p class="maroon x11-font-size animated fadeIn slower"> {{$errors->first('search')}} </p>
                                                @endif
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-lg-2 no-padding">
                                                <button type="submit" class="btn btn-info btn-lg no-radius"> <i class="fas fa-search"></i> Search </button>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END -->
                    <!--START: result row-->
                    <div class="row x1-padding x1-margin-bottom form-border white-bg bottom-border-radius animated fadeIn delay-1s">
                        @if(!$orders->isEmpty())
                            @foreach($orders as $order)
                                <div class="col-md-6 col-sm-12 col-lg-6 no-margin x2-padding-top no-padding-left x1-padding-right  no-padding-bottom ">
                                    <figure class="x5-radius white-bg no-padding form-border ">
                                        <img src="/images/1.jpg" alt="" class="img-responsive img-thumbnail blurred all-prop-image">
                                        <h3 class="x2-padding no-margin-top white-bg text-center grey x1-border-bottom header-bg bold"> {{strtoupper($order->investment->property_upload->title)}} </h3>
                                        <div class="container-fluid no-margin">
                                            <div class="row no-margin-left no-margin-right x4-margin-bottom no-padding">
                                                <div class="col-md-5 col-sm-12 col-lg-5 no-padding no-margin text-left">
                                                    <h4 class="grey no-padding no-margin bold">Property Cost:</h4>
                                                </div>
                                                <div class="col-md-7 col-sm-12 col-lg-7 no-padding no-margin">
                                                    <h4 class="grey no-padding no-margin"> &#8358;{{number_format($order->property_cost, 2)}} </h4>
                                                </div>
                                            </div>
                                            <div class="row no-margin no-padding x4-margin-bottom">
                                                <div class="col-md-5 col-sm-12 col-lg-5 no-padding no-margin text-left">
                                                    <h4 class="grey no-padding no-margin bold">Purchased Slot:</h4>
                                                </div>
                                                <div class="col-md-7 col-sm-12 col-lg-7 no-padding no-margin">
                                                    <h4 class="grey no-padding no-margin"> {{$order->purchased_slot}} </h4>
                                                </div>
                                            </div>
                                            <div class="row no-margin-left no-margin-right x4-margin-bottom no-padding">
                                                <div class="col-md-5 col-sm-12 col-lg-5 no-padding no-margin text-left">
                                                    <h4 class="grey no-padding no-margin bold">Sell-off Unit:</h4>
                                                </div>
                                                <div class="col-md-7 col-sm-12 col-lg-7 no-padding no-margin">
                                                    <h4 class="grey no-padding no-margin"> &#8358;{{number_format(($order->investment->profit_per_slot_on_sell_off * $order->purchased_slot) + $order->property_cost, 2)}} </h4>
                                                </div>
                                            </div>
                                            <div class="row no-margin-left no-margin-right x4-margin-bottom no-padding">
                                                <div class="col-md-5 col-sm-12 col-lg-5 no-padding no-margin text-left">
                                                    <h4 class="grey no-padding no-margin bold">Status:</h4>
                                                </div>
                                                <div class="col-md-7 col-sm-12 col-lg-7 no-padding no-margin">
                                                    <p class="lead {{App\Http\COntrollers\GlobalMethods::getInvestmentStatusColor($order->investment->running)}} text-text">
                                                        {!! App\Http\COntrollers\GlobalMethods::getInvestmentStatus($order->investment->running) !!}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row no-margin-left no-margin-right x2-margin-top no-padding">
                                                <div class="col-md-4 col-sm-12 col-lg-4 no-padding no-margin text-left property-list">
                                                    <span class="property-icon"><i class="fas fa-bed"></i> Bedroom: {{$order->investment->property_upload->bedroom}} </span>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-lg-4 no-padding no-margin text-left property-list">
                                                    <span class="property-icon"><i class="fas fa-bath"></i> Bathroom: {{$order->investment->property_upload->bathroom}}</span>
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-lg-4 no-padding no-margin text-left property-list">
                                                    <span class="property-icon"><i class="fas fa-toilet"></i> Toilet: {{$order->investment->property_upload->toilet}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="x3-margin-top x4-margin-left text-left nano-icon">

                                            

                                        </span>
                                        <div class="no-margin-left no-margin-right x3-margin-top no-padding header-bg bottom-border-radius">
                                            <p class="no-margin x5-padding x12-font-size text-center">
                                                <a href="{{route('transaction', \Crypt::encrypt($order->id))}}" class="footer-nav x14-font-size">Open <i class="fas fa-folder-open"></i></a>
                                            </p>
                                        </div>
                                    </figure>    
                                </div>
                            @endforeach
                            </div>
                            <div class="no-margin-left no-margin-right text-right no-padding">
                                {{$orders->links()}}
                            </div>
                        @else
                        <div class="col-md-12 col-sm-12 col-lg-12 x3-padding text-center x15-padding-top">
                            <h1 class=" grey bolder x15-padding-top x10-margin-bottom x10-margin-top x10-padding-bottom" style="transform:skew(0deg, -10deg) translateY(-115px); opacity:0.5">No investment yet <i class="fa fa-exclamation"></i> </h1>
                        </div>
                        @endif
                    </div><!--END: result row-->
                </div><!--END: nav result container-->
            </div><!--END: main content column-->
        </div><!--END: overall row-->
    </div><!--END: overall container-->
</section>
@endsection