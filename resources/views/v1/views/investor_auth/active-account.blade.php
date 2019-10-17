@extends('v1.master.public')

@section('title', 'login')

@if(session('status') || session('error'))
<!--START: navbar-->
<section class="navbar-fixed-top no-margin no-padding x10-width">
    <div class="container-fluid no-padding no-margin ">
        <div class="row no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding">
                @include('v1.components.navigations.homenavbar')
            </div>
        </div>
    </div>
</section>
<!--END: navbar-->

@section('form')
<section class="no-margin-right no-margin-left x2-margin-bottom margin-top-header">
    <div class="container-fluid no-margin text-left x5-padding-top x2-padding-bottom">
        <div class="row x1-padding no-margin form-border mini-width center x3-radius white-bg">
            <div class="col-md-12 col-sm-12 col-lg-12 no-padding">
                <div class="x5-padding text-center border-bottom x10-width">
                    <i class="fas fa-{{session('status') ? 'check-circle light-blue' : 'times maroon'}} large-icon 3dicon animated fadeIn slower delay-1s"></i>
                </div>  
                <div class="no-margin-left no-margin-right x3-margin-top x2-padding">
                    <p class="lead grey x14-font-size x4-padding-top">{{session('status') ? session('status') : session(error)}}</p>
                </div>           
            </div>
        </div>
        <div class="row x1-padding no-margin form-border mini-width x2-radius center white-bg animated fadeIn slow x14-font-size">
            You can now <a href=" {{route('login')}} " class="normal-link light-blue">Login</a>
        </div>
    </div>
</section>
@endsection
@endif
