<?php include('partials/menu.php'); ?>
<div class="main-content">

    <div class="wrapper">
        <h1>Add Food</h1>

        <br /> <br />

        <?php
             if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];  //Displaying Session Message
                unset($_SESSION['upload']); //Removeing Session MEessage
            }
        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the food"></td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                    <textarea name="description" cols="30" rows="10" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td><input type="num" name="price"></td>
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
                                $id = $row ['id'];
                                $title = $row ['title'];

                                ?>
                                <option value="<?php $id; ?>"><?php echo $title;?></option>
                                <?php
                            }
                        }
                        else
                        {
                            //We do not have category
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }

                        ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                        <td colspan="2">
                            <!-- <input type="hidden" name="current_image" value="<?php echo $current_image;?>"> 
                            <input type="hidden" name="id" value="<?php echo $id;?>">  -->
                            <input type="submit" name="submit" value="Add Food" class="btn-primary">
                        </td>
                    </tr>

            </table>
        </form>

                        <?php
                        
                            //Check whether the button is clicked or not
                            if(isset($_POST['submit']))
                            {
                                //Add the food in database
                                //echo "clicked";
                                
                                //1. Get the Data from form 
                                $title = $_POST['title'];
                                $description = $_POST['description'];
                                $price = $_POST['price'];
                                $category = $_POST['category'];
                               
                                //Check whether radio button for featured and active are checked or not
                                if(isset($_POST['featured']))
                                {
                                    $featured = $_POST['featured'];
                                }
                                else
                                {
                                    $featured = "No"; //Setting the default value
                                }

                                if(isset($_POST['active']))
                                {
                                    $active = $_POST['active'];
                                }
                                else
                                {
                                    $active= "No"; //Setting the default value
                                }



                                //2. Upload the image if selected
                                //Check whether the select image is clicked or not and upload the image only if the image is selected
                                if(isset($_FILES['image']['name']))
                                {
                                    //Get the details of the selected image
                                    $image_name = $_FILES['image']['name'];

                                    //Check whether the image is selected or not and upload image only if selected
                                    if($image_name !="")
                                    {
                                        //image is selected
                                        //A.Rename the image
                                        //Get the extension of selected image(jpg png, gif, etc,.)
                                        $tmp = explode('.',$image_name);
                                        $ext = end($tmp);
                                         //Create new name for image  
                                        $image_name ="Food_name_".rand(0000,9999).'.'.$ext; //e.g. Food_Category_834.jpg

                                        //B.upload the image
                                        //Get the src path and destination path

                                         //Source path is the current location of the image
                                        $src = $_FILES['image']['tmp_name'];

                                       //Destination Path is the current location of the image
                                        $dst = "../images/food/".$image_name;

                                        // finally upload the image
                                        $upload = move_uploaded_file($src, $dst);

                                        //Check whether the image is uploaded or not 
                                        //And if the image is not upload then we will stop the process and redirect with error message
                                        if($upload == false){
                                            //Set message
                                            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image </div>/";
                                            //Redirect the user
                                            header("location: " . SITEURL . 'admin/add-category.php');
                                            //Stop the process
                                            die();
                                        }
                                    }

                                }
                                else
                                {
                                    $image_name =""; // Setting default value as blank
                                }
                                
                                //3. Insert into database
                                
                                //Create a SQL Query to save or add food
                                //For numberical we do not need to pass value inside quotes'' but for strong value it is compulsory to add quotes'
                                $sql2= "INSERT INTO tbl_food SET
                                        title = '$title',
                                        description = '$description',
                                        price = '$price',
                                        image_name = '$image_name',
                                        category_id = '$category',
                                        featured = '$featured',
                                        active = '$active'
                                ";
                                //echo $sql2; die();

                                //Execute the query
                                $res2 = mysqli_query($conn, $sql2);


                                //4. Redirect with message to manage food page
                                //Check whether data inserted or not 
                                if($res2 == true)
                                {
                                    //Data inserted successfully
                                    $_SESSION['add'] = "<div class='success text-center'>Food Added Successfully </div>";
                                    //Redirect the user
                                    header("location: " . SITEURL . 'admin/manage-food.php');
                                    
                                }
                                else
                                {
                                    //failed to insert data
                                    $_SESSION['add'] = "<div class='error text-center'>Failed to add food </div>";
                                    //Redirect the user
                                    header("location: " . SITEURL . 'admin/manage-food.php');
                                }
                            }

                        ?>


    </div>
</div>
<?php include('partials/footer.php'); ?>