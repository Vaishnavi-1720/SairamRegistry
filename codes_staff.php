<?php
if(isset($_GET['docNo']))
{
  $docNo=$_GET['docNo'];
  $result = mysqli_query($conn,"SELECT  `DocumentNo`, `check_points`, `status` FROM `inward` WHERE 'DocumentNo'='$docNo' ");
  $count= mysqli_num_rows($result);
  if($count!=0){
  while ($row = $result->fetch_assoc()) {
    $status=json_decode($row['status']);
    $array=json_decode($row['check_points']);
     $cnt=count($status);
     for($i=0;$i<$cnt;$i+=1)
     {
       if(strtolower($array[$i])==strtolower($user))
       {

         $status[$i]='yes';
         $docNo=$row['DocumentNo'];


       }
     }
   }
 }

  $value=json_encode($status);
  $s=json_decode($value);
  print_r($value);
  echo(gettype($value));


   $flag=0;
   for($i=0;$i<count($s);$i++)
   {
     if($s[$i]=="no")
     {
       $flag=1;
     }

   }
   if($flag==0)
   {?>
<script>
  alert("success");
</script>
<?php
   $sql="UPDATE inward SET process='completed' WHERE DocumentNo='$docNo'";
   $res=mysqli_query($conn,$sql);
   if($res)
   {

     echo"success";
   }
 }
}
unset($_POST['update_status']);

 ?>
 <?php



 if($_POST["view"] != '')
 {
     $update_query = "UPDATE inward SET notification_status = 1 WHERE notification_status=0";
     mysqli_query($con, $update_query);
 }
 $query = "SELECT `date`, `DocumentNo`, `frm`, `subject`, `category`, `letter`, `check_points`, `status`, `note` FROM `inward` WHERE  `check_points` LIKE '%$user%'";

 $result = mysqli_query($conn, $query);
 $output = '';
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
    $output .= '
    <li>
    <a href="#">
    <strong>'.$row["subject"].'</strong><br />
    <small><em>'.$row["date"].'</em></small>
    </a>
    </li>
    ';

  }
 }
 else{
      $output .= '
      <li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
 }



 $status_query = "SELECT * FROM `inward` WHERE `check_points` LIKE '%$user%' AND notification_status=0";
 $result_query = mysqli_query($con, $status_query);
 $count = mysqli_num_rows($result_query);
 $data = array(
     'notification' => $output,
     'unseen_notification'  => $count
 );

 echo json_encode($data);

 }


 ?>
