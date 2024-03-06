<?php include("partials/menu.php");?>

<div class="mains-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br> <br>

        <?php
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the is and other Detals
                //echo "Getting The Data";
                $id = $_GET['id'];
                
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                
                //Exicute the Query
                $res = mysqli_query($conn,$sql);

                //Count the Rows to check whether the id is Valid or not
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redirect to Manage Category with Session Message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'admin/manage_Category.php');
                }
            }   
            else
            {
                //Redirect to Manage Category
                header('location:'.SITEURL.'admin/manage_category.php');

            }     
        
        
        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-03">
                <tr>
                    <td>
                        Title:
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if($current_image != "")
                        {
                            //Display the image
                            ?>
                            <img src= "<?php echo SITEURL; ?>assets/imgs/category/<?php echo $current_image; ?>" width="150px">

                            <?php
                        }
                        else
                        {
                            //Display Message
                            echo "<div class='error'>Image not Added </div>";
                        }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Fearured:</td>
                    <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                // echo "Clicked";
                //1.Get all the values from our form

                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2.Updating New Image if selected
                //Check Whether  the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details 
                    $image_name = $_FILES['image']['name'];

                    //Check Whether the image is available or not
                    if($image_name!="")
                    {
                        ///Image Available

                        //A. Upload the New Image
                        //Auto Rename Our Image
                        //Get the Extension of our image (jpg,png,gif,etc) e.g. "special.product1.jpg"
                        $ext = end(explode('.',$image_name));

                        //Rename the image
                        $image_name="Nest_Ecommerce_".rand(000,999).'.'.$ext; //e.g. Product_Catagory_834.jpg
                        

                        $source_path =$_FILES['image']['tmp_name'];

                        $destination_path ="../assets/imgs/category/".$image_name;

                        // Finaly Upload the Image 
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check Whether the Image is upload or not
                        // And if the image is not uploaded, then we will stop the process and redirect with an error message
                        if ($upload==false) 
                        {
                            // Set message 
                            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image.</div>";

                            // Redirect to Add Category Page
                            header('location:'.SITEURL.'admin/manage_category.php');

                            // Stop the process
                            die();
                        }
                        // B. Remove the current Image if available
                        if ($current_image != "") {
                            $remove_path = "../assets/imgs/category/" . $current_image;
                            $remove = unlink($remove_path);

                            // Check whether the image is removed or not
                            // If failed to remove, then display message and stop the process
                            if ($remove == false) {
                                // Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:' . SITEURL . 'admin/manage_category.php');
                                die(); // Stop the Process
                            }
                        }


                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;

                }


                //3.Updated the Database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id='$id'                    
                ";
                

                //Exicute the query 
                $res2 = mysqli_query($conn,$sql2);

                //4.Redirect to Manage Category with Message
                //Check Whether exicute or not

                if($res2==true)
                {
                    //Category Update
                    $_SESSION['update'] = "<div class='succes'>Category Update Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');
                }
                else
                {
                    //FAiled to Update Category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage_category.php');

                }

            }

        ?>

    </div>
</div>

<?php include("partials/footer.php");?>

