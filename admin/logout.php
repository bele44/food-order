<?php
 include('../config/constants.php');
 session_destroy();
 $_SESSION['login']="<div class='error text-center'>username or password did not match. </div>";
    header('location:'.SITEURL.'admin/login.php');
?>