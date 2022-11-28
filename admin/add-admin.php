<?php include('partials/menu.php'); ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Add Admin</h1>

                <br/> <br/>

                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];  //Displaying Session Message
                        unset($_SESSION['add']); //Removeing Session MEessage
                    }
                ?>
            
                <form action="" method="POST">
                    <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>

                    <tr>
                        <td>User Name:</td>
                        <td><input type="text" name="username" placeholder="Enter Your User Name"></td>
                    </tr>

                    <tr>    
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter Your Password"></td>    
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                        </td>
                    </tr>
                    
                    
                    </table>
                </form>
            </div>
        </div>

<?php include('partials/footer.php'); ?> 

<?php
// process the value from form and save it in Database

//Check whether the button is clicked or not
if(isset($_POST['submit'])){
    //button Clicked
    // echo"Button Clicked";
    //1. Get the Data from form
   $full_name = $_POST['full_name'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);// Passwrod Encryption with MD5

  //2. SQL Query to Save the data into database
  $sql = "INSERT INTO tbl_admin SET 
        full_name='$full_name',
        username ='$username',
        password= '$password'
  ";

//  3. Executing Query and Saving Data into Database
  $res = mysqli_query($conn, $sql) or die(mysqli_error());

  //4. Check whether the (Query is Executed) data inserted or not and display appropriate message
  if($res == TRUE){
    //Data Inserted
    //echo"Data Inserted";
    //Create a Session Varibale to Display Message
    $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
    //Redirect Page to add admin
    header("location: ".SITEURL.'admin/manage-admin.php');
  }
  else{
    // Failed to Insert Data
    //echo"Faile to Insert";
     //Create a Session Varibale to Display Message
     $_SESSION['add'] = "<div class='error'>Failed to Admin Added</div>";
     //Redirect Page to add admin
     header("location: ".SITEURL.'admin/manage-admin.php');
  }
}


?>