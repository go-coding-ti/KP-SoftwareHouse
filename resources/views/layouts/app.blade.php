<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Dashboard</title>
  <link rel="icon" type="image/png" href="{{asset('assets/frontend/images/favicon.png')}}" />

  <!-- Custom fonts for this template-->
  <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
  @stack('css')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">Admin Laksita Emi Saguna</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>
      <!-- Nav Item - Expertise -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('expertise')}}">
          <i class="fas fa-fw fa-fire"></i>
          <span>Expertise</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="{{route('product')}}" data-toggle="collapse" data-target="#productcollapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-tasks"></i>
            <span>Product</span></a>
            <div id="productcollapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">News Component:</h6>
                <a class="collapse-item" href="{{route('instansi')}}">Instansi</a>
                <a class="collapse-item" href="{{route('product')}}">Product</a>
              </div>
            </div>  
      </li>

      <!-- Nav Item - Project -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('project')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Project</span></a>
      </li>

      <!-- Nav Item - Project -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('project_trial')}}">
          <i class="fas fa-fw fa-object-group"></i>
          <span>Project Trial</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('blog')}}" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-blog"></i>
          <span>News</span></a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">News Component:</h6>
              <a class="collapse-item" href="{{route('blog_category')}}">News Category</a>
              <a class="collapse-item" href="{{route('blog')}}">News</a>
            </div>
          </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('blog')}}" data-toggle="collapse" data-target="#collapsePagesMenu" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-bars"></i>
          <span>Menu</span></a>
          <div id="collapsePagesMenu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Menu Component:</h6>
              <a class="collapse-item" href="{{route('page')}}">Page</a>
              <a class="collapse-item" href="{{route('menu')}}">Menu</a>
              <a class="collapse-item" href="{{route('submenu')}}">Sub Menu</a>
            </div>
          </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('blog')}}" data-toggle="collapse" data-target="#AboutcollapsePagesMenu" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-info-circle"></i>
          <span>About Us</span></a>
          <div id="AboutcollapsePagesMenu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Menu Component:</h6>
              <a class="collapse-item" href="{{route('team')}}">Team</a>
              <a class="collapse-item" href="{{route('about-us')}}">Preference</a>
            </div>
          </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('preference')}}" data-toggle="collapse" data-target="#collapSetting" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-cog"></i>
          <span>Settings</span></a>
          <div id="collapSetting" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Settings Component:</h6>
              <a class="collapse-item" href="{{route('preference')}}">Preference</a>
              <a class="collapse-item" href="{{route('social-media')}}">Social Media</a>
            </div>
          </div>
      </li>

      @if (Auth::user()->type == 1)
        <li class="nav-item">
          <a class="nav-link" href="{{route('user')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Admin Manager</span></a>
        </li>
      @endif
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                @if (Auth::user()->image)
                  <img class="img-profile rounded-circle" src="{{asset(Auth::user()->image)}}">
                @else
                  <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                @endif
                
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('manuser')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
           {{ __('Logout') }}</a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  @yield('js')
  

  <!-- Page level custom scripts -->

 
</body>

</html>
