 <?php

 session_start();
 if(empty($_SESSION['loginsuccess']) ){
     header("Location: login.php");
     die();
 }
include('includes/header.php');
include('includes/navbar.php');
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>GTCoding</title>
    <link rel="stylesheet" href="css/addpointsstyle.css" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Orelega+One&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 </head>
  <body>


    <h2>Create check points</h2>

    <div class="container">


      <div class="select-box">
        <div class="options-container" >



          <div class="option" onclick="closetext('CEO')">
            <input
              type="radio"
              class="radio"
              id="automobiles"
              name="category"
            />
            <label for="automobiles">CEO</label>
          </div>

          <div class="option" onclick="closetext('Principal')">
            <input type="radio" class="radio" id="film" name="category" />
            <label for="film">Principal</label>
          </div>

          <div class="option" onclick="closetext('HOD-IT')">
            <input type="radio" class="radio" id="science" name="category" />
            <label for="science">HOD-IT</label>
          </div>

          <div class="option" onclick="closetext('HOD-CIVIL')">
            <input type="radio" class="radio" id="art" name="category" />
            <label for="art">HOD-CIVIL</label>
          </div>

          <div class="option" onclick="closetext('HOD-MECH')">
            <input type="radio" class="radio" id="music" name="category" />
            <label for="music">HOD-MECH</label>
          </div>

          <div class="option" onclick="closetext('HOD-CSE')">
            <input type="radio" class="radio" id="travel" name="category" />
            <label for="travel">HOD-CSE</label>
          </div>

          <div class="option" onclick="closetext('HOD-EEE')">
            <input type="radio" class="radio" id="sports" name="category" />
            <label for="sports">HOD-EEE</label>
          </div>

          <div class="option" onclick="closetext('HOD-ECE')">
            <input type="radio" class="radio" id="news" name="category" />
            <label for="news">HOD-ECE</label>
          </div>

          <div class="option" onclick="closetext('HOD-PROD')">
            <input type="radio" class="radio" id="tutorials" name="category" />
            <label for="tutorials">HOD-PROD</label>
          </div>
          <div class="option" onclick='CheckColors()'>
            <input type="radio" class="radio" id="others" value="others" name="category" />
            <label for="others">others</label>
          </div>

        </div>

        <div class="selected">
          Select recipient
        </div>

      </div>
      <input type="text" placeholder="Type here...." name="color" id="color" style="display:none;" />
      <button  class="btn-xs"  id="btn" name="button" onclick="l()">Add</button>
    </div>


<br><br>
<div class="container1" id="c">
      <ul class="progressbar">

        <li  id="b1">Step 1</li>
        <li id="b2">Step 2</li>
        <li id="b3">Step 3</li>
       	<li  id="b4">Step 1</li>
         <li id="b5">Step 2</li>
        <li id="b6">Step 3</li>
      </ul>
    </div>

<br>

<?php
if(isset($_GET['docNo']))
{
$doc_No=$_GET['docNo'];
}

 ?>

 <button id="php-submit" class="button" style="vertical-align:middle" onclick="ar('<?php echo $doc_No ?>')" ><span>Create </span></button>
   <script src="js/main.js"></script>
   <?php
   include('includes/scripts.php');
   // include('includes/footer.php');

   ?>

  </body>
</html>
