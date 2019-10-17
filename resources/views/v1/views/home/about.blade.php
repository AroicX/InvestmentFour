@extends('v1.master.public')

@section('title', 'about us')

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
    <div class="container-fluid x8-width no-padding-top no-margin-top-header x2-margin-bottom animated fadeIn slow delay-1s">
        <div class="row no-padding white-bg form-border x1-margin-bottom bottom-border-radius">
            <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding no-margin text-center">
                <img src="/images/{!! App\Http\Controllers\AppController::getHeaderImageName() !!}" alt="About Us Image" title="About Us" class="img img-responsive" />
                <div class="container-fluid">
                    <div class="row x2-padding">
                        <div class="col-md-3 col-sm-12 col-lg-3 text-left">
                            <a class="btn btn-primary btn-inf no-radius btn-lg">Whitepaper <i class="fas fa-download"></i> </a>
                        </div>
                        <div class="col-md-9 col-sm-12 col-lg-9 text-right-footer no-padding-right">
                            <span class="bolder grey x14-font-size"><span class="light-blue">Follow U</span>s:</span>
                            @if(App\Http\Controllers\AppController::getFacebookLink())<a target="_blank" href="{!! App\Http\Controllers\AppController::getFacebookLink() !!}" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-facebook-square x16-font-size"></i></a>@endif
                            @if(App\Http\Controllers\AppController::getTwitterLink())<a target="_blank" href="" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-twitter-square x16-font-size"></i></a>@endif
                            @if(App\Http\Controllers\AppController::getDiscordLink())<a target="_blank" href="" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-discord x16-font-size"></i></a>@endif
                            @if(App\Http\Controllers\AppController::getInstagramLink())<a target="_blank" href="" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-instagram x16-font-size"></i></a>@endif
                            @if(App\Http\Controllers\AppController::getTelegramLink())<a target="_blank" href="" class="x1-margin-right x1-margin-left"><i class="nav-zoom fab fa-telegram x16-font-size"></i></a>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-padding-left no-padding-right x5-padding-bottom white-bg form-border x4-radius">
        <h3 class="bolder grey about-margin x2-margin-left x3-margin-top heading-2"> <span class="light-blue">ABO</span>UT US </h3>
            <div class="col-md-12 col-sm-12 col-lg-12 x4-padding-left x1-padding-top x2-padding-right">
                <div class="x2-margin-top center x9-width">
                    <!-- START: Who we are -->
                    <div id="who-we-are-div">
                        <h4 class="x15-font-size heading grey-bg grey no-margin bolder x2-padding who-button"> <i class="fas fa-certificate light-blue"></i> WHO WE ARE <i class="fas fa-chevron-down pull-right grey hand-cursor" id="who-button"></i> </h4>
                        <p class="x14-font-size grey normal x1-margin-top" id="who-we-are-paragraph">
                            {!! nl2br(App\Http\Controllers\AppController::getWhoWeAre()) !!}
                        </p>
                    </div>
                <!-- END -->
                <!-- START: What we do -->
                <div class="x8-margin-top" id="what-we-do-div">
                    <h4 class="x15-font-size grey no-margin bolder grey-bg x2-padding heading-2 what-button"> <i class="fas fa-award light-blue"></i> WHAT WE DO <i class="fas fa-chevron-down pull-right grey hand-cursor" id="what-button"></i> </h4>
                    <p class="x14-font-size grey normal x1-margin-top" id="what-we-do-paragraph">
                        {!! nl2br(App\Http\Controllers\AppController::getWhatWeDo()) !!}
                    </p>
                </div>
                <!-- END -->
                <!-- START: Our essence -->
                <div class="x8-margin-top" id="essence-div">
                    <h4 class="x15-font-size grey no-margin bolder grey-bg x2-padding heading-2 essence-button"> <i class="fas fa-code light-blue"></i> OUR ESSENCE <i class="fas fa-chevron-down pull-right grey hand-cursor" id="essence-button"></i> </h4>
                    <p class="x14-font-size grey normal x1-margin-top" id="our-essence-paragraph">
                        {!! nl2br(App\Http\Controllers\AppController::getOurEssence()) !!}
                    </p>
                </div>
                <!-- END -->
                <!-- START: Meet our team -->
                <div class="x8-margin-top no-padding" id="our-team-div">
                    <h4 class="x15-font-size grey no-margin bolder grey-bg x2-padding heading-2 team-button"> <i class="fas fa-users light-blue"></i> MEET THE TEAM <i class="fas fa-chevron-down pull-right grey hand-cursor" id="team-button"></i> </h4>
                    <div id="item-container">
                        <div class="container-fluid x1-margin-top no-padding" id="team-container">
                            <div class="row x2-margin-top x5-margin-bottom text-center">
                                @if(App\Http\Controllers\AppController::getTeamRoles())
                                    <?php $divider_counter = 0; ?>
                                    @foreach(App\Http\Controllers\AppController::getTeamRoles() as $roles)
                                    <?php $divider_counter++; ?>
                                    @if($divider_counter >= 2)
                                    <div class="border-top"></div>
                                    @endif
                                        <h4 class="lined-subtext center" style="margin-bottom:5%; {{$divider_counter >= 2 ? 'margin-top:5%' : ''}}"> {{strtoupper($roles->role)}} </h4>
                                        @if(App\Http\Controllers\AppController::getTeamAndRole($roles->id))
                                            <?php  $count = 0; ?>
                                            @foreach(App\Http\Controllers\AppController::getTeamAndRole($roles->id) as $team)
                                            <?php $count++; ?>
                                                <div class="col-md-3 col-sm-12 col-lg-3">
                                                    <div class="center no-margin x9-width">
                                                        <figure class="text-center">
                                                            <img src="images/team/{!! $team->image_file !!}" alt="" class="img img-responsive img-circle img-thumbnail center blurred team-images">
                                                            <h5 class="grey bold x14-font-size text-center"> {{ucwords($team->name)}} </h5>
                                                            <h5 class="light-blue x14-font-size text-center">{{ucwords($team->position)}}</h5>
                                                            <p class="lead text-center">
                                                            @if($team->facebook_link != '' || $team->facebook_link != Null)
                                                                    <a href="{!! $team->facebook_link !!}" class="normal-link"> 
                                                                        <i class="fab fa-facebook nav-zoom"></i>
                                                                    </a>
                                                            @endif
                                                            @if($team->twitter_link != '' || $team->twitter_link != Null)
                                                                    <a href="#" class="x7-margin-left-content normal-link">
                                                                        <i class="fab fa-twitter-square nav-zoom light-blue"></i>
                                                                    </a>
                                                                @endif
                                                                @if($team->discord_link != '' || $team->discord_link != Null)
                                                                    <a href="#" class="x7-margin-left-content normal-link">
                                                                        <i class="fab fa-discord nav-zoom light-blue"></i>
                                                                    </a>
                                                                @endif
                                                                @if($team->instagram_link != '' || $team->instagram_link != Null)
                                                                    <a href="#" class="x7-margin-left-content normal-link">
                                                                        <i class="fab fa-instagram nav-zoom maroon-2"></i>
                                                                    </a>
                                                                @endif
                                                            </p>
                                                        </figure>
                                                    </div>
                                                </div>
                                                @if($count % 4 == 0)
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        </div> <!--Closes row after each team role-->
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection