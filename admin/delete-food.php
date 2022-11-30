<?php
    //Include constants.php file here
    include('../config/constants.php');

    //echo "Delete Food Page";

    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
    {
        //process to delete
        echo"Delete";

        //1. get id and image name 
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        //2. Remove the image if available
        //Check whether the image is available or not and delete only f available
        if($image_name != "")
        {
            //Get the image path
            $path = "../images/food/".$image_name;

            //Remove image file from folder 
            $remove = unlink($path);

            //Check whether the image is removed or not 
            if($remove == false)
            {
                //Failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove image File.</div>";
                //Redirect the user
                header("location: " . SITEURL . 'admin/manage-food.php');
                //Stop the process of deleting food 
                die();
            }
        }

        //3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed or not and set the session message respectively
        if($res == true)
        {
                //Food deleted
                $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
                //Redirect the user
                header("location: " . SITEURL . 'admin/manage-food.php');
                
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            //Redirect the user
            header("location: " . SITEURL . 'admin/manage-food.php');
            
        }


        //4. Redirect to manage food with session message 
    }
    else
    {
        //Redirect to manage food page
        //echo"Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        //Redirect the user
        header("location: " . SITEURL . 'admin/manage-food.php');
    }
?>

