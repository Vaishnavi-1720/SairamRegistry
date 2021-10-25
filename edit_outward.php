<?php

session_start();
if(empty($_SESSION['loginsuccess']) ){
    header("Location: login.php");
    die();
}
include("includes/header.php");
include 'includes/navbar.php';
include('includes/scripts.php');
include_once 'database.php';


 ?>
  <!-- <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>#1</h1>
        </div>
      </div>
    </div>

  </header> -->

  <?php
  $docNo=$_GET['docNo_out'];
  $sql="SELECT * FROM OUTWARd WHERE DocumentNo='$docNo'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {




   ?>


  <!-- POST EDIT -->
  <section id="edit-post">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Edit Letter</h4>
            </div>




            <div class="card-block">
              <div class="modal-body">
              <form action="codes.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                      <div class="container">
                        <div class="row">
                          <div class="col-md-3 mr-auto">
                            <a href="outward.php" class="btn btn-secondary btn-block"><i class="fa fa-arrow-left"></i> Back To Dashboard</a>
                          </div>

                          <div class="col-md-3">
                          <!--  <a href="index.html" name="edit-btn" class="btn btn-success btn-block"><i class="fa fa-check"></i> Save Changes</a>-->
                            <input type="submit" name="update_but_outward" id="update" class="btn btn-success btn-block"  value="Update changes" >
                          </div>
                          <div class="col-md-3">
                            <a href="codes.php?docNo_out=<?php echo $row['DocumentNo'];?>" id="del-btn"class="btn btn-danger btn-block"><i class="fa fa-remove"></i> Delete Post</a>
                                     </div>
                        </div>
                      </div>
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

                    <label for="title" class="form-control-label" style="font-weight: bold">Date</label>
                    <input type="Date" name="date"value="<?php echo $row['date'];?>"class="form-control">

                    <label for="title"  class="form-control-label" style="font-weight: bold">Document No</label>
                    <input type="text"  name="DocumentNo" value="<?php echo $row['DocumentNo'];?>" class="form-control">

                    <label for="title"  class="form-control-label" style="font-weight: bold">To</label>
                    <input type="text"  name="to_" value="<?php echo $row['to_'];?>" class="form-control">
                    <label for="title" class="form-control-label" style="font-weight: bold">Subject</label>
                    <input type="text" name="subject" value="<?php echo $row['subject'];?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="category" class="form-control-label" style="font-weight: bold">Category</label>
                    <select name="category" class="form-control">

                      <option value="Scholarship">Scholarship</option>
                      <option value="Circular">Circular</option>

                    </select>
                  </div>
                 <div class="form-group bg-faded p-3">
                    <label for="file" style="font-weight: bold">Upload Letter</label>
                    <input type="file" class="form-control-file" id="file">
                    <small id="fileHelp" class="form-text text-muted">
                      Max Size 3MB
                    </small>
                  </div>
                  <div class="form-group">
                    <label for="body" style="font-weight: bold">Note</label>
                    <textarea name="editor1" class="form-control"></textarea>
                  </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php
        } //while condition closing bracket
      }  //if condition closing bracket
  ?>
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

  <script>
    CKEDITOR.replace('editor1');
  </script>





</body>
</html>
