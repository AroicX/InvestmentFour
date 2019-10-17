<style>
    .separate-right
    {
        border-right: 2px solid rgba(255, 255, 255, 0.2)
    }
    .separate-left
    {
        border-left: 2px solid rgba(255, 255, 255, 0.2)
    }
    .sub-link{
        color: rgb(122, 118, 118);
        transition: ease-in background-color .4s, ease-in color .4s;
    }
    .sub-link:hover{
        background-color: rgb(49, 148, 179);
        color: rgb(255, 255, 255);
    }
</style>
<header class="no-margin no-padding animated fadeIn bottom-shadow-grey-fish">
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
                <a class="navbar-brand x3-margin-top" href="{{route('home')}}" style="color:#fff;">@include('v1.components.headers.logo')</a>
            </div>
            <div class="collapse navbar-collapse navbar-right x6-margin-right no-pagging" id="example-navbar-collapse">
                <ul class="nav navbar-nav no-padding">
                    <li class="{{ Route::is('active') || Route::is('all') || Route::is('investmentsearch') ? 'active-page' : '' }} hovered-nav x1-margin-top x1-padding-top x1-padding-bottom dropdown">
                        <a  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" title="Potfolio" class="active-link-color transparent dropdown-toggle" style="color:#fff"> 
                            Potfolio <i class="fas fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu bottom-shadow-grey" aria-labelledby="navbarDropdown" id="submenu-potfolio">
                            <div class="white-bg speech-bubble">
                                <ul class="nav" id="submenu-potfolio">
                                    <li class="{{ Route::is('active') ? 'active-link-background white' : 'sub-link' }} x1-margin-top x1-padding-top x1-padding-bottom">
                                        <a href="{{route('active')}}" class="{{ Route::is('active') ? 'white' : 'sub-link' }}">
                                            <i class="fas fa-chart-line"></i> Active Investment 
                                        </a>
                                    </li>
                                    <li class="{{ Route::is('all') || Route::is('investmentsearch') ? 'active-link-background white' : 'sub-link' }} x1-margin-top x1-padding-top x1-padding-bottom">
                                        <a href="{{route('all')}}" class="{{ Route::is('all') || Route::is('investmentsearch') ? 'white' : 'sub-link' }}">
                                           <i class="fa fa-history"></i> All Investment
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="{{ Route::is('transactions') || Route::is('transaction') || Route::is('transactionsearch')? 'active-page' : '' }} hovered-nav x1-margin-top x1-padding-top x1-padding-bottom">
                        <a href="{{route('transactions')}}" style="color:#fff">
                            Transactions
                        </a>
                    </li>
                    <li class="{{Route::is('offer') || Route::is('offerInvest') ? 'active-page' : '' }} hovered-nav x1-margin-top x1-padding-top x1-padding-bottom">
                        <a href="{{route('offer')}}" style="color:#fff">
                            Offers 
                        </a>
                    </li>
                    <li class="{{Route::is('ticket') || Route::is('ticketResponse') || Route::is('readResponse') ? 'active-page' : '' }} hovered-nav x1-margin-top x1-padding-top x1-padding-bottom dropdown">
                        <a  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" title="Ticket" class="dropdown-toggle" style="color:#fff"> 
                            Ticket <i class="fas fa-caret-down"></i>
                        </a>
                        <div class="dropdown-menu bottom-shadow-grey" aria-labelledby="navbarDropdown" id="submenu-ticket">
                            <div class="white-bg speech-bubble">
                                <ul class="nav" id="submenu-ticket">
                                    <li class="{{Route::is('ticket') ? 'active-link-background white' : 'sub-link' }} x1-margin-top x1-padding-top x1-padding-bottom">
                                        <a href="{{route('ticket')}}" class="{{Route::is('ticket') ? 'white' : 'sub-link' }}"><i class="fas fa-edit"></i> Create Ticket </a>
                                    </li>
                                    <li class="{{ Route::is('ticketResponse') ? 'active-link-background white' : 'sub-link' }} x1-margin-top x1-padding-top x1-padding-bottom">
                                        <a href="{{route('ticketResponse')}}" class="{{ Route::is('ticketResponse') ? 'white' : 'sub-link' }}"><i class="fas fa-book-reader"></i> Responses</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="{{Route::is('wishlist') ? 'separate-left' : ' separate-left'}} x1-padding-top x1-padding-bottom">
                        <a href="{{route('wishlist')}}" title="Wishlist" class="active-link-color transparent" style="color:#fff"> 
                            <span class="fa-stack fa-1x">
                                <i class="fas fa-heart fa-stack-2x footer-continue"></i>
                                <span class="fa-stack-1x fa-inverse" style="{!! App\Http\Controllers\GlobalMethods::fixWishlistBadge() !!}" id="wishlist-count-container">
                                    @if(App\Http\Controllers\GlobalMethods::getWishlistNumber() > 0) 
                                        <span class="badge green-bg-2 x9-font-size" id="wishlist-count">
                                            {{App\Http\Controllers\GlobalMethods::getWishlistNumber()}}
                                        </span>
                                    @endif
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="x1-padding-top x1-padding-bottom dropdown notification-button">
                        <a  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" title="Notification" class="active-link-color transparent dropdown-toggle navbar-icon-controller"> 
                            <span class="fa-stack fa-1x">
                                <i class="fas fa-bell fa-stack-2x navbar-icon"></i>
                                <span class="fa-stack-1x count" style="{!! App\Http\Controllers\GlobalMethods::fixNotificationBadge() !!}" id="notification-count-container">
                                    @if(App\Http\Controllers\NotificationController::getUnreadNotifications()->count()) 
                                        <span class="badge" id="notification-count">
                                            {{count(App\Http\Controllers\NotificationController::getUnreadNotifications())}}
                                        </span>
                                    @endif
                                </span>
                            </span>
                        </a>
                        <div class="dropdown-menu bottom-shadow-grey" aria-labelledby="navbarDropdown">
                            <div class="white-bg speech-bubble" id="notification-notes">
                                <ul class="nav" id="notes">
                                    <li>
                                        <div class="container-fluid">
                                                <div class="row">
                                                <div class="col-md-7 col-sm-12 col-lg-7">
                                                    <h3 class="grey bolder x3-margin-left">Notifications</h3>
                                                </div>
                                                <div class="col-md-5 col-sm-12 col-lg-5 light-blue text-right x6-padding-top">
                                                    <a href="{{route('markAsRead')}}"><p>Mark All as Read</p></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-item divider"></li>
                                    @if(App\Http\Controllers\NotificationController::getUnreadNotifications()->count())
                                        @foreach(App\Http\Controllers\NotificationController::getUnreadNotifications() as $notifications)
                                            <li class="dropdown-item notify-link no-padding">
                                                <a href="#" class="normal-link">
                                                    <p data-notification="no-of-notification" class="x14-font-size no-margin notify-text">
                                                            {!! $notifications->data !!}
                                                    </p>
                                                </a>
                                            </li>
                                            <li class="dropdown-item divider"></li>
                                        @endforeach
                                    @else
                                        <li class="dropdown-item no-padding">
                                            <a class="normal-link">
                                                <p data-notification="no-of-notification" class="x14-font-size no-margin grey text-center">
                                                        No unread notifications.
                                                </p>
                                            </a>
                                        </li>
                                        <li class="dropdown-item divider"></li>
                                    @endif
                                    <li class="dropdown-item text-center">
                                        <a href=" {{route('notifications')}} " class="light-blue x14-font-size">View All</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="x1-padding-top x1-padding-bottom dropdown">
                        <a  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" title="User Control" class="active-link-color transparent dropdown-toggle navbar-icon-controller" style="color:#fff"> 
                            <i class="fas fa-user-circle navbar-icon x28-font-size"></i>
                        </a>
                        <div class="dropdown-menu bottom-shadow-grey x5-width" aria-labelledby="navbarDropdown" id="submenu-user">
                            <div class="white-bg speech-bubble">
                                <ul class="nav" id="user-menu">
                                    <li class="{{Route::is('info') ? 'active-link-background white' : 'sub-link' }} x1-margin-top x1-padding-top x1-padding-bottom">
                                            <a href="{{route('info')}}" class="{{Route::is('info') ? 'white' : 'sub-link' }}"><i class="fas fa-user"></i> Profile </a>
                                    </li>
                                    <li class="{{Route::is('addPersonal') || Route::is('addKin') || Route::is('addBank') ? 'active-link-background white' : 'sub-link' }} x1-margin-top x1-padding-top x1-padding-bottom">
                                        <a href="{{route('addPersonal')}}" class="{{Route::is('addPersonal') || Route::is('addKin') || Route::is('addBank') ? 'white' : 'sub-link' }}"><i class="fas fa-user-edit"></i> Update Profile</a>
                                    </li>
                                    <li class="{{Route::is('settings') ? 'active-link-background white' : 'sub-link' }} x1-margin-top x1-padding-top x1-padding-bottom">
                                        <a href="{{route('settings')}}" class="{{Route::is('settings') ? 'white' : 'sub-link' }}"><i class="fas fa-cog"></i> Settings</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li class=" sub-link x1-margin-top x1-padding-top x1-padding-bottom">
                                        <a href="{{route('logout')}}" class="sub-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div> 
        </div>
    </nav>
</header>

<script type="text/javascript">
    $(document).on('click', '.notification-button', function(e){
        $.ajax({
            type: "GET",
            url : "{{route('markAsRead')}}",
            success: function(data){
                $('.count').html('');
            },
            error: function(data){
                //do something when error occurs//
            }
        });
    });
</script>