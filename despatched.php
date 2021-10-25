<?php

session_start();
if(empty($_SESSION['loginsuccess']) ){
    header("Location: login.php");
    die();
}

  include_once 'database.php';
  include('includes/header.php');
  include('includes/navbar.php');
    include('includes/scripts.php');
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <style media="screen">
     #form  {
       text-align: center;
     }
     body {
    background-image: url("dispatch.jpg");

}
     </style>
   </head>
   <body >
     <form  action="" id="form" method="post">
     <div >
         <label for="Doc_despatch"> <h4>Enter Document No:</h4> </label>
     </div>
       <input type="text" name="Doc_despatch" value="">
       <input type="submit" name="despatch" class="btn btn-warning " value="Dispatch">
     </form>
     <?php
     if(isset($_POST['despatch']))
     {

       $docNo=$_POST['Doc_despatch'];
       // $sel="SELECT despatch from inward WHERE DocumentNo='$docNo'";
       //TIMELINE
date_default_timezone_set('Asia/Kolkata');
$datetime= date("Y:m:d G:i:s");
$sqlt= "INSERT INTO timeline (id,description) VALUES('$docNo','Dispatched')";


$rest=$conn->query($sqlt);

       $sql="UPDATE `inward` SET `despatch`='yes' WHERE DocumentNo='$docNo'";
       $res=$conn->query($sql);
       if($rest && $res)
       {
         $_SESSION['despatch']=1;
         header("location:despatched.php");
       }
       else {
         echo "ERROR: Hush! Sorry $sql. "
             . mysqli_error($conn);
       }
     }

     unset($_POST['despatch']);

      ?>
   </body>
 </html>
