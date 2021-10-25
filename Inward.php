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
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->



  <header id="main-header" class="py-2 bg-primary text-white">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</style>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1><i class="fas fa-pencil" style="color:red;"></i> Inward</h1>

        </div>
      </div>
    </div>
  </header>
  <!-- AddInward letter modal-->
    <div class="modal fade" id="addPostModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="addPostModalLabel" style="font-size:25px;">Add Inward letter</h5>
            <button class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="codes.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title" class="form-control-label" style="font-weight: bold">Date</label>
                <input type="Date" name="date" class="form-control" required>
                <label for="title" class="form-control-label" style="font-weight: bold">Document No</label>

                <input type="text" name="docNo" class="form-control" required>
                <p style="font-size:20px; color:red;"><?php if(isset($_SESSION['exist'])){ echo "DocumentNo already exists !"; unset($_SESSION['exist']);} ?></p>
                <label for="title" class="form-control-label" style="font-weight: bold">From</label>
                <input type="text" name="from" class="form-control" required>
                <label for="title" class="form-control-label" style="font-weight: bold">Subject</label>
                <input type="text" name="subject" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="category" class="form-control-label" style="font-weight: bold">Category</label>
                <!-- <select  name="category"class="form-control" required>
                  <option value="Scholarship">Scholarship</option>
                  <option value="Circular">Circular</option>

                </select> -->
                <select name="category" id="category" class="form-control form-control-lg select2">
                  <?php
                  $query = "
                    SELECT * FROM category
                  ORDER BY category_name ASC
                  ";
                  $result = $conn->query($query);
                  foreach($result as $row)
                  {
                    echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
                  }
                  ?>
                </select>

              </div>
            <div class="form-group bg-faded p-3">
                <label for="file" style="font-weight: bold">Upload Letter</label>
                <input type="file" name="Uploadfile"  class="form-control-file" required >
                <small id="fileHelp" class="form-text text-muted">
                  Max Size 3MB
                </small>
              </div>

              <div class="form-group">
                <label for="body" style="font-weight: bold">Note</label>
                <textarea name="editor1" class="form-control"></textarea>
              </div>


          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Close</button>
              <!--<button class="btn btn-primary" data-dismiss="modal">Add Letter</button>-->
                <input type="submit" name="submit_but_inward" id="submit" class="btn btn-primary" value="Add Letter">
          </div>
          </div>
        </form>
        </div>
      </div>

      <script>

      $(document).ready(function(){

        $('.select2').select2({
          placeholder:'Select Category',
          theme:'bootstrap4',
          tags:true,
        }).on('select2:close', function(){
          var element = $(this);
          var new_category = $.trim(element.val());

          if(new_category != '')
          {
            $.ajax({
              url:"codes.php",
              method:"POST",
              data:{category_name:new_category},
              success:function(data)
              {
                if(data == 'yes')
                {
                  element.append('<option value="'+new_category+'">'+new_category+'</option>').val(new_category);
                }
              }
            })
          }

        });

      });

      </script>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-faded" style="height:50px">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="#" class="btn btn-primary btn-block " data-toggle="modal" data-target="#addPostModal"><i class="fa fa-plus"></i> Add Inward   </a>

        </div>

       <div class="col-md-3">

       </div>
       <div class="col-md-1">

       </div>
       <div >
         <button onClick="window.location.href=window.location.href" class="btn btn-primary "><i class="fas fa-sync-alt"></i> </button>


       </div>
        <div class="col-md-3">
          <form action="" method="POST" enctype="multipart/form-data">
          <div class="input-group">



            <input type="text" name="filter" class="form-control" placeholder="Search data">

            <button type="submit" name="search" class="btn btn-primary" value="search"><i class="fas fa-search"></i></button>

        </div>
        </form>
      </div>
    </div>
  </section>

<!--Table content-->

    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header" style="height:50">


                <div class="row">
                  <h4>#Latest Post</h4>

                  <div class="col-md-3" style="justify-content:center;">
                      <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">

          <select name="process"  class="form-control">
        <option value="all"  selected  >All</option>
        <option value="pending" <?php echo (isset($_POST['tablefilter']) && $_POST['process']=="pending") ? "selected" : '' ?>>Pending</option>
        <option value="completed" <?php echo (isset($_POST['tablefilter']) && $_POST['process']=="completed") ? "selected" : '' ?> >Completed</option>

            </select>

                    </div>
                  </div>


                 <div class="col-md-3">
                   <div class="form-group">

                     <input type="date" name="from_date" class="form-control" value="<?php echo isset($_POST['tablefilter']) ? $_POST['from_date'] : '' ?>" placeholder="mm/dd/yy"required>
                   </div>
                 </div>
                 <div class="col-md-3">
                   <div class="form-group">

                    <input type="date" name="to_date" class="form-control"value="<?php echo isset($_POST['tablefilter']) ? $_POST['to_date'] : '' ?>" placeholder="mm/dd/yy" required>
                   </div>
                 </div>
                 <div class="col-md-1">
                   <div class="form-group">

                    <button type="submit" class="btn btn-primary" name="tablefilter">Filter</button>

                   </div>

                 </div>
