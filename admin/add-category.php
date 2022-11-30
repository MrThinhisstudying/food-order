<?php include('partials/menu.php'); ?>

<!-- main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

                <?php
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];  //Displaying Session Message
                    unset($_SESSION['add']); //Removeing Session MEessage
                }
                
                if (isset($_SESSION['upload'])) {
                    echo $_SESSION['upload'];  //Displaying Session Message
                    unset($_SESSION['upload']); //Removeing Session MEessage
                }
                
                ?>
        
        <br><br>

        <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name="image" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">                        
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form ends-->

<?php
    
    // Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Clicked";

        //1. Get the value from Category form 
        $title = $_POST['title'];

        //For radio input, we need to check whether the button is selected or not
        if(isset($_POST['featured']))
        {
            //Get the value from form 
            $featured = $_POST['featured'];
        }
        else
        {
            //SET the default value
            $featured = "No";
        }

        if(isset($_POST['active']))
        {
            //Get the value from form 
            $active = $_POST['active'];
        }
        else
        {
            //SET the default value
            $active = "No";
        }

        //CHeck whether the image is selected or not and set the value for image name accoridingly
        // print_r($_FILES['image']);
        // die();
        //Break the code here
    
        if(isset($_FILES['image']['name']))
        {
            //upload the image 
            //To upload image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];

            //UPload the image only if image is selected
            if($image_name !="")
            {
                //Auto rename our image
                //Get the Extension of our image (jpg,png, gif, etc) e.g. "specialfood1.jpg"
                $ext = end(explode('.', $image_name));

                //Rename the image 
                $image_name ="Food_category_".rand(000,999).'.'.$ext; //e.g. Food_Category_834.jpg


                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;

                // finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

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
            //Don't upload image and set the image_name value as blank
            $image_name = "";
        }

        //2.Creat SQL Query to Insert category into database
        $sql = "INSERT INTO tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active ='$active'
        ";

        //3. Execute the query and save in database
        $res = mysqli_query($conn,$sql);

        //4. Check whether the query executed or not and data added or not
        if($res == true)
        {
            //Query Executed and category added
            $_SESSION['add'] = "<div class='success text-center'>Category Added Successfully</div>";
            //Redirect the user
            header("location: " . SITEURL . 'admin/manage-category.php');
        }
        else
        {
            //Failed to add category 
            //Query Executed and category added
            $_SESSION['add'] = "<div class='error text-center'>Failed to add Category </div>";
            //Redirect the user
            header("location: " . SITEURL . 'admin/add-category.php');
        }

    }
?>

    </div>
</div>
<!-- main content section end -->



<?php include('partials/footer.php'); ?>