@extends('v1.master.public')

@section('title', 'offers')

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

<!--START: offers and aside-->
@section('offers')
<section>
    <div class="container-fluid x5-margin-top">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-lg-4">
               hello
            </div>
            <div class="col-md-8 col-sm-12 col-lg-8">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-lg-5 x2-margin-right">
                        <figure class=" x1-padding-left x1-padding-right x5-radius offers-div">
                    <figcaption class="grey x6-bold x2-margin-bottom" style="border-bottom:2px solid rgba(0,0,0,0.3)">Property Type</figcaption>
                    <img src="/images/1.jpg" class="img img-responsive img-thumbnail x350-img-height"/>
                    <p class="x1-margin-top x5-margin-bottom text-left grey x5-padding">Property Details</p>
                    <p class="x5-padding-bottom"><a href="#" class="btn btn-default">Invest <i class="fa fa-check-circle light-blue"></i></a>  <a href="#" class="btn btn-default">More Details...</a></p>
                </figure>
                        </div>
                        <div class="col-md-5 col-sm-12 col-lg-5">
                        <figure class=" x1-padding-left x1-padding-right x5-radius">
                    <figcaption class="grey x6-bold x2-margin-bottom">Property Type</figcaption>
                    <img src="/images/4.jpg" class="img img-responsive img-thumbnail x350-img-height"/>
                    <p class="x1-margin-top x5-margin-bottom text-left grey x5-padding">Property Details</p>
                    <p class="x5-padding-bottom"><a href="#" class="btn btn-default">Invest <i class="fa fa-check-circle light-blue"></i></a>  <a href="#" class="btn btn-default">More Details...</a></p>
                </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!--END: offers and aside-->