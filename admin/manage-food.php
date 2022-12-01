<?php include('partials/menu.php'); ?>
       
        
         <!-- main content section starts -->
         <div class="main-content">
            <div class="wrapper">
                <h1>food</h1>

                <br/>
                <!-- button to add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                
                <br/> <br/> <br/>

                <?php
                    if (isset($_SESSION['add'])) {
                        echo $_SESSION['add'];  //Displaying Session Message
                        unset($_SESSION['add']); //Removeing Session MEessage
                    }

                    if (isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];  //Displaying Session Message
                        unset($_SESSION['delete']); //Removeing Session MEessage
                    }

                    if (isset($_SESSION['upload'])) {
                        echo $_SESSION['upload'];  //Displaying Session Message
                        unset($_SESSION['upload']); //Removeing Session MEessage
                    }

                    if (isset($_SESSION['unauthorize'])) {
                        echo $_SESSION['unauthorize'];  //Displaying Session Message
                        unset($_SESSION['unauthorize']); //Removeing Session MEessage
                    }

                    if (isset($_SESSION['update'])) {
                        echo $_SESSION['update'];  //Displaying Session Message
                        unset($_SESSION['update']); //Removeing Session MEessage
                    }

                    

                ?>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM tbl_food";

                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create serial number variable and ser defaultas 1
                        $sn = 1;

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the foods from database and display
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //Get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price;?></td>
                                    <td>
                                        <?php
                                            //  <!-- Check whether we have image or not -->
                                             if($image_name == "")
                                             {
                                                    //We do not have image, Display error message
                                                    echo "<div class ='error'>Image not added</div>";
                                             }
                                             else
                                             {
                                                //We have image, display image 
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo$image_name;?>" width="100px">
                                                <?php
                                             }
                                        ?>
                                       
                                    </td>
                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Admin</a>
                                        
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //Food not added in database
                            echo "<tr>
                            <td colspan='7' class='error>
                                Food not Added.
                            </td>
                            </tr>";
                        }
                    

                    ?>

                   
                </table>
                
            </div>
        </div>
        <!-- main content section end -->
        
<?php include('partials/footer.php'); ?> 