<?php
    //include constants file
    include('../config/constants.php');

    //echo "Delete Page";
    //Check whether the í and image_name value is set or not 
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Ger the value and delete
        //echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name != "")
        {
            //image is vailable. so remove it 
            $path = "../images/category/".$image_name;

            //remove the image 
            $remove = unlink($path);
            
            //if failed to remove image then add an error message and stop the process
            if($remove == false)
            {
                $_SESSION['remove'] = "<div class='error'> Failed to Remove Category Image. </div>";
                //Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        //Delete data from database
        //SQL Query to Delete Date from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res == true)
        {
            //SET success message and redirect
            $_SESSION['delete'] = "<div class='success'> Category Deleted Successfully </div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //SET success message and redirect
            $_SESSION['delete'] = "<div class='error'>Fail to delete Category  </div>";
            //Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //Redirect tot manage category page with message
    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php/');
    }

?>