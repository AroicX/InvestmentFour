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
                            <h1 class="text-center grey bold">Active Investment</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg bottom-border-radius border-left border-right border-bottom text-center x2-margin-bottom animated fadeIn delay-2s no-padding x12-font-size">
                            <div class="container-fluid">
                                <div class="row">
                                @if(!$orders->isEmpty())
                                    @foreach($orders as $order)
                                    
                                    <!--START: property details div-->
                                    <div class="col-md-8 col-sm-12 col-lg-8 x3-padding x3-margin-left text-left">
                                        <figure>
                                            <img src="/images/{{$order->investment->property_upload->property_type}}/{{$order->investment->property_upload->property_upload_image->front_image}}" alt="property-view" title="property-view" id="main" class="img img-responsive x4-radius x10-width property-image">
                                        </figure>
                                        <h3 class="header-bg x2-padding x1-margin-top bold x4-radius text-center">{{strtoupper($order->investment->property_upload->title)}}</h3>
                                        <p class="x3-margin-top x1-margin-left text-left ">
                                            <span class="grey x16-font-size bold property-list" title="Bedroom" alt="Bedroom"> <span class="property-icon"><i class="fas fa-bed"></i> Bedroom: {{$order->investment->property_upload->bedroom}}</span> </span>
                                            <span class="grey x6-margin-left x16-font-size bold property-list" title="Bathroom" alt="Bathroom"> <span class="property-icon"><i class="fas fa-bath"></i> Bathroom: {{$order->investment->property_upload->bathroom}}</span></span>
                                            <span class="grey x6-margin-left x16-font-size bold property-list" title="Toilet" alt="Toilet"> <span class="property-icon"><i class="fas fa-toilet"></i> Toilet: {{$order->investment->property_upload->toilet}}</span> </span>
                                        </p>
                                        <!--START: property information table-->
                                        <table class="table table-responsive table-stripped table-hover x2-margin-top grey x14-font-size">
                                            <tr>
                                                <td>Slot</td>
                                                <td class="text-right"> {{$order->purchased_slot}} </td>
                                            </tr>
                                            <tr>
                                                <?php $year = ($order->investment->investment_duration > 1 ? 'years' : 'year') ?>
                                                <td>Rental unit ({{$order->investment->investment_duration}} {{$year}})</td>
                                                <td class="text-right"> &#8358;{{number_format($order->investment->investment_duration * $order->investment->profit_per_slot_on_rent, 2)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Sell-off unit ({{$order->investment->investment_duration}} {{$year}})</td>
                                                <td class="text-right"> &#8358;{{number_format($order->investment->investment_duration * $order->investment->profit_per_slot_on_sell_off, 2)}} </td>
                                            </tr>
                                            <tr>
                                                <td>Property cost</td>
                                                <td class="text-right">&#8358; {{number_format($order->property_cost, 2)}}</td>
                                            </tr>
                                        </table><!--END: property information table-->
                                        <div class="text-right">
                                            {{$orders->links()}}
                                        </div>
                                        @endforeach
                                        <h3 class="header-bg x2-padding x5-margin-top x4-radius text-center bold white"> Transactions</h3>
                                        <!--START: transaction information table-->
                                        <table class="table table-responsive table-stripped table-hover grey x14-font-size">
                                            @if(!$transactions->isEmpty())
                                                @foreach($transactions as $transaction)
                                                <tr>
                                                    <td>&#8358;{{number_format($transaction->amount, 2)}} </td>
                                                    <td class="text-center"> {{$transaction->created_at}} </td>
                                                    <td class="text-center"> {{ucfirst($transaction->type)}} </td>
                                                </tr>
                                                @endforeach
                                        </table><!--END: transaction information table-->
                                        <div class="text-right">
                                            <a href="{{route('transaction', \Crypt::encrypt($transaction->order_id))}}" class="btn btn-info btn-inf btn-lg no-radius">More transactions <i class="fas fa-chevron-right"></i></a>
                                        </div>
                                        @endif
                                    </div><!--END: property details div-->
                                    <!--START: sub property photos div-->
                                    <div class="col-md-3 col-sm-12 col-lg-3 x3-padding-top">
                                        <figure class="x10-margin-bottom">
                                            <a href="#">
                                                <img src="/images/{{$order->investment->property_upload->property_type}}/{{$order->investment->property_upload->property_upload_image->front_image}}" alt="front view" title="front view" id="front" class="img-responsive img-thumbnail property-image zoom">
                                            </a>    
                                        </figure>
                                        <figure class="x10-margin-bottom">
                                            <a href="#">
                                                <img src="/images/{{$order->investment->property_upload->property_type}}/{{$order->investment->property_upload->property_upload_image->side_image}}" alt="side view" title="side view" id="side" class="img-responsive img-thumbnail property-image zoom">
                                            </a>
                                        </figure>
                                        <figure class="x10-margin-bottom">
                                            <a href="#">
                                                <img src="/images/{{$order->investment->property_upload->property_type}}/{{$order->investment->property_upload->property_upload_image->back_image}}" alt="back view" title="back view" id="back" class="img-responsive img-thumbnail property-image zoom">
                                            </a>
                                        </figure>
                                        <h3 class="x2-padding x3-radius bold header-bg">STATUS</h3>
                                        <p class="lead {{App\Http\COntrollers\GlobalMethods::getInvestmentStatusColor($order->investment->running)}} text-center">
                                            {!! App\Http\COntrollers\GlobalMethods::getInvestmentStatus($order->investment->running) !!}
                                        </p>
                                    </div>
                                    <!--sub property photos div-->
                                    @else
                                        <div class="col-md-12 col-sm-12 col-lg-12 x3-padding text-center x15-padding-top">
                                            <h1 class=" grey bolder x15-padding-top x10-margin-bottom x10-margin-top x10-padding-bottom" style="transform:skew(0deg, -10deg) translateY(-115px); opacity:0.5">No investment yet <i class="fa fa-exclamation"></i> </h1>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!--END: result row-->
                </div><!--END: nav result container-->
            </div><!--END: main content column-->
        </div><!--END: overall row-->
    </div><!--END: overall container-->
</section>
@endsection