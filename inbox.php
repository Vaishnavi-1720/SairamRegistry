<?php

session_start();
include('includes/header.php');
 include('includes/scripts.php');

 $user=$_SESSION['user'];
include('includes/navbar_staff.php');

include_once 'database.php';

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
   <link rel="stylesheet" href="css/staff.css">

  </head>
  <body>


    <div class="alert hide">
      <span class="fas fa-check-circle"></span>
      <span class="msg">Thanks! for updating the status </span>
      <div class="close-btn ">
        <span class="fas fa-times"></span>
      </div>

    </div>
     <script>
    $('.close-btn').click(function(){
      $('.alert').removeClass("show");
        $('.alert').addClass("hide");

    });
    </script>

    <?php if(isset($_SESSION['alert'])){
      ?>
    <script>

        $('.alert').removeClass("hide");
        $('.alert').addClass("show");
        $('.alert').addClass("showAlert");

        setTimeout(function(){
          $('.alert').removeClass("show");
            $('.alert').addClass("hide");

              // $('.btn-success').addClass("hide");
              $('.despatched').addClass("hide");
        },3500);


    </script>
    <?php
     unset($_SESSION['alert']);
    } ?>

    <?php
    $result = mysqli_query($conn,"SELECT `date`, `DocumentNo`, `frm`, `subject`, `category`, `letter`, `check_points`, `status`, `note` FROM `inward` WHERE  `check_points` LIKE '%$user%'");

    $count= mysqli_num_rows($result);

     ?>
    <div class="body">
    <div class="contain">
      <div class="header">
        <div class="title">
          <h3>Your Inbox</h3>
          <p class="badge"><?php echo($count) ?></p>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">

        <div class="input-group">
          <button onClick="window.location.href=window.location.href" class="btn btn-primary "><i class="fas fa-sync-alt"></i> </button>
          <div class="col-md-1">

          </div>
          <input type="text" name="filter" class="form-control" placeholder="Search letter" >

          <button type="submit" name="search" class="btn btn-primary" value="search" style="color:#1b2fe0;"><i class="fas fa-search" style="color:white;"></i></button>

      </div>
      </form>
        <!-- <div class="add"><a href="#"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
          <path fill="#fffff" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" />
          </svg></a>

        </div> -->
      </div>

    <?php
      if(isset($_POST['search']))
      {
        $value=$_POST['filter'];
        $result =  mysqli_query($conn,"SELECT * from inward WHERE CONCAT(DocumentNo,frm,subject,category) LIKE '%$value%' AND  `check_points` LIKE '%$user%' ORDER BY date DESC ");

      }
else{
        $result = mysqli_query($conn,"SELECT `date`, `DocumentNo`, `frm`, `subject`, `category`, `letter`, `check_points`, `status`, `despatch` FROM `inward` WHERE  `check_points` LIKE '%$user%'");
}
      $count= mysqli_num_rows($result);
      $user_status=array();

        if($count!=0){
        while ($row = $result->fetch_assoc()) {

           $idval=$row['DocumentNo'];
          $status=json_decode($row['status']);
          $array=json_decode($row['check_points']);
           $cnt=count($status);
           for($i=0;$i<$cnt;$i+=1)
           {
             if(strtolower($array[$i])==strtolower($user))
             {
              if($status[$i]=='yes'){
               array_push($user_status,$idval);
               break;
             }

             }

           }

             $counter=0;

             $sqlt = "SELECT time,description FROM timeline where id='$idval' and description='Arrived'";
             $res = $conn->query($sqlt);

             if ($res->num_rows > 0) {
               while($r = $res->fetch_assoc()) {
                 list($date,$time)=explode(" ",$r['time']);

         }
         }



     ?>


  <div href="#" class="mail-area">
    <div class="mail">
      <div class="profile">

      <i class="fas fa-user fa-lg"></i>
        </div>
      <div class="content">
    <?php  $_SESSION['docNo']=$row['DocumentNo']; ?>
        <h4><?php echo $row['frm'];?></h4>
        <h5><?php echo $row['subject'];?></h5>
        <p><?php $LogintDate = strtotime($row['date']);
           echo  nl2br(date(" j  F Y\n", $LogintDate));  ?></p>
           <h6><?php  echo date('h:i a', strtotime($time)); ?></h6>





                            <a href="img/<?php echo $row['letter']; ?>" class="btn btn-primary btn-sm" ><i class=""></i> View</a>

                            <?php if(in_array($idval,$user_status,true)) {?>
                            <a href="inbox.php?docNo=<?php echo $row['DocumentNo']; ?>" id="status"  class="btn btn-success hide btn-sm" ><i class="fas fa-check"></i> Mark as received</a>
<?php }
else{?>
  <a href="inbox.php?docNo=<?php echo $row['DocumentNo']; ?>" id="status"  class="btn btn-success btn-sm" ><i class="fas fa-check"></i> Mark as received</a>
<?php } ?>
<a href="#comment" data-toggle="modal"  class="btn btn-info btn-sm" ><i class="fas fa-comments"></i> add comments</a>

 <?php if($row['despatch']=="yes"){
   ?>
   <!-- <button type="" class="despatched" name="button">button</button> -->
   <img src="img\despatched_icon.png"class="despatched" height="50px" width="150px" alt="icon">
 <?php } ?>


         </div>

    </div>

<hr>
  </div>




          <?php
        }
      }

