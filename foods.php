<?php include('partials-front/menu.php') ?>
<!-- CSS only -->

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:6; 
        $current_page =!empty($_GET['page'])?$_GET['page']:1;
        $offset=((int)$current_page - 1)* (int)$item_per_page;
        
        //Getting foods from database that are active and featured
        $sql = "SELECT * FROM tbl_food WHERE active ='Yes' AND featured='Yes' LIMIT $item_per_page OFFSET $offset ";

        $totalrecords = mysqli_query($conn,"SELECT * FROM tbl_food");
        $totalrecords = $totalrecords->num_rows;
        $totalPages = ceil((int)$totalrecords / (int)$item_per_page);
        

        //Execute the Query
        $res = mysqli_query($conn, $sql);
        
        //Count Rows
        $count = mysqli_num_rows($res);

        //Check whether food available or not 
        if ($count > 0) {
            //Food Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get all the values
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];

        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">

                        <?php

                        //Check whether image available or not 
                        if ($image_name == "") {
                            //image not available
                            echo "<div class='error'>Image not available</div>";
                        } else {
                            //image available
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $image_name; ?>" class="img-responsive img-curve">
                        <?php
                        }

                        ?>


                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

        <?php

            }
        } else {
            //Food not available
            echo "<div class='error'>Food not available</div>";
        }


        ?>
        <div class="clearfix"></div>

    </div>

    <?php include('pagination.php') ?>
    
  

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>