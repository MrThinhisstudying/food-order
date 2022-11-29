<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Dashbroad</h1>

        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];  //Displaying Session Message
            unset($_SESSION['login']); //Removeing Session MEessage
        }
        ?>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <h1>5</h1>
            <br />
            Categories
        </div>

        <div class="clearfix"></div>
    </div>
    <!-- main content section starts -->
</div>
<!-- main content section end -->
<?php include('partials/footer.php'); ?>