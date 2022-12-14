<?php include('partials/menu.php'); ?>

<?php
            //Check whether the id is set or not 
            if(isset($_GET['id']))
            {
                //Get the id and all other details
                // echo "Getting the data";
                $id = $_GET['id'];
                //Create SQL Query to get all other details
                $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the rows to check whether the id is valid or not 
                $row2 = mysqli_fetch_assoc($res2);

                //Get all the data
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
                  
                
            }
            else
            {
                //Redirect to Manage Category
                header('location:'.SITEURL.'admin/manage-food.php');
            }

        ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
    
        <br/> <br/>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="10"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                <?php
                                    if($current_image !="")
                                    {
                                        //Display the image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image;?>" width="150px">
                                        <?php
                                    }
                                    else
                                    {
                                        //Display message;
                                        echo "<div class='error'>Image Not Added</div>";
                                    }
                ?>
                </td>
            </tr>

            <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">
                    <?php
                        //Create PHP code to display categories from database
                        //1. Create SQL to get all active categories from database
                        $sql = "SELECT * FROM tbl_category WHERE active='YES'";

                        //Executing query
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to the check whether we have categories or not
                        $count = mysqli_num_rows($res);

                        //if count is greater than zero, we have categories else we donot have categories
                        if($count >0)
                        {
                            //We have categories
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get the details of categories
                                $category_title = $row ['title'];
                                $category_id = $row ['id'];
                                
                                ?>
                                <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?>
                            
                                </option>
                                <?php
                            }
                        }
                        else
                        {
                            //We do not have category
                            
                           echo "<option value='0'>Category Not Available</option>";
                            
                        }

                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured == "Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active </td>
                <td>
                    <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id;?>"> 
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>"> 
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
            </table>
        </form>
        <?php

if(isset($_POST['submit']))
{
   //echo"clicked";
   //1. Get all the values from our form 
   $id = $_POST['id'];
   $title = $_POST['title'];
   $description = $_POST['description'];
   $price = $_POST['price'];
   $current_image = $_POST['current_image'];
   $category = $_POST['category'];
   $featured = $_POST['featured'];
   $active = $_POST['active'];

   //2.Updating new image if selected 
   //Check whether the image is selected or not 
   if(isset($_FILES['image']['name']))
   {
       //Get the image details
       $image_name = $_FILES['image']['name'];

       //Check whether the image is available or not 
       if($image_name != "")
       {
           //image available

           //A. Uploads the new image 

           //Auto rename our image
           //Get the Extension of our image (jpg,png, gif, etc) e.g. 
           $tmp=explode('.', $image_name);
           $ext = end($tmp);

           //Rename the image 
           $image_name ="Food-Name-".rand(0000,9999).'.'.$ext; //e.g. Food_Category_834.jpg


           $src_path = $_FILES['image']['tmp_name'];

           $dest_path = "../images/food/".$image_name;

           // finally upload the image
           $upload = move_uploaded_file($src_path, $dest_path);

           //Check whether the image is uploaded or not 
           //And if the image is not upload then we will stop the process and redirect with error message
           if($upload == false){
               //Set message
               $_SESSION['upload'] = "<div class='error'> Failed to Upload new Image </div>/";
               //Redirect the user
               header("location: " . SITEURL . 'admin/manage-food.php');
               //Stop the process
               die();
           }

           //B. remove the current image if available
           if($current_image != ""){
               $remove_path = "../images/food/".$current_image;
           
               $remove = unlink($remove_path);

               //Check whether the image is removed or not 
               //if failed to remove then display message and stop the process
               if($remove == false)
               {
                   //failed to remove image
                   $_SESSION['remove-failed'] = "<div class='error'> Failed to Remove Image </div>/";
                   //Redirect the user
                   header("location: " . SITEURL . 'admin/manage-food.php');
                   die();//stop the process
               }
           }
           
       }
       else
       {
           $image_name = $current_image;
       }
   }
   else
   {
       $image_name = $current_image;
   }

   //3. Update the database category with message
   $sql3="UPDATE tbl_food SET
           title='$title',
           description = '$description',
           price=$price,
           image_name = '$image_name',
           category_id = $category,
           featured = '$featured',
           active='$active'
           WHERE id=$id
   ";

   //Execute the query
   $res3 = mysqli_query($conn, $sql3);

   //4.Redirect to manage category with message
   //Check whether executed or not 
   if($res3==true)
   {
       //category update
       $_SESSION['update'] = "<div class='success text-center'>Food Update Successfully </div>";
       //Redirect the user
       header("location: " . SITEURL . 'admin/manage-food.php');
       
   }
   else
   {
       $_SESSION['update'] = "<div class='error text-center'>Failed to Update Food </div>";
       //Redirect the user
       header("location: " . SITEURL . 'admin/manage-food.php');
   }
}
         
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>