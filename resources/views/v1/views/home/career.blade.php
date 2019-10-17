@extends('v1.master.public')

@section('title', 'career')

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
<section>
    <div class="container-fluid no-margin grey-bg x5-padding-top x3-padding-bottom">
        <div class="row  no-margin center">
            <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding no-margin ">
                <img src="images/career.jpg" alt="about us" title="about us" class="img-responsive center shadow-grey-opacity">
            </div>
        </div>
        <div class="row  center x8-width">
            <div class="col-md-12 col-sm-12 col-lg-12">
               <p class="lead grey normal">
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi blanditiis perspiciatis, dignissimos totam nulla adipisci, commodi quibusdam enim minus nesciunt eum accusamus fugiat quos, ipsa quod numquam reprehenderit deleniti repellat!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, placeat magni beatae debitis, facere modi quod corporis officia sapiente non ipsum temporibus nulla laborum. Facere ratione quibusdam nobis dolorem blanditiis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam at deleniti, explicabo enim itaque tempora consequuntur labore perspiciatis earum dolorem qui eveniet perferendis eius doloribus vel, ducimus possimus hic iusto.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Id sunt beatae mollitia vero, accusamus reprehenderit iure quis. Aspernatur porro quasi necessitatibus illo! Officia aut dignissimos est ipsa delectus rem obcaecati!
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae aperiam aliquam quidem. Exercitationem distinctio ex unde at dicta consectetur libero quas maiores enim cupiditate consequatur, itaque sit perferendis odit vitae.
               </p>
            </div>
        </div>
    </div>
</section>
@endsection