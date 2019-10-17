<section>
    <div class="container-fluid navbar-bg no-margin x14-font-size animated fadeIn slow delay-1s">
        <div class="row text-center white x9-width center x10-margin-bottom">
        <div class="col-md-4 col-sm-12 col-lg-4 x2-margin-top x2-margin-bottom center x2-padding">
                <h3 class="white bold white x3-margin-bottom border-bottom-footer-color x2-padding-bottom text-left">CONNECT WITH US</h3>
                <div class="container-fluid no-margin no-padding">
                    <div class="row no-padding">
                        <div class="col-md-12 col-sm-12 col-lg-12 text-left">
                            <p>Join thousands of others who recieve our newletters on exclusive offers and other important information.</p>
                            <form method="post" id="subscription">
                                <div class="form-group x5-margin-top">
                                    <div class="row x8-width">
                                        <div class="col-md-10 col-sm-10 col-lg-10 x2-margin-bottom">
                                            <input type="text" name="subscribe" id="subscribe" class="form-control input-lg no-radius" placeholder="Provide Email" />
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-lg-2">
                                            <button class="btn btn-info no-radius btn-lg" type="submit">
                                                Subscribe <i class="fas fa-mail-bulk"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="x2-margin-top x30-font-size">
                                @if(App\Http\Controllers\AppController::getFacebookLink())<a href="{!! App\Http\Controllers\AppController::getFacebookLink() !!}" class="x15-margin-bottom white normal-link footer-continue x4-margin-right"><i class="fab fa-facebook"></i></a>@endif
                                @if(App\Http\Controllers\AppController::getTwitterLink())<a href="{!! App\Http\Controllers\AppController::getTwitterLink() !!}" class="x15-margin-bottom white normal-link footer-nav x4-margin-right"><i class="fab fa-twitter-square "></i></a>@endif
                                @if(App\Http\Controllers\AppController::getDiscordLink())<a href="{!! App\Http\Controllers\AppController::getDiscordLink() !!}" class="x15-margin-bottom white normal-link footer-nav x4-margin-right"><i class="fab fa-discord"></i> </a>@endif
                                @if(App\Http\Controllers\AppController::getInstagramLink())<a href="{!! App\Http\Controllers\AppController::getInstagramLink() !!}" class="x15-margin-bottom white normal-link footer-nav x4-margin-right"><i class="fab fa-instagram"></i> </a>@endif
                                @if(App\Http\Controllers\AppController::getTelegramLink())<a href="{!! App\Http\Controllers\AppController::getTelegramLink() !!}" class="x15-margin-bottom white normal-link footer-nav x4-margin-right"><i class="fab fa-telegram"></i> </a>@endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4 x2-margin-top x2-margin-bottom center x2-padding">
                <h3 class="white bold white x3-margin-bottom border-bottom-footer-color x2-padding-bottom text-left">ABOUT US</h3>
                <div class="container-fluid no-margin no-padding">
                    <div class="row no-padding">
                        <div class="col-md-12 col-sm-12 col-lg-12 text-left">
                            <p>
                                {!! App\Http\Controllers\AppController::getSummary() !!} 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-lg-4 x2-margin-top x2-margin-bottom center x2-padding">
                <h3 class="white bold white x3-margin-bottom border-bottom-footer-color x2-padding-bottom text-left">COMPANY</h3>
                <div class="container-fluid no-margin no-padding">
                    <div class="row no-padding">
                        <div class="col-md-6 col-sm-12 col-lg-6 text-left">
                            <a href="{{route('offers')}}" class="x15-margin-bottom white normal-link block footer-nav"> <i class="fas fa-box-open"></i> Offers</a>
                            <a href="{{route('career')}}" class="x15-margin-bottom normal-link block footer-nav"> <i class="fas fa-laptop-code"></i> Career</a>
                            <a href="{{route('press')}}" class="x15-margin-bottom  normal-link block footer-nav"> <i class="far fa-newspaper"></i> Blog</a>
                            <a href="{{route('about')}}" class="x15-margin-bottom normal-link block footer-nav"> <i class="fas fa-comment-alt"></i> About Us</a>
                            <a href="{{route('contact')}}" class="x15-margin-bottom white normal-link block footer-nav"> <i class="fas fa-phone-square"></i> Contact Us</a>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6 text-left">
                            <a href="{{route('offers')}}" class="x15-margin-bottom white normal-link block footer-nav"> <i class="fas fa-users"></i> Our Team</a>
                            <a href="{{route('career')}}" class="x15-margin-bottom normal-link block footer-nav"> <i class="fas fa-user-tag"></i> Affiliation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row x5-width border-top-footer-color white center x1-padding-top" style="margin-top: 5%">
            <div class="col-md-6 col-sm-12 col-lg-6 no-padding">
                <p><i class="fas fa-copyright"></i> 2019 Site Name All rights reserved.</p>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-6 no-padding text-right-footer">
                <p> 
                    <span> <a href="#" class="footer-nav">Terms of Service</a></span>
                    <span class="border-left-footer x2-padding-left"><a href="#" class="footer-nav">Privacy Policy</a></span>
                </p>
            </div>
        </div>
    </div>
</section>