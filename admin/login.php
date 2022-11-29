<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>

        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];  //Displaying Session Message
            unset($_SESSION['login']); //Removeing Session MEessage
        }
        ?>

        <?php
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];  //Displaying Session Message
            unset($_SESSION['no-login-message']); //Removeing Session MEessage
        }
        ?>

        <!-- Login form starts here -->
        <form action="" method="POST" class="text-center">
            Username:<br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>
        <!-- Login form ends here -->
    </div>
</body>

</html>

<?php
//Check whether the submit Button is cliked or not 
if (isset($_POST['submit'])) {
    // Process for login 
    // 1. Get the Data from Login form 
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // 2. SQL to check whether the user with username and password exixts or not 
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);

    //4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        //Redirect to manage admin page with success Message
        $_SESSION['login'] = "<div class='success'>Login Successfully.</div>";
        $_SESSION['user'] = $username;

        //Redirect the user
        header("location: " . SITEURL . 'admin/');
    } else {
        //Redirect to manage admin page with success Message
        $_SESSION['login'] = "<div class='error text-center' >Username or Password did not match.</div>";
        //Redirect the user
        header("location: " . SITEURL . 'admin/login.php');
    }
}

?>