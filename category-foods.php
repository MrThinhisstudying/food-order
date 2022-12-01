<?php include('partials-front/menu.php') ?>

<?php
    //Check whether id is passed or not 
    if(isset($_GET['category_id']))
    {
        //Category id is passed or not 
        $category_id = $_GET['category_id'];

        //Get the category Title based on category id
        $sql = "SELECT title FROm tbl_category WHERE id = $category_id";

        //Execite the Query
        $res = mysqli_query($conn, $sql);

        //Get the value from database
        $row = mysqli_fetch_assoc($res);

        //Get the title 
        $category_title = $row['title'];
    }
    else
    {
        //Category not passed
        //Redirect to home page 
        header('location: '.SITEURL);
    }

?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        <?php
        
            //Create sql query to get foods based on selected category
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
        
            //Execute the Query 
            $res2 = mysqli_query($conn, $sql2);

            //Count the rows
            $count2 = mysqli_num_rows($res2);

            //Check whether food is available or not 
            if($count2 > 0)
            {
                //Food is available
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];

                    ?>
                     <div class="food-menu-box">
                         <div class="food-menu-img">
                         <?php

                            //Check whether image available or not 
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image not available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $image_name; ?>" class="img-responsive img-curve">
                                <?php
                            }

                        ?>
                            
                    </div>
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?> VND</p>
                            <p class="food-detail">
                            <?php echo $description; ?>
                            </p>
                            <br>
                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php

                }
            }
            else
            {
                echo "<div class='error'>Food not available</div>";
            }

        ?>


           

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>