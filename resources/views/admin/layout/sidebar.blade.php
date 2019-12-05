    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/home">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Investment Admin <sup>2</sup></div>
        </a>
  
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
  
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="/admin/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>
  
        <!-- Divider -->
        <hr class="sidebar-divider">
  
        <!-- Heading -->
        <div class="sidebar-heading">
          CMS
        </div>
  
       

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-pen"></i>
              <span>Blog</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
               
                <a class="collapse-item" href="/admin/blog">Create Post</a>
                <a class="collapse-item" href="/admin/view-posts">View Post</a>
              </div>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/admin/page-control">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Page Control</span></a>
          </li>
  
          <li class="nav-item">
            <a class="nav-link" href="/admin/ticket-control">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Ticket Control</span></a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report" aria-expanded="true" aria-controls="report">
                <i class="fas fa-fw fa-table"></i>
                <span>Report Control</span>
              </a>
              <div id="report" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                 
                  <a class="collapse-item" href="/admin/users-report">User Report</a>
                     <a class="collapse-item" href="/admin/transactions-report">Transaction Report</a>
                     <a class="collapse-item" href="/admin/properties-report">Properties Report</a>
                </div>
              </div>

        
            </li>

           
            <li class="nav-item">
              <a class="nav-link" href="/admin/view-property">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Property Control </span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/admin/get-payments">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                <span>Payment Control </span></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/admin/settings">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                <span>Settings  </span></a>
            </li>
  
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
  
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
  
      </ul>
      <!-- End of Sidebar -->