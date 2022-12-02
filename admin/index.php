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
            <?php
                //sql query
                $sql ="SELECT * FROM tbl_category";

                //Execute query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);
            ?>
        <h1><?php echo $count; ?></h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">
        <?php
                //sql query
                $sql2 ="SELECT * FROM tbl_food";

                //Execute query
                $res2 = mysqli_query($conn, $sql2);

                //Count rows
                $count2 = mysqli_num_rows($res2);
            ?>   
        <h1><?php echo $count2; ?></h1>
            <br />
            Foods
        </div>

        <div class="col-4 text-center">
        <?php
                //sql query
                $sql3 ="SELECT * FROM tbl_order";

                //Execute query
                $res3 = mysqli_query($conn, $sql3);

                //Count rows
                $count3 = mysqli_num_rows($res3);
            ?>   
        <h1><?php echo $count3; ?></h1>
            <br />
            Total Orders
        </div>

        <div class="col-4 text-center">
        <?php
                //sql query
                $sql4 ="SELECT SUM(total) as Total FROM tbl_order WHERE status = 'Delivered'";

                //Execute query
                $res4 = mysqli_query($conn, $sql4);

                $row4 = mysqli_fetch_assoc($res4);

                //Ger the total 
                $total_revenue = $row4['Total'];

            ?>   
        <h1><?php echo $total_revenue; ?></h1>
            
            <br />
            Revenue Generated
        </div>

        <div class="clearfix"></div>
    </div>
    <!-- main content section starts -->
</div>
<!-- main content section end -->
<?php include('partials/footer.php'); ?>