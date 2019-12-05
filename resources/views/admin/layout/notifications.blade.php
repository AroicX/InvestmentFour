  <!-- Nav Item - Alerts -->
  <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <!-- Counter - Alerts -->
          @if(App\Http\Controllers\AdminNotificationController::getUnreadNotifications()->count())
          <span class="badge badge-danger badge-counter">

              {{count(App\Http\Controllers\AdminNotificationController::getUnreadNotifications())}}+

          </span>
          @endif
      </a>


      <style>
          .mark-all{
              float: right !important;
              text-decoration: none !important;
              transition: all 0.6s ease-out;
              margin-top: 5px;
          }
          .mark-all:hover{
              float: right !important;
              text-decoration: none !important; 
              font-size: 16px;
              transition: all 0.5s ease-in;
          }
      </style>
      
      <!-- Dropdown - Alerts -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
          aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
              New Notifications
          </h6>

          <div class="mx-2  light-blue pull-right mark-all">
                <a href="{{url('/admin/markAll')}}">
                    <p>Mark All as Read</p>
                </a>
            </div>

          @if(App\Http\Controllers\AdminNotificationController::getUnreadNotifications()->count())
              @foreach(App\Http\Controllers\AdminNotificationController::getUnreadNotifications() as $notifications)
             
          <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{$notifications->created_at}}</div>
                    <span class="font-weight-bold">{!! $notifications->data !!}</span>
                </div>
            </a>
            
              @endforeach
              @else
              
          <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    {{-- <div class="small text-gray-500">December 12, 2019</div> --}}
                    <span class="font-weight-bold">No Notifications Found</span>
                </div>
            </a>
             
              @endif


          <a class="dropdown-item text-center small text-gray-500 disabled" href="#">Show All Alerts</a>
      </div>
  </li>



{{-- 

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
                              <a href="{{route('markAsRead')}}">
                                  <p>Mark All as Read</p>
                              </a>
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
  </li>  --}}
