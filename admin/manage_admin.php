<?php include("partials/menu.php");?>


    <!-- Mein Content section Start -->
    <div class="mains-content">
        <div class="wrapper">
            <h1>Manage Admin </h1>
            <br><br>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; //Display session Message
                    unset($_SESSION['add']); //Remove session Message
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }

                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }

            
            ?>

            <br><br>

            <!-- Button to add Admin -->
            <a href="add_admin.php" class="btn-primary">Add Admin</a>
            
            <br><br>
            
            <table class="tbl-full" >
                <tr class="tvl-row">
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>

                <?php
                    //query to get all Admin
                    $sql = "SELECT * FROM tbl_admin";
                    //Exicute the Query
                    $res = mysqli_query($conn, $sql);

                    //Chack wathar the query is exicute of Not
                    if($res==TRUE)
                    {
                        //Count Rows to check whether we have data in database os not
                        $count = mysqli_num_rows($res); //Function To get all the rows in database

                        $sn=1; //create a Variable and Assign the Value

                        //chack the num of row
                        if($count>0)
                        {
                            // we have data in databse
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //Using While loop to get all the data form database.
                                //and while loop will run as long as we have data in databse

                                //get individual data 
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //Display the value in our Table
                                ?>
                                
                                <tr class="tvl-row">
                                    <td><?php echo $sn++ .'.' ; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else
                        {
                            //We do not have data in database
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- Mein Content section End -->

    <?php include('partials/footer.php') ?>