<?php
include('database.php');
session_start();
if(empty($_SESSION['loginsuccess']) ){
    header("Location: login.php");
    die();
}
include('includes/header.php');
include('includes/navbar.php');


 ?>
<html lang="en">
<head>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link rel="stylesheet" href="css/bootstrap3.3.6.css">
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">


<style media="screen">
  .table
  {
    background-color: #f5f5f5;
  }
  .sidebar .nav-item .nav-link{
  display: block;
  width: 100%;
  text-align: left;
  padding: 1rem;
  width: 14rem;
}
</style>
</head>
<body>
  <?php
  if(isset($_GET['docNo']))
  {
  $doc_No=$_GET['docNo'];
  }

   ?>

<div class="container">
  <div class="col-md-2 mr-auto">
    <a href="inward.php" class="btn btn-secondary btn-block"><i class="fas fa-arrow-left"></i> Go Back </a>
  </div>
  <div class="col-md-2 mr-auto">
      </div>
    <select id="multiple-checkboxes" multiple="multiple">
      <?php
      $query = "
        SELECT name FROM staff_login
      ORDER BY name ASC
      ";
      $result = $conn->query($query);
      foreach($result as $row)
      {
        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
      }
      ?>
    </select>

    <button id="php-submit" class="btn btn-primary" style="vertical-align:middle" onclick="ar('<?php echo $doc_No ?>')" ><span>Add </span></button>

</div>


<div class="table-responsive">


<table class="table"  cellspacing=0 >
  <div >

  </div>
  <thead class="thead-inverse" >
    <tr>
      <th>#</th>
      <th>Recipients</th>
      <th>Action</th>
    </tr>
  </thead>
  <?php
  $sql="SELECT  check_points,status FROM `inward` WHERE DocumentNo='$doc_No'";
  $res=$conn->query($sql);

 if ($res->num_rows>0) {

while($row = $res->fetch_assoc()) {
  $array=json_decode($row['check_points']);
  $stat=json_decode($row['status']);
$cnt=count($array);
}
 $counter=0;
 for($i=0;$i<$cnt;$i+=1)
 {

?>
<tbody>
 <tr>
   <td ><?php echo ++$counter ?>   </td>
   <td><?php echo $array[$i];?>  </td>
   <td><button type="button" onclick="del('<?php echo($array[$i]); ?>','<?php echo $doc_No ?>')"class="btn btn-danger"><i class="fas fa-times-circle"></i</a>
</td>

</tr>
</tbody>

   <?php

 }  //  end of while condition
}

?>
   </table>
 </div>
<script type="text/javascript">
$('#multiple-checkboxes').on('change', function() {
var values = [];
var $selectedOptions = $(this).find('option:selected');
$selectedOptions.each(function(){
    values.push($(this).text());
});
str_json = JSON.stringify(values);
var status=[];
for(var i=0;i<values.length;i+=1)
{
status[i]="no";
}
str=JSON.stringify(status);
console.log(str);
console.log(str_json);
// do whatever you want with 'values'

});

function add(){

  $.ajax({
    method: "POST",
     url: "readjson.php",
    datatype: JSON,
    data:  {points:str_json,
            status:str },
   success: function(data){

   }
    });

  }
function del(val,doc){
var values=val;
var docNo=doc;
  $.ajax({
    method: "POST",
     url: "readjson.php",
    data:  {value:values,
            docNo:docNo
             },
   success: function(data){
  window.location.reload(true);

   }
    });

  }


function ar(val){
  var doc=val;
  $.ajax({
    method: "POST",
     url: "readjson.php",
    data:  {data:str_json,
           docNo:doc,
            str:str },

    success: function(data){
    if(data)
    {
      window.location.reload(true);

    }

    }
  });
}



$(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
         includeSelectAllOption: true,
          nonSelectedText: 'Select persons',
          buttonWidth: 250,
          enableFiltering: true
             });
          });

    </script>
<script src="js/sb-admin-2.min.js"></script>

</body>
</html>
