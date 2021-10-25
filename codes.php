
<?php
session_start();

  include_once 'database.php';
// storing inward letter in database

if(isset($_POST['submit_but_inward']))
{ $date=$_POST['date'];
$docNo=$_POST['docNo'];
$from=$_POST['from'];
$subject=$_POST['subject'];
$category=$_POST['category'];
$note=$_POST['editor1'];
$array=array($date=>'hi');



  $file=$_FILES['Uploadfile']['name'];
  $destination = 'img/' . $file;
  $tmp=$_FILES['Uploadfile']['tmp_name'];
  move_uploaded_file($tmp, $destination);
  $sql = "INSERT INTO inward  SET date='$date',DocumentNo='$docNo',frm='$from',subject='$subject',category='$category',letter='$file',note='$note'";
  // Insert into timeline table
date_default_timezone_set('Asia/Kolkata');
$datetime= $date.date(" G:i:s");
$sqlt= "INSERT INTO timeline (id,time,description) VALUES('$docNo','$datetime','Arrived')";

if(mysqli_query($conn, $sql)){

if(mysqli_query($conn, $sqlt)){
$_SESSION['status']=1;

header('location: inward.php');
}}
else{
   $_SESSION['exist']=1;
   header('location: inward.php');

}

}
// storing outward letter in database
if(isset($_POST['submit_but_outward']))
{ $date=$_POST['date'];
$docNo=$_POST['docNo'];
$to=$_POST['to_'];
$subject=$_POST['subject'];
$category=$_POST['category'];
$note=$_POST['editor1'];

  $file=$_FILES['Uploadfile']['name'];
  $destination = 'img/' . $file;
  $tmp=$_FILES['Uploadfile']['tmp_name'];
  move_uploaded_file($tmp, $destination);
  // $sql = "INSERT INTO inward  SET date='$date',DocumentNo='$docNo',to='$To',subject='$subject',category='$category',letter='$file',note='$note'";
  $sql="INSERT INTO `outward`(`date`, `DocumentNo`, `to_`, `subject`, `category`, `letter`, `note`) VALUES ('$date','$docNo','$to','$subject','$category','$file','$note')";
  if(mysqli_query($conn, $sql)){
$_SESSION['status']=1;

header('location: outward.php');
}
else{
   echo "ERROR: Hush! Sorry $sql. "
       . mysqli_error($conn);
}

}

// Delete inward letter
if(isset($_GET['DocumentNo']) || isset($_GET['docNo']) ){

if(isset($_GET['docNo'])){
    $docNo=$_GET['docNo'];
  }


if(isset($_GET['DocumentNo'])){
    $docNo=$_GET['DocumentNo'];
  }


$sql = "DELETE FROM inward WHERE DocumentNo='$docNo'";
$result = $conn->query($sql);
$sqlt = "DELETE FROM timeline WHERE id='$docNo'";
$res = $conn->query($sqlt);
if($result && $res){
$_SESSION['m']=1;
    header('location:inward.php');
}
else {
  echo "ERROR: Hush! Sorry $sql. "
      . mysqli_error($conn);

}

}


// Delete Outward
if(isset($_GET['docNo_out'])){
    $docNo=$_GET['docNo_out'];

$sql = "DELETE FROM outward WHERE DocumentNo='$docNo'";
$result = $conn->query($sql);
if($result){
$_SESSION['m']=1;
    header('location:outward.php');
}

}
// Edit inward
if(isset($_POST['update_but_inward']))
{

  $date=$_POST['date'];
  $docNo=$_POST['DocumentNo'];
  $from=$_POST['from'];
  $subject=$_POST['subject'];
  $category=$_POST['category'];
  $note=$_POST['editor1'];

$sql = "UPDATE `inward` SET date='$date',DocumentNo='$docNo',frm='$from',subject='$subject',category='$category',note='$note' where DocumentNo='$docNo'";
$result = $conn->query($sql);
if($result){
$_SESSION['status']=1;

header('location: inward.php');
}
else{
   echo "ERROR: Hush! Sorry $sql. "
       . mysqli_error($conn);
}

}
// Edit Outward
if(isset($_POST['update_but_outward']))
{

  $date=$_POST['date'];
  $docNo=$_POST['DocumentNo'];
  $to=$_POST['to_'];
  $subject=$_POST['subject'];
  $category=$_POST['category'];
  $note=$_POST['editor1'];

$sql="UPDATE `outward` SET `date`='$date',`DocumentNo`='$docNo',`to_`='$to',`subject`='$subject',`category`='$category',`note`='$note' WHERE DocumentNo='$docNo'";
$result = $conn->query($sql);
if($result){
$_SESSION['status']=1;


header('location: outward.php');
}
else{
   echo "ERROR: Hush! Sorry $sql. "
       . mysqli_error($conn);
}

}

if(isset($_POST['changepassword']))
{


$new=$_POST['newpassword'];
$confirm=$_POST['confirmpassword'];
if($new!=$confirm)
{
  $message="loose";
}

// $sql="SELECT Password from login_user where Email='" . $_SESSION["email"] . "'";

 $sql = "UPDATE login_user SET Password='$new' where Email='" . $_SESSION["email"] . "'";
$result = $conn->query($sql);
if($result){
$_SESSION['change']=1;
header('location: profile.php');
}
else{
   echo "ERROR: Hush! Sorry $sql. "
       . mysqli_error($conn);
}

}







if(isset($_POST["category_name"]))
{
	$cat_name=$_POST["category_name"];
	$sql = "INSERT INTO category SET category_name='$cat_name'";
	mysqli_query($conn, $sql);

	$category_name = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $_POST["category_name"]);

	$data = array(
		':category_name'	=>	$category_name
	);

	$query = "
	SELECT * FROM category
	WHERE category_name = :category_name
	";

	$statement = $conn->prepare($query);

	$statement->execute($data);

	if($statement->rowCount() == 0)
	{
		$query = "
		INSERT INTO category
		(category_name)
		VALUES (:category_name)
		";

		$statement = $conn->prepare($query);

		$statement->execute($data);

		echo 'yes';
	}
}










?>
