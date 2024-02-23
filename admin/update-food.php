<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
      <h1>Update Food</h1>

      <br><br>
      <?php 
                
                if(isset($_GET['id']))
                {    
                     $id=$_GET['id'];
                     $sql2="SELECT * FROM tbl_food WHERE id=$id";
                     $res2=mysqli_query($conn,$sql2);
        
        
                    $count2=mysqli_num_rows($res2);
                    if($count2==1)
                      {
                        //echo "available";
                         $row2=mysqli_fetch_assoc($res2);
                         $title=$row2['title'];
                         $description=$row2['description'];
                         $price=$row2['price'];
                        $current_image=$row2['image_name'];
                        $current_category=$row2['category_id'];
                        $featured=$row2['featured'];
                        $active=$row2['active'];
                       }
                   else
                     {
                      $_SESSION['no-food-found']="<div class='error'>No food Found.</div>";
                       header('location:'.SITEURL.'admin/manage-food.php');
                     }
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-food.php');
                }


              ?>


      <form action="" method="post" enctype="multipart/form-data">
      <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name= "title" value="<?php echo $title; ?>"></td>
                    
                </tr>
                <tr>
                     <td>Description</td>
                     <td>
                        <textarea name="description"  cols="30" rows="5"> <?php echo $row2['description']?> </textarea>
                     </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                    
                </tr>
                <tr>
                      <td>Current Image:</td>
                     <td>
                     <?php 
                              if($current_image!="")
                              {
                                  ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                              }
                              else
                              {
                                echo  "<div class='error'>Image Not Added</div>";
                              }
                            ?>
                     </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                       <input type="file" name="image"> 
                    </td>
                    
                </tr>
                <tr>
                     <td>Category:</td>
                     <td>
                        <select name="category" >
                                     
                        <?php
                              $sql="SELECT *FROM tbl_category WHERE active='Yes'";
                              $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));

                              $count=mysqli_num_rows($res);
                              if($count>0)
                              {
                                while($row=mysqli_fetch_assoc($res))
                                  
                                  {
                                      $category_id=$row['id'];
                                      $title=$row['title'];

                                      ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $title; ?></option>

                                      <?php
                                  }
                              }
                              else
                              {
                                  ?>
                                     <option value="">No Category Found</option>
                                  <?php
                              }
                           ?>
                                
                        </select>
                     </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";}?> type="radio" name=featured value="Yes"> Yes
                        <input <?php if($featured=="No") {echo "checked";}?> type="radio" name=featured value="No"> No
                    </td>
                    
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No") {echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                           <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                           <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                    
                </tr>
      </table>
      </form>

       <?php
         if(isset($_POST['submit']))
        {
            $id=$_POST['id'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category=$_POST['category'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];
            if(isset($_FILES['image']['name']))
                   {
                      
                       // get the image details
                       $image_name=$_FILES['image']['name'];
                       if($image_name!="")
                       {
                           //upload the new image
                           //extenstions that redendency break or auto rename
                        //$ext= end(explode('.',$image_name ));
                         $arrayVar = explode('.', $image_name );
                         $ext= end($arrayVar);
                         $image_name="Food-Name-".rand(000,999).'.'.$ext; 
                         $source_path=$_FILES['image']['tmp_name'];
                         $destination_path="../images/food/".$image_name;
                          $upload=move_uploaded_file($source_path, $destination_path);
                            if($upload==false)
                              {
                                $_SESSION['upload']="<div class='error'>failed to  upload New Image.</div>";
                                 header('location:'.SITEURL.'admin/manage-food.php');
                                   die();
                               }
                           // remove the current image if avilable
                           //if($current_image!="")
                           //{
                              $remove_path = "../images/food/".$current_image;
                              //$remove = unlink($remove_path);
                                 
                              
                              if (is_file($remove_path)) {
                                // The path exists and is a file
                                 unlink($remove_path);   
                                 }
                                 
                            /* if($remove==false)
                                  {
                                   $_SESSION['remove-failed']="<div class='error'>failed to remove current image.</div>";
                                   header('location:'.SITEURL.'admin/manage-food.php');
                                   die();
                                  
                                  }
                                  */
                                  
                          
                           }
                           else
                            {
                              $image_name= "$current_image";
                            }
                       }
                    

                       else
                       { 
                        $image_name= "$current_image";
                       }
                       $sql3=" UPDATE tbl_food SET 
                       title='$title',
                       description='$description',
                       price='$price',
                       image_name='$image_name',
                       category_id='$category',
                       featured='$featured',
                       active='$active'
                       WHERE id='$id'
                       ";
                       $res3=mysqli_query($conn,$sql3) or die(mysqli_error($conn));
                       if($res3==true)
                       {
                         $_SESSION['update']="<div class='success'>food updated successfuly</div>";
                         header('location:'.SITEURL.'admin/manage-food.php');
                       }
                       else
                       {
                         $_SESSION['update']="<div class='error'>failed to update food.</div>";
                         header('location:'.SITEURL.'admin/manage-food.php');
                       }
             }
        
     ?>

  </div>
  </div>

<?php include('partials/footer.php');?>