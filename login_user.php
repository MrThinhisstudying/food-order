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

        input#btn-login {
            background: #1a73e8;
            color: #fff;
            cursor: pointer;
        }

        input#btn-login:hover {
            opacity: 0.85;
        }

        a {
            text-decoration: none;
        }

        h4 {
            font-size: 16px;
            font-weight: 400;
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
            <h3>Đăng nhập</h3>

            <br><br>

            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];  //Displaying Session Message
                unset($_SESSION['login']); //Removeing Session MEessage
            }
           

           
            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];  //Displaying Session Message
                unset($_SESSION['no-login-message']); //Removeing Session MEessage
            }
            
            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];  //Displaying Session Message
                unset($_SESSION['no-login-message']); //Removeing Session MEessage
            }

            if (isset($_SESSION['signup'])) {
                echo $_SESSION['signup'];  //Displaying Session Message
                unset($_SESSION['signup']); //Removeing Session MEessage
            }

            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];  //Displaying Session Message
                unset($_SESSION['change-pwd']); //Removeing Session MEessage
            }

            ?>
            <br><br>
            <div class="form-group">
                <input type="text" name="username" required>
                <label for="">Tên đăng nhập</label>
            </div>

            <div class="form-group">
                <input type="password" name="password" required>
                <label for="">Mật khẩu</label>
            </div>


            <div class="form-group">
                <a href="<?php echo SITEURL; ?>change_password.php" class="change-passwrod">Quên mật khẩu ?</a>
            </div>

            <input type="submit" name="submit" value="Đăng nhập" id="btn-login">

            <div class="form-group">
                <h4>Bạn chưa có tài khoản ? <a href="<?php echo SITEURL; ?>sign_up.php">Đăng ký</a> </h4>
            </div>
        </form>

    </div>
</body>
</html>

<?php
//Check whether the submit Button is cliked or not 
if (isset($_POST['submit'])) {
    // Process for login 
    // 1. Get the Data from Login form 
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $tmp_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $tmp_password);

    // 2. SQL to check whether the user with username and password exixts or not 
    $sql = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);
    
    //4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
   
    if ($count == 1) {
        //Redirect to manage admin page with success Message
        $_SESSION['login'] = "<div class='success'>Đăng nhập thành công.</div>";
        $_SESSION['user'] = $username;
        //Redirect the user
        header("location: " . SITEURL . 'index.php');
    } else {
        //Redirect to manage admin page with success Message
        $_SESSION['login'] = "<div class='error text-center' >Đăng nhập thất bại</div>";
        //Redirect the user
        header("location: " . SITEURL . 'login_user.php');
    }
}