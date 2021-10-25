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
$message="";
 ?>

<div class="col-md-6 offset-md-3">
                    <span class="anchor" id="formChangePassword"></span>
                    <hr class="mb-5">

                    <!-- form card change password -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" action="codes.php"  method="post" role="form" autocomplete="off">
                              
                                <div class="form-group">
                                    <label for="inputPasswordNew">New Password</label>
                                    <input type="password" class="form-control" name="newpassword"id="inputPasswordNew" required="">
                                    <span class="form-text small text-muted">
                                            The password must be 8-20 characters, and must <em>not</em> contain spaces.
                                        </span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNew">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirmpassword"id="inputPasswordNew" required="">
                                    <span class="form-text small text-muted">
                                            Re-enter the password
                                        </span>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="changepassword" class="btn btn-success btn-lg float-right">Change</button>
                                </div>
                                <div style="color:red ; align:center;" class="message"><?php if($message!="") { echo $message; } ?></div>

                            </form>
                        </div>
                    </div>
