<style>
    .transparent{background-color: transparent !important;}
</style>
<header class="no-margin no-padding navbar-fixed-top">
    <nav class="navbar navbar-inverse no-radius remove-border x16-font-size navbar-bg" role="navigation">
        <div class="navbar-header x1-padding">
            <button type="button" class="navbar-toggle" data-toggle="collapse" 
                data-target="#example-navbar-collapse">
                <span class="sr-only white">Toggle navigation</span>
                <span class="icon-bar white"></span>
                <span class="icon-bar white"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand active-link-color" href="{{route('home')}}" style="color:#fff">Site Name</a>
        </div>
        <div class="collapse navbar-collapse navbar-right x3-margin-right" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{Route::is('home') ? 'active-link-background' : 'unactive'}} x3-padding-top x3-padding-bottom white">
                    <a href="{{route('home')}}" class="active-link-color transparent white" style="color:#fff"> &nbsp Home &nbsp</a>
                </li>
                <li class="{{Route::is('offers') ? 'active-link-background' : 'unactive'}} x3-padding-top x3-padding-bottom">
                    <a href="{{route('offers')}}" class="active-link-color  transparent" style="color:#fff"> &nbsp Offers &nbsp</a>
                </li>
                <li class="{{Route::is('login') ? 'active-link-background white' : 'unactive'}} x3-padding-top x3-padding-bottom">
                        <a href="{{route('login.investors')}}" class="active-link-color  transparent" style="color:#fff"> &nbsp Login &nbsp </a>
                </li>
                <li class="{{Route::is('register') ? 'active-link-background' : 'unactive'}} x3-padding-top x3-padding-bottom">
                    <a href="{{route('register.investors')}}" class="active-link-color  transparent" style="color:#fff"> &nbsp Register &nbsp</a>
                </li>
                <li class="{{Route::is('press') ? 'active-link-background' : 'unactive'}} x3-padding-top x3-padding-bottom">
                    <a href="{{route('press')}}" class="active-link-color  transparent" style="color:#fff"> &nbsp Press &nbsp</a>
                </li>
            </ul>
        </div> 
    </nav>
</header>