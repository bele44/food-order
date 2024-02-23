<?php  
// check authorization or access control
  if(!isset($_SESSION['user']))
  {
         $_SESSION['no-login-message']="<div class='error text-center'>Please Login To Access Admin panel.</div>";
         header('location:'.SITEURL.'admin/login.php');
  }
?>