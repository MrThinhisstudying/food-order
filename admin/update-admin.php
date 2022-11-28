<?php include('partials/menu.php'); ?>

<div class="main-content">

    <div class="wrapper">
        <h1>Update Admin</h1>
    
        <br/> <br/>

        <?php
            //Include constants.php file here
            // include('../config/constants.php');

             $id = $_GET['id'];

             //2. Create SQL Query to Delete Admin
             $sql ="SELECT * FROM tbl_admin WHERE id = $id";
         
             //Execute the Query
             $res=mysqli_query($conn, $sql);

              //Check whether the Querry is Executed of Not
              if($res==TRUE){
                //Count Rows to Check whether we have data in database or not
                $count = mysqli_num_rows($res); // Funtion to get a;; the rows in database

                //Check Whether we have admin data or not
                if($count==1)
                {
                    //Get the Details
                    //echo"Admin Available";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else{
                     //Redirect Page to add admin
                    header("location: ".SITEURL.'admin/manage-admin.php'); 
                }
            }
        ?>

    <form action="" method="POST">

    <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                    </tr>

                    <tr>
                        <td>User Name:</td>
                        <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>"> 
                            <input type="submit" name="submit" value="Update Admin" class="btn-primary">
                        </td>
                    </tr>
                    
                </table>

    </form>

    </div>

</div>

<?php
    //Check whether th submit button is clicked or not 
    if(isset($_POST['submit'])){
        //echo "Button Clicked";
        //Get all the values from form to update 
         $id = $_POST['id'];
         $full_name = $_POST['full_name'];
        $username =$_POST['username'];

        //Create a SQL Query to update Admin
        $sql ="UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        Where id = '$id'
        ";


        //Execute the query 
        $res = mysqli_query($conn, $sql);

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