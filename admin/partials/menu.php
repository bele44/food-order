<?php 
  include('../config/constants.php'); 
  include('login-check.php');
?>

<html>
   <head>
     <title>food order website - Home page</title>
     <link rel="stylesheet" href="../css/admin.css">
   </head>

   <body>
       <!-- menu section statrts -->
       <div class="menu text-center">
           <div class="wrapper">
              <ul>
                 <li><a href="index.php">Home</a></li>
                 <li><a href="manage-admin.php">admin</a></li>
                 <li><a href="manage-category.php">category</a></li>
                 <li><a href="manage-food.php">food</a></li>
                 <li><a href="manage-order.php">order</a></li>
                 <li><a href="logout.php">logout</a></li>
              </ul> 
           </div>
       </div>
       <!-- menu section ends -->