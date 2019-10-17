@extends('v1.master.investor')

@section('title', 'notifications')

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
        <div class="col-md-8 col-sm-12 col-lg-8 margin-left-content x2-margin-bottom no-padding">
                <!--START: nav result container-->
                <div class="container-fluid">
                    <!--START: heading row-->
                    <div class="row no-padding  animated fadeIn delay-1s x1-margin-bottom">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border">
                            <h1 class="text-center grey bold">Notifications</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!--START: result row-->
                    @foreach($notifications as $notification)
                    <div class="row no-padding animated fadeIn delay-2s active-notification">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border text-left x3-padding no-margin-bottom no-margin-top">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-1 col-sm-12 col-lg-1">
                                        <i class="fas fa-bell maroon"></i>
                                    </div>
                                    <div class="col-md-11 col-sm-12 col-lg-11">
                                        <p class="grey">{{ str_replace('<br/>', '',$notification->data) }}</p>
                                        <p class="light-blue bold">{!! $notification->created_at !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
@endsection