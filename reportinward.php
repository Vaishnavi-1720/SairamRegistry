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
 <div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">

     <!-- <a href="export.php?content="yes"" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
   </div>
   <div class="row">
     <div class="col">
       <form  action="" method="POST">
        <button type="submit" class="btn btn-primary btn-sm"  name="export"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</button>

       <div class="card">

         <div class="card-header" >




              <div class="row">

               <div class="col-sm-3">
                 <div class="form-group">

                   <input type="date" name="from_date" class="form-control" value="<?php echo isset($_POST['filter']) ? $_POST['from_date'] : '' ?>" placeholder="mm/dd/yy"required>
                 </div>
               </div>
               <div class="col-sm-3">
                 <div class="form-group">

                  <input type="date" name="to_date" class="form-control"value="<?php echo isset($_POST['filter']) ? $_POST['to_date'] : '' ?>" placeholder="mm/dd/yy" required>
                 </div>
               </div>

               <div class="form-group">

     <select name="process"  class="form-control">
   <option value="all"  selected  >All</option>
   <option value="pending" <?php echo (isset($_POST['filter']) && $_POST['process']=="pending") ? "selected" : '' ?>>Pending</option>
   <option value="completed" <?php echo (isset($_POST['filter']) && $_POST['process']=="completed") ? "selected" : '' ?> >Completed</option>

       </select>

               </div>
               <div class="col-md-1">
                 <div class="form-group">

                  <button type="submit" class="btn btn-primary" name="filter">Filter</button>

                 </div>

               </div>


             </div>

           </form>

           </div>
         </div>
         <?php

          // ob_end_flush();


         if(isset($_POST['export'] ))
         {
           $from=$_POST['from_date'];
           $to=$_POST['to_date'];
           $process=$_POST['process'];
          // header('Location:export.php?from=%from');
          header('location: export.php?from=' . urlencode($from) . '&to=' . urlencode($to) . '&process=' . urlencode($process));

         }

         ?>

         <?php
                     if(isset($_POST['filter']))
                     {
                         ?>
         <div class="table-responsive">
         <table class="table table-bordered"  cellspacing=0 >
           <col width="10">
          <col width="10">
           <col width="10">
          <col width="20%">
            <col width="20%">
              <col width="30%">
          <col width="10">

           <thead class="thead-inverse" >
             <tr>
               <th>S.NO</th>
               <th>Date</th>
               <th>DocumentNo</th>
               <th>from</th>
               <th>Subject</th>
               <th>Category</th>
               <th>notes</th>


             </tr>
           </thead>
           <!-- Search filter-->
           <?php

             if (isset($_GET['page_no']) && $_GET['page_no']!=""){

                     $page_no = $_GET['page_no'];
             }
             else {
                     $page_no = 1;
              }

            $total_records_per_page = 4;
            $offset = ($page_no-1) * $total_records_per_page;
            $previous_page = $page_no - 1;
            $next_page = $page_no + 1;
            $adjacents = "2";

                $from=  $_POST['from_date'];
                $to=$_POST['to_date'];
                $process=$_POST['process'];
                if($process=='all'){
                $result_count=$conn->query("SELECT count(*) AS total_records from inward WHERE date BETWEEN '$from' AND '$to'");
              }
               else {
                 $result_count=$conn->query("SELECT count(*) AS total_records from inward WHERE date BETWEEN '$from' AND '$to' AND process='$process'");

               }
              $total_records = mysqli_fetch_array($result_count);
              $total_records = $total_records['total_records'];
              $total_no_of_pages = ceil($total_records / $total_records_per_page);
              $second_last = $total_no_of_pages - 1;

              if($process=='all'){
              $sql="SELECT * from inward WHERE date BETWEEN '$from' AND '$to' LIMIT $offset, $total_records_per_page ";
            }
            else {
               $sql="SELECT * from inward WHERE date BETWEEN '$from' AND '$to' AND process='$process' LIMIT $offset, $total_records_per_page ";

             }
             $result=$conn->query($sql);
             if ($result->num_rows > 0) {
               // output data of each row
               $counter=$offset;
               while($row = $result->fetch_assoc()) {

             ?>
             <tbody>
               <tr>
                 <td ><?php echo ++$counter ?>   </td>
                 <td scope="row"><?php $LogintDate = strtotime($row['date']);
                    echo date('d/m/Y', $LogintDate);?></td>
                 <td><?php echo $row['DocumentNo'];?>  </td>
                 <td><?php echo $row['frm'];?></td>
                 <td><?php echo $row['subject'];?></td>
                 <td><?php echo $row['category'];?></td>
                 <td><?php echo $row['note'];?></td>
                 <td><a href="img/<?php echo $row['letter']; ?>" class="btn btn-primary btn-sm" ><i class=""></i> View</a></td>
                 </tr>
                 </tbody>
         <?php
     unset($_POST['filter']);
 }  //  end of while condition
}
else {
  ?>
  <tr>
    <td Colspan="7" style="text-align:center;"><strong>No Record Found !</strong></td>
  </tr>

  <?php
}

?>

            </table>

              </div>
              <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
             <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
              </div>

              <ul class="pagination">

              <?php if($page_no > 1){
              echo "<li><a class='page-link' href='?page_no=1'>First</a></li>";
              } ?>

              <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
              <a class="page-link"<?php if($page_no > 1){
              echo "href='?page_no=$previous_page'";
              } ?>>Previous</a>
              </li>
              <?php
              if ($total_no_of_pages <= 10){
               for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
               if ($counter == $page_no) {
               echo "<li class='page-link' class='active'><a>$counter</a></li>";
                       }else{
                      echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                              }
                      }
              }
              elseif ($total_no_of_pages > 10){
              // Here we will add further conditions
              if($page_no <= 4) {
               for ($counter = 1; $counter < 8; $counter++){
               if ($counter == $page_no) {
                  echo "<li class='page-link' class='active'><a>$counter</a></li>";
               }else{
                         echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                              }
              }
              echo "<li><a class='page-link'> ...</a></li>";
              echo "<li><a class='page-link' href='?page_no=$second_last'>$second_last</a></li>";
              echo "<li><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
              }
              elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
              echo "<li><a class='page-link' href='?page_no=1'>1</a></li>";
              echo "<li><a class='page-link' href='?page_no=2'>2</a></li>";
              echo "<li><a> class='page-link'...</a></li>";
              for (
                   $counter = $page_no - $adjacents;
                   $counter <= $page_no + $adjacents;
                   $counter++
                   ) {
                   if ($counter == $page_no) {
               echo "<li class='page-link' class='active'><a>$counter</a></li>";
               }else{
                      echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                     }
              echo "<li><a class='page-link'> ...</a></li>";
              echo "<li><a class='page-link ' href='?page_no=$second_last'>$second_last</a></li>";
              echo "<li><a class='page-link' href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
              }
              else {
              echo "<li><a class='page-link' href='?page_no=1'>1</a></li>";
              echo "<li><a class='page-link' href='?page_no=2'>2</a></li>";
              echo "<li><a class='page-link'>...</a></li>";
              for (
                   $counter = $total_no_of_pages - 6;
                   $counter <= $total_no_of_pages;
                   $counter++
                   ) {
                   if ($counter == $page_no) {
               echo "<li class='page-link' class='active'><a>$counter</a></li>";
               }else{
                      echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
               }
                   }
              }
              }
              ?>



              <li <?php if($page_no >= $total_no_of_pages){
              echo "class='disabled'";
              } ?>>
              <a class="page-link" <?php if($page_no < $total_no_of_pages) {
              echo "href='?page_no=$next_page'";
              } ?>>Next</a>
              </li>

              <?php if($page_no < $total_no_of_pages){
              echo "<li><a class='page-link' href='?page_no=$total_no_of_pages'>&nbspLast &rsaquo;&rsaquo;</a></li>";
              } ?>
              </ul>
            <?php } ?>
            </div>
          </div>
        </div>



    <script>
      CKEDITOR.replace('editor1');
    </script>



    <?php
    include('includes/scripts.php');
     include('includes/footer.php');

    ?>
