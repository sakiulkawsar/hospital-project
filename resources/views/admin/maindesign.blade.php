<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin_end/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin_end/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin_end/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin_end/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin_end/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin_end/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin_end/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin_end/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="index.html"><img src="admin_end/assets/images/logo.svg" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="admin_end/assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="admin_end/assets/images/faces/face15.jpg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">Admin</h5>
                  <span>Admin Member</span>
                </div>
              </div>
             
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
            
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link"><h4>Admin Dashboard</h4></span>
          </li>
       
          <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Admin page</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                 <li class="nav-item"> <a class="nav-link" href="{{ route('add_doctors') }}"> Add Doctors </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('view_doctors') }}"> View Doctors </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('view_appointment') }}"> Doctor Appointment </a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                 <li class="nav-item"> <a class="nav-link" href="{{ route('specialties.create') }}"> Add Specialty </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('specialties.index') }}"> View Specialty </a></li>
              </ul>
            </div>
          </li>

            <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#clinicalMenu" aria-expanded="false"
                        aria-controls="clinicalMenu">

                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">Rooms</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="clinicalMenu">

                        <ul class="nav flex-column sub-menu">
                            <a class="nav-link" href="{{ route('room.create') }}">Add room</a>
                            <a class="nav-link" href="{{ route('room.index') }}">View rooms</a>
                        </ul>
                    </div>
                </li>
             
         
        
        </ul>
      </nav>
      <!-- partial -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="admin_end/assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
          
             
            
              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                  <div class="navbar-profile">
                  
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">Admin</p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
              
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                   
                   
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                     
                    </div>
                    <div class="preview-item-content">
                       <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                     
                    </div>
                  </a>
                 
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
      
      <div class="main-panel">
       @yield('main')
       
      
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin_end/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="admin_end/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin_end/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin_end/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin_end/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin_end/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin_end/assets/js/off-canvas.js"></script>
    <script src="admin_end/assets/js/hoverable-collapse.js"></script>
    <script src="admin_end/assets/js/misc.js"></script>
    <script src="admin_end/assets/js/settings.js"></script>
    <script src="admin_end/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin_end/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>