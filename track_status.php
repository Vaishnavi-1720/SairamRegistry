<?php

session_start();
if(empty($_SESSION['loginsuccess']) ){
    header("Location: login.php");
    die();
}
include('includes/header.php');
include('includes/navbar.php');
include('includes/scripts.php');
include("database.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

<style media="screen">


.text-center  {
text-align:  center;
}

.container  {
max-width:  700px;
margin:  0  auto;
margin-top:  20px;
padding:  50px;
}
#form  {
  text-align: center;
}
#id  {
  text-align: center;
}
.table-responsive{
  padding: 10px;
      margin-left:auto;margin-right:auto;
      max-width:500px;
   white-space:nowrap;
}
.fa-check{
  padding:7.5px;
  border-radius: 50%;
  color: #1cc820;
}
.fa-hourglass-half{
  padding:7.5px;
  border-radius: 50%;
  color: #e74a3b;
}

    </style>
  </head>
  <body>


    <div class="col-md-2 mr-auto">
      <a href="inward.php" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Go Back </a>
    </div>
    <?php
    if(isset($_POST['track']) || isset($_GET['docNo']))
    {
      if(isset($_POST['track'])){
      $docNo=$_POST['Doc_track'];}
      if(isset($_GET['docNo'])){
      $docNo=$_GET['docNo'];}
      $sql="SELECT  check_points,status FROM `inward` WHERE DocumentNo='$docNo'";
      $res=$conn->query($sql);

     if ($res->num_rows>0) {

    while($row = $res->fetch_assoc()) {
      $array=json_decode($row['check_points']);
      $stat=json_decode($row['status']);
      $status=$row['status'];
      if(count($array)){
      $count=count($array);}
      else {
      ?>
        <p style="text-align:center; padding:50px; font-size:25px;"> <strong>OOPS! Add persons to track</strong> </p>

        <?php


      }

    ?>
    <div class="table-responsive">


    <table class="table table-bordered"  cellspacing=0 >
      <col width="10">
     <col width="10">
     <col width="10">


      <thead class="thead-inverse" >
        <tr>
          <th>S.No</th>
          <th>Recipients</th>
          <th>Status</th>
        </tr>
      </thead>
      <?php
      $counter=0;
      for($i=0;$i<$count;$i+=1)
      {

     ?>
     <tbody>
      <tr>
        <td ><?php echo ++$counter ?>   </td>
        <td><?php echo $array[$i];?>  </td>
        <?php if($stat[$i]=="no"){ ?>
        <td ><i class="fa fa-hourglass-half" aria-hidden="true"></i> In Transit</td>
  <?php      }
    else
    {
      ?>
      <td ><i class="fa fa-check fa-md" ></i> Received</td>
      <?php
    }
    ?>

     </tr>
     </tbody>

        <?php

      }  //  end of while condition


    }
  }

  else {
    ?>


<p style="text-align:center; padding:50px; font-size:25px;"> <strong>OOPS! No Record Found !</strong> </p>
    <?php
}
    }

    unset($_POST['track']);
    unset($_GET['docNo']);
     ?>
  </body>
</html>
