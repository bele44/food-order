<?php include('../config/constants.php'); ?>
<html>
  <head>
     <title>Login-Food Order System</title>
     <link rel="stylesheet" href="../css/admin.css">
  </head>
  <body>
      <div class="login">
          <h1 class="text-center">Login</h1>
          <br><br>
          <?php
             
                if(isset($_SESSION['login']))
                {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
                }
            
                if(isset($_SESSION['no-login-message']))
                {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
                }
           ?>
           <br><br>
          <form action="" method="post" class="text-center">
                username: <br>
               <td><input type="text" name=username placeholder="Enter username"></td><br><br>
                password: <br>
                <td><input type="password" name=password placeholder="Enter password"></td><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
             <br><br>
          </form>
          
         <p class="text-center">created by-<a href="www.belehagos.com">Bele hagos</a></p>
      </div>
  </body>
</html>
<?php
if(isset($_POST['submit']))
{
    $username=mysqli_real_escape_string($conn, $_POST['username']);
   $password=mysqli_real_escape_string($conn, md5($_POST['password']));
   $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
   $res=mysqli_query($conn,$sql);
   
          
 $count=mysqli_num_rows($res);
   if($count==1)
   {
    $_SESSION['login']="<div class='success'>Login successfully. </div>";
    header('location:'.SITEURL.'admin/');
    $_SESSION['user']=$username;
   }
   else
   {
    $_SESSION['login']="<div class='error text-center'>username or password did not match. </div>";
    header('location:'.SITEURL.'admin/login.php');
   }
          
}
?>