
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name='csrf_token' content="{{ csrf_token() }}">
  <title>
    @yield('title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <link href="{{ URL('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ URL('assets/css/now-ui-dashboard.css?v=1.5.0') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ URL('assets/css/dataTables.min.css') }}">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="green">
      <!--
     We can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="{{ request()->routeIs('admin.usermanagement.index')? 'active': '' }}">
            <a href="{{ route('admin.usermanagement.index') }}">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="{{ request()->routeIs('admin.showExcelReportCritera')? 'active': '' }}">
            <a href="{{ route('admin.showExcelReportCritera') }}">
              <i class="now-ui-icons design_app"></i>
              <p>Excel Report</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            
          </div>
          {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button> --}}
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            {{-- <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form> --}}
            <ul class="navbar-nav">
             
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i >{{ Auth::user() ->name}}</i>
                 
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                
                  <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout').submit();">Logout</a>
                  <form method="POST" action="{{ route('admin.logout') }}" id="logout">
                    @csrf
                  </form>
                </div>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        
        @yield('content')

      </div>
      {{-- <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
             
              </li>
              <li>
          
              </li>
              <li>
         
              </li>
            </ul>
          </nav>
  
        </div>
      </footer> --}}
    </div>
  </div>

  <script src="{{ URL('assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ URL('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ URL('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ URL('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ URL('assets/js/dataTables.min.js') }}"></script>

  
 
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

  <script src="{{ URL('assets/js/plugins/chartjs.min.js') }}"></script>
  
  <script src="{{ URL('assets/js/plugins/bootstrap-notify.js') }}"></script>
  
  <script src="{{ URL('assets/js/now-ui-dashboard.min.js?v=1.5.0') }}" type="text/javascript"></script>
  
  @include('sweetalert::alert')
  @yield('scripts')

</body>

</html>