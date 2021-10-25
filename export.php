<?php
include_once("database.php");

// session_start();
// if(empty($_SESSION['loginsuccess']) ){
//     header("Location: login.php");
//     die();
// }

if(isset($_GET['from'] )&& isset($_GET['to']))
{
  $from=$_GET['from'];
  $to=$_GET['to'];
  $process=$_GET['process'];
  $from_format = strtotime($from);
    $from_date=date('d/m/Y', $from_format);
  $to_format = strtotime($to);
      $to_date=date('d/m/Y', $to_format);

  $output = '';
  if($process=="all"){
 $query = "SELECT * FROM inward WHERE date BETWEEN '$from' AND '$to'";
}
else {
  $query = "SELECT * FROM inward WHERE date BETWEEN '$from' AND '$to' AND process='$process'";
}
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
   $output.='<h3 style="align-items:center;">Inward letter report</h3>
              <pre>FROM:'.$from_date.'</pre>
              <pre>TO:'.$to_date.'</pre>';
              if($process!="all")
              {
                $output.='<pre>Process status:' .$process. '</pre>';
              }
  $output .= '
   <table border="1" align-items="center" style="width:50%;">
                    <tr>
                         <th>Date</th>
                         <th>From</th>
                         <th>DocumentNo</th>
       <th>Subject</th>
       <th>Category</th>
       <th>Notes</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tralign-items="center" >
                         <td>'.$row["date"].'</td>
                         <td>'.$row["frm"].'</td>
                         <td>'.$row["DocumentNo"].'</td>
       <td>'.$row["subject"].'</td>
       <td>'.$row["category"].'</td>
       <td>'.$row["note"].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Inwardreport.xls');

  echo $output;
 }
}

?>
