<?php include('config/constants.php');  ?>
<head>
    <title>Đăng nhập</title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&family=Roboto:wght@300;400;500;700&display=swap');
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            font-size: 17px;
        }
        
        #wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        
        form {
            border: 1px solid;
            border-radius: 5px;
            padding: 30px;
        }
        
        h3 {
            text-align: center;
            font-size: 24px;
            font-weight: 500;
        }
        
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }
        
        input {
            height: 50px;
            width: 300px;
            outline: none;
            border: 1px solid #dadce0;
            padding: 10px;
            border-radius: 5px;
            font-size: inherit;
            color: #202124;
        }
        
        label {
            position: absolute;
            padding: 0px 5px;
            left: 5px;
            top: 50%;
            pointer-events: none;
            transform: translateY(-50%);
            background: #fff;
            transition: all 0.3s ease-in-out;
        }
        
        .form-group input:focus {
            border: 2px solid #1a73e8;
            transition: all 0.3s ease-in-out;
        }
        
        .form-group input:focus+label,
        .form-group input:valid+label {
            top: 0px;
            font-size: 13px;
            font-weight: 500;
            color: #1a73e8;
        }
        
        input#btn-signup {
            background: #1a73e8;
            color: #fff;
            cursor: pointer;
        }
        
        input#btn-signup:hover {
            opacity: 0.85;
        }
    </style>

    <div id="wrapper">
        <form action="" method="POST">
            <h3>Quên mật khẩu</h3>

            <?php
            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];  //Displaying Session Message
                unset($_SESSION['change-pwd']); //Removeing Session MEessage
            }

            if (isset($_SESSION['password-not-match'])) {
                echo $_SESSION['password-not-match'];  //Displaying Session Message
                unset($_SESSION['password-not-match']); //Removeing Session MEessage
            }

            if (isset($_SESSION['email-not-found'])) {
                echo $_SESSION['email-not-found'];  //Displaying Session Message
                unset($_SESSION['email-not-found']); //Removeing Session MEessage
            }

           ?>

            <div class="form-group">
                <input type="text" name = "email" required>
                <label for="">Email</label>
            </div>

            <div class="form-group">
                <input type="password" name = "new_password" required>
                <label for="">Mật khẩu mới</label>
            </div>

            <div class="form-group">
                <input type="password" name = "confirm_password" required>
                <label for="">Nhập lại mật khẩu</label>
            </div>


            <input type="submit" name="submit" value="Xác nhận" id="btn-signup">
        </form>

    </div>
</body>

</html>

<?php 
    //Check whether the submit button is clicked on Not
    if(isset($_POST['submit']))
    {
        // echo "Cliked";

        //1. Get the data from form
        $email = $_POST['email'];
        if(isset($_POST['new_password']) || isset($_POST['confirm_password'])){
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);
        }
       


        //2. Check whether the user with current ID and Current Password Exixts or Not
        $sql = "SELECT * FROM tbl_user WHERE email='$email'";

        //Execute the query
        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            //Check whether data is available or not
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                //User exixts and password can be changed
                //Check whether the new password and confirm match or not
                
                if($new_password == $confirm_password){
                    //Update password
                    //echo "Password match";
                    $sql2 = "UPDATE tbl_user SET
                        password ='$new_password'
                        WHERE email ='$email'
                    ";
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether the query exeuted or not
                    if($res2 == true)
                    {
                        //Display Success Message
                         //Redirect to manage admin page with success Message
                        $_SESSION['change-pwd'] = "<div class='success'>Đổi mật khẩu thành công</div>";
                        //Redirect the user
                        header("location: ".SITEURL.'login_user.php');
                    }
                    else
                    {
                        //Display Error Message
                          //Redirect to manage admin page with error Message
                          $_SESSION['change-pwd'] = "<div class='error'>Đổi mật khẩu thất bại</div>";
                          //Redirect Page the user
                          header("location: ".SITEURL.'change_password.php');
                    }
                    
                }
                else{
                    //User does not exist set message and redirect
                    $_SESSION['password-not-match'] = "<div class='error'>Mật khẩu không trùng khớp</div>";
                    //Redirect Page to add admin
                    header("location: ".SITEURL.'change_password.php');
                }
            }
            else{
                //User does not exist set message and redirect
                $_SESSION['email-not-found'] = "<div class='error'>Email không tồn tại</div>";
                //Redirect Page to add admin
                header("location: ".SITEURL.'change_password.php');
            }
        }
        //3. Check whether the New Password and Confirm Password Match or not 

        //4. Change password if all above is true
    }
?>