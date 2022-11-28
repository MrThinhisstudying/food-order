<?php

    //Include constants.php file here
    include('../config/constants.php');


    //1. Get the id of admin to be deleted
     $id = $_GET['id'];

    //2. Vreate SQL Query to Delete Admin
    $sql ="DELETE FROM tbl_admin WHERE id = $id";

    //Execute the Query
    $res=mysqli_query($conn, $sql);

    //check whether the query executed successfully or not
    if($res == true)
    {
        //Querry Executed Successully and Admin Deleted
        //echo 'Admin Deleted';
        //Create Session variable to display message
        $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully</div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //Failed to Delete Admin
       // echo "Failed";

       $_SESSION['deleted'] = "<div class='error'> Failed to Delete Admin. Try again later. </div>";
       header('location:'.SITEURL.'admin/manage-admin.php');
    }

    //3. Redirect to Manage Admin page with message (success/error)

?>