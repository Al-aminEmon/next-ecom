<?php include("partials/menu.php")?>
    <!-- Mein Content section Start -->
    <div class="mains-content">
        <div class="wrapper">
            <h1>Manage Product</h1>
            <br><br>

            <!-- button to add admin -->
            <a href="<?php echo SITEURL;?>admin/add_product.php" class="btn-primary">Add Product</a>
            <br><br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>




            <table class="tbl-full" >
                <tr class="tvl-row">
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php
                    //Create SQL Query to get all the product
                    $sql = "SELECT * FROM tbl_product";

                    //Exicute The Query 
                    $res = mysqli_query($conn,$sql);

                    //Count Rows to check whether we have product or not
                    $count = mysqli_num_rows($res);


                    //Create Serial Numbar Variable and Set Defolt Valu as 1
                    $sn=1;
                    
                    if($count>0)
                    {
                        //we have product in Database
                        //Get the Product from Database and Display

                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get the values feom individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>

                            <tr class="tvl-row">
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php
                                        //Check Whether We have Image or not 
                                        if($image_name=="")
                                        {
                                            //We don't Have Image Display Error Message 
                                            echo "<div class='error'>Image not Added.</div>";
                                        }
                                        else
                                        {
                                            //We have Image,Display Image
                                            ?>
                                            <img src="<?php echo SITEURL; ?> ../assets/imgs/product/<?php echo $image_name;?>" width="100px">
                                            <?php

                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="#" class="btn-secondary">Update Product</a>
                                    <a href="#" class="btn-danger">Delete Product</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        //Product not Added in Database
                        echo "<tr><td colspan='2' class='error'>Product not Added Yet.</td></tr>";
                    }

                
                ?>
                
                
            </table>
            
        </div>
    </div>
    <!-- Mein Content section End -->

    <?php include('partials/footer.php') ?>
