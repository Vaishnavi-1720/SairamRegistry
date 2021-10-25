
<?php

session_start();
if(empty($_SESSION['loginsuccess']) ){
    header("Location: login.php");
    die();
}
include_once("database.php");
if(isset($_POST['data']) ){

$value=$_POST['data'];
$docNo=$_POST['docNo'];
$status=$_POST['str'];
$sql="SELECT  check_points,status FROM `inward` WHERE DocumentNo='$docNo'";
$res=$conn->query($sql);
$row = mysqli_num_rows($res);
if ($row>0) {

while($row = $res->fetch_assoc()) {
$array=json_decode($row['check_points']);
$status1=json_decode($row['status']);
}
$value=json_decode($value);
$status=json_decode($status);
$new_array=array_merge($value,$array);
$new_array=array_unique($new_array);
$new_status=array_merge($status,$status1);
$count=count($new_array);
$cnt=count($new_status);
while($cnt!=$count)
{
  array_pop($new_status);
  $cnt=$cnt-1;
}
$value=json_encode(array_values($new_array));
$status=json_encode($new_status);
}




$sql="UPDATE `inward` SET `check_points`='$value',status='$status' WHERE `DocumentNo`='$docNo'";


if(mysqli_query($conn, $sql)){
echo($status);
}
else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn);

}
}


 if(isset($_POST['value']))
 { $docNo=$_POST['docNo'];
   $value=$_POST['value'];
   $sql="SELECT  check_points,status FROM `inward` WHERE DocumentNo='$docNo'";
   $res=$conn->query($sql);

  if ($res->num_rows>0) {

 while($row = $res->fetch_assoc()) {
   $array=json_decode($row['check_points']);
   $status=json_decode($row['status']);
 $cnt=count($array);
 $val=$array;
 $cnt=count($val);
}
}
 for($i=0;$i<$cnt;$i+=1)
 {
   if($val[$i]==$value)
   {
     $index=$i;
   }
 }
 unset($val[$index]);
 array_pop($status);
 $status=json_encode(array_values($status));
 $array=json_encode(array_values($val));


 $sql="UPDATE `inward` SET `check_points`='$array',status='$status' WHERE `DocumentNo`='$docNo'";

 if(mysqli_query($conn, $sql)){
 echo($status);
 }
 else{
    echo "ERROR: Hush! Sorry $sql. "
        . mysqli_error($conn);
 }
 }



// $value=json_decode($_POST['data']);
 ?>
