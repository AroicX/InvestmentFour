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
<section class=" navbar-fixed-top no-margin x10-width">
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
    <div class="container-fluid x1-margin-bottom no-margin-top x9-width x14-font-size">
        <div class="row no-margin-top">
            <div class="col-md-3 col-sm-12 col-lg-3 x2-margin-bottom x5-padding-top no-margin-top white-bg form-border text-center no-padding-left no-padding-right animated fadeIn slow">
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
                    <div class="row no-padding  form-border white-bg animated fadeIn delay-1s">
                       <div class="col-md-12 col-sm-12 col-lg-12">
                            <h1 class="grey bold text-center">Transactions</h1>
                       </div>
                    </div>
                    <div class="row x3-padding border-right border-left white-bg no-margin-bottom animated fadeIn slower delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 no-padding">
                            <form action="{{route('transactionsearch')}}" method="get" id="transaction-search">
                                <div class="form-group no-padding">
                                    <div class="container-fluid center">
                                        <div class="row no-padding no-margin ">
                                            <div class="col-md-10 col-sm-12 col-lg-10 no-padding no-margin">
                                                <input type="text" name="search" id="search" class="form-control input-lg no-radius" placeholder="ENTER PROPERTY NAME" />
                                                @if($errors->has('search'))
                                                    <p class="maroon x11-font-size animated fadeIn slower"> {{$errors->first('search')}} </p>
                                                @endif
                                            </div>
                                            <div class="col-md-1 col-sm-12 col-lg-1 no-margin no-padding">
                                                <button class="btn btn-info btn-inf btn-lg no-radius"> <i class="fas fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom no-margin-top form-border bottom-border-radius white-bg animated fadeIn slower delay-1s">
                        @if(!$details->isEmpty())
                            <?php $count = count($details->pluck('id')); $innerCount = 0;?>
                            @foreach($details as $order)
                                <?php  $innerCount += 1; ?>
                                <div class="col-md-12 col-sm-12 col-lg-12 grey no-padding animated fadeIn delay-1s">
                                    <div class="container-fluid no-margin no-padding">
                                        <div class="row no-margin x3-padding-bottom x1-padding-left x1-padding-right x2-padding-top ticket-box {{$count === $innerCount ? 'bottom-border-radius' : 'border-bottom'}}">
                                            <div class="col-md-8 col-sm-12 col-lg-8 no-margin no-padding">
                                                <figure>
                                                    <div class="container-fluid no-margin no-padding">
                                                        <div class="row no-margin no-padding">
                                                            <div class="col-md-6 col-sm-12 col-lg-6 no-margin no-padding">
                                                                <img src="/images/{{$order->investment->property_upload->property_type}}/{{$order->investment->property_upload->property_upload_image->front_image}}" alt="Property Image" title="" class="img img-responsive blurred img-thumbnail">
                                                            </div>
                                                            <div class="col-md-6 col-sm-12 col-lg-6 text-left x2-padding-top">
                                                                <h3 class="grey no-margin-left x1-margin-top no-padding bold"> {{strtoupper($order->investment->property_upload->title)}} </h3>
                                                                <h4 class="grey no-margin"> {{$order->created_at}} </h4>
                                                                <h4 class="grey ">Property Cost: &#8358;{{number_format($order->property_cost, 2)}} </h4>
                                                                <h4 class="grey ">Purchased Slot: &#8358;{{number_format($order->purchased_slot,2)}} </h4>
                                                                <h4 class="grey ">Sell-off Unit : &#8358;{{number_format(($order->investment->profit_per_slot_on_sell_off * $order->purchased_slot)+$order->property_cost, 2)}} </h4>
                                                                <div class="container-fluid no-margin no-padding">
                                                                    <div class="row  no-padding">
                                                                        <div class="colmd-4 col-sm-12 col-lg-4 property-list">
                                                                            <i class="fas fa-bed"></i> {{$order->investment->property_upload->bedroom}}
                                                                        </div>
                                                                        <div class="colmd-4 col-sm-12 col-lg-4 property-list">
                                                                            <i class="fas fa-bath"></i> {{$order->investment->property_upload->bathroom}}
                                                                        </div>
                                                                        <div class="colmd-4 col-sm-12 col-lg-4 property-list">
                                                                            <i class="fas fa-toilet"></i> {{$order->investment->property_upload->toilet}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-lg-4 x7-padding-top">
                                                <div class="text-right">
                                                    <a class="btn btn-default btn-def btn-lg no-radius" href="{{route('transaction', \Crypt::encrypt($order->id))}}">View transaction <i class="fas fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        <div class="col-md-12 col-sm-12 col-lg-12 x3-padding text-center x15-padding-top">
                            <h1 class=" grey bolder x15-padding-top x10-margin-bottom x10-margin-top x10-padding-bottom" style="transform:skew(0deg, -10deg) translateY(-115px); opacity:0.5">No transaction to display <i class="fa fa-exclamation"></i> </h1>
                        </div>
                        @endif
                    </div>
                    <!--END: result row-->
                    <div class="row no-padding no-margin text-right">
                        
                    </div>
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