<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- <script src="js/jquery.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
 <!-- <script src="js/bootstrap.min.js"></script> -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script src="js/toastr/toastr.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<?php ?>
<script src="js/sb-admin-2.min.js"></script>
<!-- <script src="js/main.js"></script> -->
<script>
  CKEDITOR.replace('editor1');
</script>
<?php
if(isset($_SESSION['status']))
{

  ?>
  <div class="flash-data" data-flashdata="<?php echo $_SESSION['status'];?>"></div>
<script>
const flashdata = $('.flash-data').data('flashdata')
if(flashdata){
    swal.fire({
    icon : 'success',
    title : 'Record saved successfully',



})
}

</script>



<?php
unset($_SESSION['status']);

} ?>
<?php
if(isset($_SESSION['change']))
{

  ?>
  <div class="flash-data" data-flashdata="<?php echo $_SESSION['change'];?>"></div>
<script>
const flashdata = $('.flash-data').data('flashdata')
if(flashdata){
    swal.fire({
    icon : 'success',
    title : 'Password changed ',



})
}

</script>



<?php
unset($_SESSION['change']);

} ?>
<?php
if(isset($_SESSION['despatch']))
{

  ?>
  <div class="flash-data" data-flashdata="<?php echo $_SESSION['despatch'];?>"></div>
<script>
const flashdata = $('.flash-data').data('flashdata')
if(flashdata){
    swal.fire({
    icon : 'success',
    title : 'Notification sent',



})
}

</script>



<?php
unset($_SESSION['despatch']);

} ?>
<?php
if(isset($_SESSION['despatch_exist']))
{

  ?>
  <div class="flash-data" data-flashdata="<?php echo $_SESSION['despatch_exist'];?>"></div>
<script>
const flashdata = $('.flash-data').data('flashdata')
if(flashdata){
    swal.fire({
    icon : 'warning',
    title : 'Already dispatched',



})
}

</script>



<?php
unset($_SESSION['despatch_exist']);

} ?>
<?php
if(isset($_SESSION['exist']))
{

  ?>
  <div class="flash-data" data-flashdata="<?php echo $_SESSION['exist'];?>"></div>
<script>
const flashdata = $('.flash-data').data('flashdata')
if(flashdata){
    swal.fire({
    icon : 'warning',
    title : 'letter already exists !',



})
}

</script>



<?php
unset($_SESSION['exist']);

} ?>




<?php
if(isset($_SESSION['m'])){ ?>
<div class="flash-data" data-flashdata="<?php echo $_SESSION['m'];?>"></div>


<script>

 const flashdata = $('.flash-data').data('flashdata')
 if(flashdata){
     swal.fire({
         icon: 'warning',
         title : 'Record Deleted',
         button: 'false',
         dangerMode:true

     })
 }
</script>
<?php
unset($_SESSION['m']);
}


?>
<?php
if(isset($_SESSION['login'])){
  ?>
  <script>


 const Toast = Swal.mixin({
   toast: true,
   position: 'top-end',
   showConfirmButton: false,
   timer: 3000,
   timerProgressBar: true,
   didOpen: (toast) => {
     toast.addEventListener('mouseenter', Swal.stopTimer)
     toast.addEventListener('mouseleave', Swal.resumeTimer)
   }
 })

 Toast.fire({
   icon: 'success',
   title: 'Signed in successfully'
 })
  </script>
<?php
unset($_SESSION['login']);
}
 ?>