else {
  ?>

    <p Colspan="7" style="text-align:center; font-size:20px; margin-top:100px;"><strong>It's Empty !</strong></p>

    <?php
}
      if(isset($_GET['docNo']))
      {
        $docNo=$_GET['docNo'];

       $sql="SELECT * FROM inward WHERE DocumentNo='$docNo'";
        $result=$conn->query($sql);
        $count= mysqli_num_rows($result);

        if($result){
        while ($row = $result->fetch_assoc()) {
          $status=json_decode($row['status']);
          $array=json_decode($row['check_points']);
           $cnt=count($status);
           for($i=0;$i<$cnt;$i+=1)
           {
             if(strtolower($array[$i])==strtolower($user))
             {

               $status[$i]='yes';



             }

           }
         }
         $flag=0;
         for($i=0;$i<count($status);$i++)
         {
           if($status[$i]=="no")
           {
             $flag=1;
           }

         }
         if($flag==0)
         {
         $sql="UPDATE inward SET process='completed' WHERE DocumentNo='$docNo'";
         $res=mysqli_query($conn,$sql);
       }

          $value=json_encode($status);
          $sql="UPDATE inward SET status='$value' WHERE DocumentNo='$docNo'";
          $res=$conn->query($sql);
          // Insert into timeline table
	  date_default_timezone_set('Asia/Kolkata');
	  $datetime= date("Y:m:d G:i:s");
	  $sqlt= "INSERT INTO timeline (id,time,description) VALUES('$docNo','$datetime','Received by $user')";
	  $rest=$conn->query($sqlt);
          if($res && $rest)
          {
            $_SESSION['alert']=1;
?>
 <script>
   window.location = "inbox.php";


</script>
      <?php
          }
       }
       else {
         echo "ERROR: Hush! Sorry $result. "
             . mysqli_error($conn);
       }


      }
      unset($_POST['update_status']);

?>


</div>
</div>

<!-- add comment modal-->
<div class="modal fade" id="comment" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-body">


            <form action="" method="POST" enctype="multipart/form-data">

         <div class="form-group">
           <label for="title" class="form-control-label" style="font-weight: bold">Enter comments here</label>
          <input type="text" class="form-control"name="comments" value="" placeholder="">
          </div>
        </div>
        <div class="modal-footer">

          <button type="submit" name="submit_comment"class="btn btn-success btn-sm" >Add comment</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>

    </div>
  </div>


  <?php
  if(isset($_POST['submit_comment'])){
    $comment=$_POST['comments'];
    $docNo=$_SESSION['docNo'];
  date_default_timezone_set('Asia/Kolkata');
   $datetime= date("Y:m:d G:i:s");
   $sqlt= "INSERT INTO timeline (id,time,description) VALUES('$docNo','$datetime','$comment - comment by $user')";
   $rest=$conn->query($sqlt);

unset($_SESSION['docNo']);

include('includes/footer.php');
}
?>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
