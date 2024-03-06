<?php include("partials/menu.php")?>

<div class="mains-content">
        <div class="wrapper">
            <h1>Manage Categories </h1>

            <br><br>
            <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                
                if(isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }

                

            ?>
            <br><br>
            <!-- button to add admin -->
            <a href="<?php echo SITEURL ?>admin/add_category.php" class="btn-primary">Add Categories</a>

            <br><br>

            <table class="tbl-full" >
                <tr class="tvl-row">
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php

                    //Query to Get all categories from Database
                    $sql = "SELECT * FROM tbl_category";

                    ///Exicute Query 
                    $res = mysqli_query($conn, $sql);

                    //Counr Rows 
                    $count = mysqli_num_rows($res);

                    //Create Serial Number Variable And assign value as 1
                    $sn = 1 ;
                    
                    //Check whether we have data us database or not
                    if($count>0)
                    {
                        //we have data in database
                        //get the data and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                           ?>
                                <tr class="tvl-row">
                                    <td><?php echo $sn++ .'.'?></td>
                                    <td><?php echo $title;?></td>

                                    <td>
                                        <?php 
                                            //Check Whether Image name is Availabale or not 
                                            if($image_name!="")
                                            {
                                                //Display The Image
                                                ?>
                                                    <img src= "<?php echo SITEURL; ?>assets/imgs/category/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            } 
                                            else
                                            {
                                                //Display the Message
                                                echo "<div class='error'> Image Not Added.</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featured;?></td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL;?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr>

                           <?php

                        }
                    }
                    else
                    {
                        //We do not have data  
                        //We'll Display the message insite table
                        ?>

                            <tr>
                                <td colspen="6">
                                    <div class="error">No Category Added.</div>
                                </td>
                            </tr>

                        <?php 

                    }

                
                ?>


                
            </table>
            
        </div>
    </div>


<?php include('partials/footer.php') ?>