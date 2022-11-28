<?php include('partials/menu.php'); ?>
       
        
         <!-- main content section starts -->
         <div class="main-content">
            <div class="wrapper">
                <h1>Change Password</h1>
                <br/> <br/>

                <form action="" method="POST">

                <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="Old Password"</td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"</td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"</td>
                </tr>

                

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>"> 
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">
                    </td>
                </tr>
                
            </table>

</form>

            </div>
        </div>
        <!-- main content section end -->

<?php
    //Check whether th submit button is clicked or not 
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
        //Get all the values from form to update 
         $id = $_POST['id'];
         $current_password = $_POST['current_password'];
        $new_password =$_POST['new_password'];
        $confirm_password = md5($_POST['confirm_password']);

        //Create a SQL Query to update Admin
        $sql ="SELECT * FROM tbl_admin WHERE id=$id and password ='$current_password'";

        //Execute the query 
        $res = mysqli_query($conn, $sql);

        if($res == true)
        {

            //Check whether data is available or not
            $count = mysqli_num_rows($res);

            if($count ==1){
                //User Exists and password can che changed
                echo "User Found";
            }
            else{
                $_SESSION['user-not-found'] = "<div class='error'> User Not Found.</div>";
            }
                
        }
        
        
        //Check whether the query executed succesfully or not 
        if($res == true){
            //Query Executed and admin updated
            $_SESSION['update'] = "<div class='success'>Update Admin Successfully</div>";
            //Redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['add'] = "<div class='error'>Failed to Admin Updated</div>";
            //Redirect Page to add admin
            header("location: ".SITEURL.'admin/manage-admin.php');
        }
    }
?>
        
<?php include('partials/footer.php'); ?> 