</form>

</div>

              </div>
            </div>
            <?php

             ?>

            <div class="table-responsive">


            <table class="table table-bordered table-hover"  cellspacing=0 >
              <col width="5%">
       	     <col width="10%">
              <col width="10%">
       	     <col width="10%">
               <col width="20%">
                 <col width="10%">
       	     <col width="30%">

              <thead class="thead-inverse" >
                <tr>
                  <th style="line-height:8px; font-size:13px; " >S.NO</th>
                  <th  style="line-height:8px; font-size:13px; " >Date</th>
                  <th style="line-height:8px; font-size:13px; ">DocumentNo</th>
                  <th style="line-height:8px; font-size:13px; ">From</th>
                  <th style="line-height:8px; font-size:13px; ">Subject</th>
                  <th style="line-height:8px; font-size:13px; ">Category</th>
                  <th style="line-height:8px; font-size:13px; ">Actions</th>



                </tr>
              </thead>
              <!-- Search filter-->
              <?php

              if(isset($_POST['search']) || isset($_POST['tablefilter']) )
              {
                if (isset($_GET['page_no']) && $_GET['page_no']!=""){

                        $page_no = $_GET['page_no'];
                }
                else {
                        $page_no = 1;
                 }

               $total_records_per_page = 10;
               $offset = ($page_no-1) * $total_records_per_page;
               $previous_page = $page_no - 1;
               $next_page = $page_no + 1;
               $adjacents = "2";
                   if(isset($_POST['search'])){
                   $value=$_POST['filter'];
                   $result_count = $conn->query("SELECT count(*) AS total_records from inward WHERE CONCAT(DocumentNo,frm,subject,category) LIKE '%$value%' ");
                 }
                 else {
                   $from=$_POST['from_date'];
                   $to=$_POST['to_date'];
                   $process=$_POST['process'];
                   if($process=='all'){
                   $result_count=$conn->query("SELECT count(*) AS total_records from inward WHERE date BETWEEN '$from' AND '$to'");
                 }
                  else {
                    $result_count=$conn->query("SELECT count(*) AS total_records from inward WHERE date BETWEEN '$from' AND '$to' AND process='$process'");

                  }

                 }

                 $total_records = mysqli_fetch_array($result_count);
                 $total_records = $total_records['total_records'];
                 $total_no_of_pages = ceil($total_records / $total_records_per_page);
                 $second_last = $total_no_of_pages - 1;

                  if(isset($_POST['search'])){
                   $sql = "SELECT * from inward WHERE CONCAT(DocumentNo,frm,subject,category) LIKE '%$value%' ORDER BY date DESC LIMIT $offset, $total_records_per_page ";
            }
            else {
              if($process=='all'){
              $sql="SELECT * from inward WHERE date BETWEEN '$from' AND '$to' LIMIT $offset, $total_records_per_page ";
            }
            else {
               $sql="SELECT * from inward WHERE date BETWEEN '$from' AND '$to' AND process='$process' LIMIT $offset, $total_records_per_page ";

             }
            }

                $result=$conn->query($sql);
                if ($result->num_rows > 0) {
                  // output data of each row
                  $counter=$offset;
                  while($row = $result->fetch_assoc()) {

                ?>
                <tbody>
                  <tr >
                    <td  style="padding:1px;" ><?php echo ++$counter ?>   </td>
                    <td  style="padding:1px;" scope="row"><?php $LogintDate = strtotime($row['date']);
                       echo date('d/m/Y', $LogintDate);?></td>
                    <td  style="padding:1px;"><?php echo $row['DocumentNo'];?>  </td>
                    <td  style="padding:1px;"><?php echo $row['frm'];?></td>
                    <td  style="padding:1px;"><?php echo $row['subject'];?></td>
                    <td  style="padding:1px;"><?php echo $row['category'];?></td>



                    <td style="padding:1px;">    <a href="dropdown.php?docNo=<?php echo $row['DocumentNo'];?>" title="Add recipients"class="btn btn-dark btn-sm"><i class="fa fa-users" aria-hidden="true"></i></a>
                  <a href="img/<?php echo $row['letter']; ?>" title="View letter" class="btn btn-primary btn-sm" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                  <a href="edit.php?docNo=<?php echo $row['DocumentNo'];?>" title="Edit letter"  class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                  <a href="codes.php?docNo=<?php echo $row['DocumentNo'];?>" id="del-btn" title="Delete Letter" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> </a>
<a href="timeline.php?docNo=<?php echo $row['DocumentNo'];?>" id="tim-btn" title="Timeline" class="btn btn-primary btn-sm"><i class="fas fa-history"></i> </a>
<?php if ($row['check_points']!=''): ?>
<a href="track.php?docNo=<?php echo $row['DocumentNo'];?>" class="btn btn-warning btn-sm"><i class="fa fa-angle-double-right" style="color:white"></i> Track</a>
<?php endif; ?>
<?php

if($row['process']=='pending')
{?>
  <span class="badge badge-pill badge-danger" style="font-size:13px;"> pending </span>
  <?php
}
else {
?>
<span class="badge badge-pill badge-success" style="font-size:13px;">completed</span>

<?php
}

?>
</td>                  </tr>
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
      }  //  end of else
      } //  end of main if
// <!-- if no search filter is set fetch all values from table-->
       else{
               // for pagination purpose
               if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                    $page_no = $_GET['page_no'];
                }
                else {
                    $page_no = 1;
                    }

              $total_records_per_page = 10;
              $offset = ($page_no-1) * $total_records_per_page;
              $previous_page = $page_no - 1;
              $next_page = $page_no + 1;
              $adjacents = "2";

              $result_count = $conn->query(
                       "SELECT COUNT(*) As total_records FROM `inward`"
              );
              $total_records = mysqli_fetch_array($result_count);
              $total_records = $total_records['total_records'];
              $total_no_of_pages = ceil($total_records / $total_records_per_page);
              $second_last = $total_no_of_pages - 1; // total pages minus 1

              $sql = "SELECT * FROM inward ORDER BY date DESC LIMIT $offset, $total_records_per_page ";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
                $counter=$offset;
                while($row = $result->fetch_assoc()) {


              ?>
              <tbody>
                <tr>
                  <td style="padding:1px;"><?php echo ++$counter ?></td>
                  <td style="padding:1px;" scope="row"><?php $LogintDate = strtotime($row['date']);
                                   echo date('d/m/Y', $LogintDate);?></td>
                  <td style="padding:1px;"><?php echo $row['DocumentNo'];?></td>
                  <td style="padding:1px;"><?php echo $row['frm'];?></td>
                  <td style="padding:1px;"><?php echo $row['subject'];?></td>
                  <td style="padding:1px;"><?php echo $row['category'];?></td>



                  <td style="padding:1px;">
                  <a href="dropdown.php?docNo=<?php echo $row['DocumentNo'];?>" title="Add recipients" class="btn btn-dark btn-sm"><i class="fa fa-users" aria-hidden="true"></i> </a>
                  <a href="img/<?php echo $row['letter']; ?>" title="View letter" class="btn btn-primary btn-sm" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                  <a href="edit.php?docNo=<?php echo $row['DocumentNo'];?>" title="Edit letter" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                  <a href="codes.php?docNo=<?php echo $row['DocumentNo'];?>" id="del-btn" title="Delete Letter" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> </a>
                  <a href="timeline.php?docNo=<?php echo $row['DocumentNo'];?>" id="tim-btn" title="Timeline" class="btn btn-primary btn-sm"><i class="fas fa-history"></i> </a>
                  <?php if ($row['check_points']!=''): ?>
                <a href="track_status.php?docNo=<?php echo $row['DocumentNo'];?>" class="btn btn-warning btn-sm"><i class="fa fa-angle-double-right" style="color:white"></i> Track</a>
<?php

if($row['process']=='pending')
{?>
  <span class="badge badge-pill badge-danger" style="font-size:13px;"> pending </span>
  <?php
}
else {
?>
<span class="badge badge-pill badge-success" style="font-size:13px;">completed</span>

<?php
}
endif;
?>

                  </td>

                  </tr>

                  </tbody>
                <?php
                      } //while condition closing bracket
                    }
                    else {
                      ?>
                      <tr>
                        <td Colspan="7" style="text-align:center;"><strong>No Record Found !</strong></td>
                      </tr>

                      <?php
                    }
                  }  //if condition closing bracket
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
          <script>
          $('#del-btn').on('click',function(e){
              e.preventDefault();
          const href = $(this).attr('href')
              Swal.fire({
                  title: 'Are you sure to delete?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                      if (result.value) {
                          document.location.href = href;

                      }
                  })
           })

          </script>

          </div>
        </div>
      <!-- </div>
    </div> -->

  <script>
    CKEDITOR.replace('editor1');
  </script>

</body>
