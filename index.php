<?php

session_start();
if(empty($_SESSION['loginsuccess']) ){
    header("Location: login.php");
    die();
}
include_once 'database.php';
include('includes/header.php');
include('includes/navbar.php');



?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h1 mb-0 text-gray-800">Dashboard</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>
  <?php

     $sql = "SELECT * FROM inward ";
    $sql1="SELECT * FROM outward";
     $result = $conn->query($sql);
    $result1=$conn->query($sql1);

     if ($result->num_rows >= 0){
       $total1=$result->num_rows ;
     }
    if ($result1->num_rows >= 0){
      $total2=$result1->num_rows ;
    }




   ?>
  <!-- Content Row -->
  <div class="row">


        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-3">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Total Inward</div>
                  <div class="h2 mb-0 font-weight-bold text-gray-800">  <?php echo  $total1 ; ?>  </div>


                   <a href="inward.php"  style="align:center;" class="btn btn-sm btn-outline-secondary text-black">View</a>
                </div>
                <div class="col-auto">
                  <i class="fas fa-folder-open fa-3x text-gray-500"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-3">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Total Outward</div>
              <div class="h2 mb-0 font-weight-bold text-gray-800">  <?php echo  $total2 ; ?>  </div>


               <a href="outward.php"  style="align:center;" class="btn btn-sm btn-outline-secondary text-black">View</a>
            </div>
            <div class="col-auto">
              <i class="fas fa-folder-open fa-3x text-gray-500"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
  <?php
include('includes/scripts.php');
include('includes/footer.php');

?>
