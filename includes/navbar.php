<?php
ob_start();
 ?>
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
  <div >

    <img src="LOGO.png" alt="LOGO" width="50" height="50" style="background-color:white">
  </div>
  <div class="sidebar-brand-text mx-3"><sup>Sri </sup>Sai Ram</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span> Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Inward</span>
  </a>
   <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">

      <a class="collapse-item" href="inward.php">Outside Institution</a>
      <a class="collapse-item" href="">Within Institution</a>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link" href="outward.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Outward</span></a>
</li>

<!-- <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#
  " aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Categories</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">

      <a class="collapse-item" href="buttons.html">Inward</a>
      <a class="collapse-item" href="cards.html">Outward</a>
    </div>
  </div>
</li> -->

 <li class="nav-item">
  <a class="nav-link" href="despatched.php">
    <i class="fas fa-paper-plane" ></i>
    <span>dispatch</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="track.php">
    <i class="fas fa-truck"></i>
    <span>Track</span></a>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Reports</span>
  </a>
  <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <!-- <h6 class="collapse-header">Custom Components:</h6> -->
      <a class="collapse-item" href="reportinward.php">Inward</a>
      <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">

         <a class="collapse-item" href="inward.php">Outside Institution</a>
         <a class="collapse-item" href="">Within Institution</a>
       </div>
     </div>
      <a class="collapse-item" href="reportoutward.php">Outward</a>
    </div>
  </div>
</li>








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
        <nav class="navbar navbar-expand navbar-light bg-white topbar " style="height:45px;">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>




          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div>
              <img src="sairam_logo.jpeg" alt="LOGO" height="40" width="140"style="background-color:white;vertical-align:middle; margin-top:15px;">

            </div>

            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item">
      <!-- <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a> -->
    </li>
            <!-- Nav Item - User Information -->
            <li class="nav-item ">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <img class="img-profile rounded-circle" src="profile.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-black-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-black-400"></i>
                  Settings
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>


        </nav>
        <!-- End of Topbar -->


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

          <form action="logout.php" method="POST">

            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

          </form>


        </div>
      </div>
    </div>
  </div>
