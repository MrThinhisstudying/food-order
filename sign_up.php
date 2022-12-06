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

        .success {
            color: var(--green-dark);
        }

        .error {
            color: var(--red);
        }
    </style>

    <div id="wrapper">
        <form action="" method="POST">
            <h3>Đăng ký</h3>

            <?php
            if (isset($_SESSION['signup'])) {
                echo $_SESSION['signup'];  //Displaying Session Message
                unset($_SESSION['signup']); //Removeing Session MEessage
            }
            ?>

            <div class="form-group">
                <input type="text" name="full_name" required>
                <label for="">Họ và Tên</label>
            </div>

            <div class="form-group">
                <input type="text" name="email" required>
                <label for="">Email</label>
            </div>

            <div class="form-group">
                <input type="text" name="username" required>
                <label for="">Tên đăng nhập</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" required>
                <label for="">Mật khẩu</label>
            </div>

            <div class="form-group">
                <input type="password" name="confirm-password" required>
                <label for="">Nhập lại mật khẩu</label>
            </div>


            <input type="submit" name="submit" value="Đăng ký" id="btn-signup">
        </form>

    </div>


</body>

</html>

<?php
// process the value from form and save it in Database
//Check whether the button is clicked or not
if (isset($_POST['submit'])) {
    
    if ($_POST['password'] == $_POST['confirm-password']) {
        //button Clicked
        // echo"Button Clicked";
        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Passwrod Encryption with MD5
        $email = ($_POST['email']);

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_user SET 
        username ='$username',
        password= '$password',
        full_name='$full_name',
        contact='',
        email='$email',
        address =''
  ";

        //  3. Executing Query and Saving Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (Query is Executed) data inserted or not and display appropriate message
        if ($res == TRUE) {
            //Data Inserted
            //echo"Data Inserted";
            //Create a Session Varibale to Display Message
            $_SESSION['signup'] = "<div class='success'>Đăng ký thành công</div>";
            //Redirect Page to add admin
            header("location: " . SITEURL . 'login_user.php');
        } else {
            // Failed to Insert Data
            //echo"Faile to Insert";
            //Create a Session Varibale to Display Message
            $_SESSION['signup'] = "<div class='error'>Đăng ký thất bại</div>";
            //Redirect Page to add admin
            header("location: " . SITEURL . 'sign_up.php');
        }
    } else {
        $_SESSION['signup'] = "<div class='error'>Đăng ký thất bại</div>";
        //Redirect Page to add admin
        header("location: " . SITEURL . 'sign_up.php');
    }
}


?>