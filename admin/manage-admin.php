<?php include('partials/menu.php'); ?>
       
        
         <!-- main content section starts -->
         <div class="main-content">
            <div class="wrapper">
                <h1>manager</h1>
                <br/> 
                
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];  //Displaying Session Message
                        unset($_SESSION['add']); //Removeing Session MEessage
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];  //Displaying Session Message
                        unset($_SESSION['delete']); //Removeing Session MEessage
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];  //Displaying Session Message
                        unset($_SESSION['update']); //Removeing Session MEessage
                    }
                ?>
                <br/> <br/> <br/>

                <!-- button to add Admin -->
                <a href="add-admin.php" class="btn-primary">Add admin</a>
                
                <br/> <br/> <br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    //Query to get adll admin
                        $sql = "SELECT* FROM tbl_admin";

                        //excute the quey
                        $res = mysqli_query($conn, $sql);

                        //Check whether the Querry is Executed of Not
                        if($res==TRUE){
                            //Count Rows to Check whether we have data in database or not
                            $count = mysqli_num_rows($res); // Funtion to get a;; the rows in database

                            $sn=1; //Create a variable
                            //Check the num of rows;
                            if($count>0)
                            {
                                //we have data in database
                                while($row = mysqli_fetch_assoc($res)){
                                    //Using while loop to get all the data from database
                                    //And while loop will run as long as we have data in database

                                    //Get individual Data
                                    $id=$row['id'];
                                    $full_name = $row['full_name'];
                                    $username = $row['username'];
            
                                    //Display the values in our table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            else{
                                //We do not have data in database
                            }
                        }

                    ?>


                </table>
                
            </div>
        </div>
        <!-- main content section end -->

<?php include('partials/footer.php'); ?>  