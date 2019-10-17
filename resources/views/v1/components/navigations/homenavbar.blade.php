<style>
    .transparent{background-color: transparent !important;}
</style>
<header class="no-margin no-padding animated fadeIn slow bottom-shadow-grey-fish">
    <nav class="navbar navbar-inverse navbar-bg x11-font-size no-radius remove-border white" role="navigation" >
        <div class="x9-width centered no-padding">
            <div class="navbar-header x1-padding-top no-margin">
                <button type="button" class="navbar-toggle" data-toggle="collapse" 
                    data-target="#example-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('home')}}" style="color:#fff;">@include('v1.components.headers.logo')</a>
            </div>
        <div class="collapse navbar-collapse navbar-right x3-margin-right" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{Route::is('offers') ? 'active-page white' : 'unactive'}} x1-margin-top x1-padding-top x1-padding-bottom">
                    <a href="{{route('offers')}}" class="active-link-color  transparent" style="color:#fff"> &nbsp Offers &nbsp</a>
                </li>
                <li class="{{Route::is('login') ? 'active-page white' : 'unactive'}} x1-margin-top x1-padding-top x1-padding-bottom">
                        <a href="{{route('login')}}" class="active-link-color  transparent" style="color:#fff"> &nbsp Login &nbsp </a>
                </li>
                <li class="{{Route::is('register') ? 'active-page white' : 'unactive'}} x1-margin-top x1-padding-top x1-padding-bottom">
                    <a href="{{route('register')}}" class="active-link-color  transparent" style="color:#fff"> &nbsp Register &nbsp</a>
                </li>
                <li class="{{Route::is('press') || Route::is('getpresspost') ? 'active-page white' : 'unactive'}} x1-margin-top x1-padding-top x1-padding-bottom">
                    <a href="{{route('press')}}" class="active-link-color  transparent" style="color:#fff"> &nbsp Blog &nbsp</a>
                </li>
            </ul>
        </div> 
    </nav>
</header>