
<?php 
   include('../config/constants.php');
   $id=$_GET['id'];
   $sql="DELETE FROM tbl_admin WHERE id=$id";
   $res=mysqli_query($conn,$sql);
   if($res==true)
   {
       //echo "deleted successfuly";
       $_SESSION['delete']="<div class='success'>admin deleted successfuly</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');
   }
   else
   {
       //echo "failed";
       $_SESSION['delete']="<div class='error'>failed to delete admin.try again later.</div>";
       header('location:'.SITEURL.'admin/manage-admin.php');
   }
?>
