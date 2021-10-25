<?php
include_once 'database.php';
 ?>

   <!-- Sidebar -->
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
  <a class="nav-link" href="inbox.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span> Hi ! <?php echo $user; ?> </span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->

<li class="nav-item">
  <a class="nav-link" href="inbox.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Update status</span></a>
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
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="height:35px;">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

     <!-- <div class="nav-item dropdown no-arrow"style="position:absolute; right:20% ">
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <i class="fas fa-bell fa-lg fa-fw mr-0 text-black-600"></i><sup class="badge" ><?php echo($unseen_count) ?></sup>
      </a>
      <ul class="dropdown-menu">
      </ul>
     </li>
    </ul>

     </div> -->
<?php
$res=mysqli_query($conn,"SELECT `date`, `DocumentNo`, `frm`, `subject`, `category`, `letter`, `check_points`, `status`, `note` FROM `inward` WHERE  `check_points` LIKE '%$user%' AND notification_status=0");
$unseen_count=mysqli_num_rows($res);
 ?>

      <div class="container-fluid">
       <div class="navbar-header">
        <a class="navbar-brand" href="#"></a>
       </div>
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown no-arrow">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fas fa-bell fa-lg fa-fw mr-0 text-black-600"></i><sup class="badge" ><?php echo($unseen_count) ?></sup></a>
         <ul class="dropdown-menu">

         </ul>
        </li>
       </ul>
      </div>
<!--  -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto" >
            <div class="topbar-divider d-none d-sm-block"></div>


            <!-- Nav Item - User Information -->

            <li class="nav-item dropdown no-arrow">

              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <strong><?php echo($user); ?></strong>
              </span>

                <i class="fas fa-user fa-fw mr-2 text-gray-400"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-black-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-black-400"></i>
                  Settings
                </a>
                <div >


                </div>

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
  <script>
  $(document).ready(function(){

   function load_unseen_notification(view = '')
   {
    
    $.ajax({
     url:"codes_staff.php",
     method:"POST",
     data:{view:view},
     dataType:"json",
     success:function(data)
     {
      $('.dropdown-menu').html(data.notification);
      if(data.unseen_notification > 0)
      {
       $('.count').html(data.unseen_notification);
      }
     }
    });
   }

    load_unseen_notification();


   $(document).on('click', '.dropdown-toggle', function(){
    $('.count').html('');
    load_unseen_notification('yes');
   });

   setInterval(function(){
    load_unseen_notification();;
   }, 5000);

  });
  </script>
