<?php
    session_start();
    unset($_SESSION["email"]);
    unset($_SESSION["pass"]);
    unset($_SESSION['loginsuccess']);
    header("Location:login.php");
?>
