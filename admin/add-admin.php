<?php include('partials/menu.php'); ?>

  <div class="main-content">
      <div class=wrapper>
          <h1>Add Admin</h1>
          <br><br>
          <?php 
                 if(isset($_SESSION['add']))
                 {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                 }
               ?>
          <form action="" method="POST">
              <br>
             <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name=full_name placeholder="Enter your Name"></td>
                    
                </tr>
                <tr>
                    <td>username:</td>
                    <td><input type="text" name=username placeholder="your username"></td>
                    
                </tr>
                <tr>
                    <td>password:</td>
                    <td><input type="password" name=password placeholder="your password"></td>

                </tr>
                <tr>
                    <td colspan="2">
                         <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                    
                </tr>
             </table>

          </form>


      </div>
  </div>

<?php include('partials/footer.php'); ?>

<?php 
 //process the value from form and save it in database

//check wether the submit button is clicked or not
if(isset($_POST['submit']))
{
   //1. echo"button clicked";
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   $password=md5($_POST['password']);

   //2.sql query to save the data into database
   $sql="INSERT INTO tbl_admin set 
   full_name='$full_name',
   username='$username',
   password='$password'
   ";
   // excuting query and saving data in database
   $res=mysqli_query($conn,$sql) or die(mysqli_error());
   //check wether the(query is excuted ) data is inserted or not and display appropriate message
   if($res==TRUE)
   {
      // echo "inserted";
      //session variable to display message
      $_SESSION['add']="admin added successfully";
      //redirect page to manage admin
      header("location:".'http://localhost/food-order/admin/manage-admin.php');
   }
   else
   {
       //echo"failed data insert";
       //session variable to display message
      $_SESSION['add']="failed to add admin";
      //redirect page to manage admin
      header("location:".'http://localhost/food-order/admin/add-admin.php');
   }
}
?>