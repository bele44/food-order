<?php 
//echo "delete page" 
include('../config/constants.php');
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    if($image_name !=""){
        $path = "../images/food/".$image_name;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['upload']="<div class='error'>failed to remove food image.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }

    $sql="DELETE FROM tbl_food WHERE id=$id";

    $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

   if($res==true)
   {
       //echo "deleted successfuly";
       $_SESSION['delete']="<div class='success'> food deleted successfuly</div>";
       header('location:'.SITEURL.'admin/manage-food.php');
   }
   else
   {
       //echo "failed";
       $_SESSION['delete']="<div class='error'>failed to delete category.</div>";
       header('location:'.SITEURL.'admin/manage-food.php');
   }
}
else
{   
    $_SESSION['unauthorize']="<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>