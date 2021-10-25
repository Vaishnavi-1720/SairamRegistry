<?php
    $url='localhost';
    $username='root';
    $password='';
    $dbname="admin";
    $conn=mysqli_connect($url,$username,$password,$dbname);
    if(!$conn){
        die('Could not Connect My Sql:' .mysql_error());
    }
?>
