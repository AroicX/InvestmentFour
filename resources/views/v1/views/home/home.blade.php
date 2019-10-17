@extends('v1.master.public')

@section('title', 'Company Name')

<!--START:landing page-->
@include('v1.components.navigations.homepagenav')
<section class="skewed no-margin x3-padding-top shadow-grey-opacity">
    <div class="container-fluid x2-margin-top">
        <div class="row no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-lg-12 menu white x10-margin-top">
                <h1 class="bolder x5-padding-left x5-padding-top animated bounceInUp slower x50-font-size no-margin overline-underline-text" style="font-family: 'Open Sans', sans-serif;">WELCOME TO SITE NAME</h1>
                <p class="no-margin x18-font-size x7-width x5-padding-left x1-margin-top animated fadeIn slower delay-3s" style="line-height:2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio iure mollitia et similique sapiente possimus soluta quo facere assumenda at temporibus repellat voluptate, eos necessitatibus iste nobis. Fuga, deleniti eum.</p>
                <button class="btn btn-default btn-transparent btn-lg x5-margin-left x2-margin-top white bold x1-padding animated fadeIn slower delay-4s">Watch Intro <i class="icon ion-md-play"></i></button>
                <figure class="pull-right x3-width">
                    <img src="/images/bungalow/Mansion-in-Africa.jpg" alt="property" class="img shadow-grey img-responsive img-thumbnail first-image animated slideInRight">
                    <img src="/images/mansion/51cdba4b69bedd5173000012-750-563.jpg" alt="property" class="shadow-grey img img-responsive img-thumbnail second-image animated slideInRight">
                </figure>
            </div>
        </div>
    </div>
</section>
<!--END: landing page-->
<!--START: offers-->
@section('offers')
<section class="x1-margin-bottom">
    <div class="container-fluid x5-margin-top text-center">
        <div class="row x3-padding-left x3-padding-right x5-padding-bottom text-center bottom-shadow-grey-fish white-bg">
            <h2 class="x30-font-size text-center bolder x0-margin-bottom grey"> <span class="underline-text light-blue">EXCLUSIVE OF</span>FERS</h4>
            @for($offer = 0; $offer < count($property->pluck('investment')->pluck('id')); $offer++)
            <div class="col-md-4 col-sm-12 col-lg-4  x4-margin-top x5-margin-bottom x3-padding text-center revealOnScroll slower delay-1s" data-animation="fadeIn">
            <!--START: Exclusive Offers-->
                <figure class="x1-padding-left shadow-grey-opacity x1-padding-right x5-radius x5-padding-top">
                    <figcaption class="grey bold x2-margin-bottom x15-font-size">{{ucfirst($property->pluck('property_type')[$offer])}}</figcaption>
                    <img src="/images/{{$property->pluck('property_type')[$offer]}}/{{$property->pluck('property_upload_image')->pluck('front_image')[$offer]}}" class="img img-responsive img-thumbnail offer-img"/>
                    <p class="x1-margin-top x5-margin-bottom text-left grey x5-padding">Property Details</p>
                    <p class="x5-padding-bottom"><a href="#" class="btn btn-default btn-lg no-radius">Invest <i class="fa fa-check-circle light-blue"></i></a>  
                    <a href="#" class="btn btn-default btn-lg no-radius">More Details...</a></p>
                </figure>
            <!--END: Exclusive Offers-->
            </div>
            @endfor
            <a href="#" class="btn btn-default btn-lg bold light-blue no-radius x3-margin-bottom x16-font-size">Explore Offers <i class="fas fa-box-open light-blue"></i></a>
        </div>
    </div>
</section>
@endsection
<!--END: offers-->
<!--START: press-->
@section('press')
    <section>
        <div class="container-fluid">
            <div class="row grey-light-bg bottom-shadow-grey-fish x3-padding-top x15-padding-bottom revealOnScroll delay-1s" data-animation="fadeIn">
                <div class="col-md-9 col-sm-12 col-lg-9 x2-margin-top x2-margin-bottom x5-padding-left x5-padding-right x5-radius">
                    <h2 class="text-center bolder x30-font-size x2-margin-top x3-margin-bottom grey "><span class="underline-text light-blue">PRE</span>SS <i class="icon ion-md-text light-blue"></i></h2>
                    <p class="lead grey">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus alias doloremque, sunt, dignissimos architecto minima reprehenderit soluta ullam facilis voluptate, libero officiis eos officia saepe ea distinctio nam numquam est. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus sint enim error omnis fugiat. Illum eveniet quidem veritatis quisquam non minus aliquam atque quas, temporibus consequuntur illo delectus consequatur quasi? Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit consequatur optio in delectus ex saepe excepturi. Repellat iure beatae nam consequatur quo itaque placeat laudantium. Earum alias non dolor fugiat? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, perferendis officia? Soluta rem sequi magni ratione natus, totam id, perspiciatis ducimus qui nemo ea? Odit ad reprehenderit enim qui repudiandae! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque excepturi reiciendis officiis dolorem ipsa optio in quidem ipsum assumenda! Saepe cum ipsam illum maxime consectetur cumque quis sint explicabo nihil.
                    </p>
                </div>
                <div class="col-md-3 col-sm-12 col-lg-3 x2-margin-top">
                    <img src="/images/mobile.jpg" alt="" class="img img-responsive">
                </div>
            </div>
        </div>
    </section>
@endsection
<!--END: press-->

<!--START: subscription-->
@section('subscribe')
    <section>
        <div class="container-fluid">
            <div class="row white-bg text-center x3-padding-top x5-padding-bottom">
                <div class="col-md-12 col-sm-12 col-lg-12 x2-margin-top x2-margin-bottom revealOnScroll delay-1s" data-animation="slideInLeft">
                    <h2 class="text-center bolder x30-font-size x3-margin-bottom grey"><span class="underline-text light-blue">STAY TU</span>NED <i class="fas fa-mail-bulk x30-font-size light-blue"></i> </h2>
                    <p class="lead grey">To ensure you don't miss out on any of our exclusive offers, subscribe to our Newsletter.</p>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="EMAIL" id="" class="form-control x5-width center input-lg no-radius"/>
                        <button type="submit" class="btn btn-info btn-lg no-radius x16-font-size">Subscribe <i class="fas fa-check"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<!--END subscription-->