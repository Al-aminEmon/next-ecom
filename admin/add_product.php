<?php include("partials/menu.php");?>

    <!-- Mein Content section Start -->
    <div class="mains-content">
        <div class="wrapper">
            <h1>Add Product</h1>

            <br><br>

            <?php
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

../assets/imgs/product


            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-03">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Title of the Product">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description"  cols="25" rows="5" placeholder="Description of the Product."></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                <?php
                                    ///Create PHP Code to display Categoris form Database
                                    //1.Create SQL to get all active categoris from Database
                                    $sql = "SELECT * FROM tbl_category WHERE active='YES'";

                                    //Exicuting Query
                                    $res = mysqli_query($conn,$sql);

                                    //Count Rows to check Whether we have Categories or not 
                                    $count = mysqli_num_rows($res);

                                    //IF count is gerater then Zero, we have categories else we donot have categories
                                    if($count>0)
                                    {
                                        //we have categories
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get the deteails of categories
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            
                                            ?>
                                            <option value="<?php echo $id;?>"><?php echo $title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //We do not have category
                                         ?> 
                                            <option value="0">No Category Found</option>
                                         <?php
                                    }

                                    //2.Display on Dropdown
                                
                                ?>

                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Product" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            
            <?php
                ///Check Whether the button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Add the Profuct in Database
                    // echo 'Clicked';

                    //1.Get the Data from form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    //Check Whether radion button for featured and active are checked or not
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";//Setting the Default Value
                    }

                    // Change this line
                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No"; // Change "no" to "No" to match the default value in the database
                    }

                    //2.Upload the image if selected
                    //Check whether the select image is clicled or not  and upload the image only if the image is selected
                    if(isset($_FILES['image']['name']))
                    {
                        ///Get the details of the selected image 
                        $image_name = $_FILES['image']['name'];
                        
                        //Check whether the image is Selected or not and uplode image only if selected
                        if($image_name!="")
                        {
                            //Image is selected 
                            //a. Rename the image
                            // Get the extension of the selected image (jpg, png, gif, etc)
                            $extArray = explode('.', $image_name);
                            $ext = end($extArray);

                        
                            //Create New Name for Image
                            $image_name = "Nest_Ecommerce_Prod-".rand(000,999).'.'.$ext;//New Image Name May be "Nest_Ecommerce_Prod-122.jpg"
                            
                            //b.Update the Image 
                            //Get the src path and Destination Path

                            //Source path is the current location of the image
                            $src = $_FILES['image']['tmp_name'];

                            //Destination path for the image to upload
                            $dst = "assets/imgs/product/".$image_name; // Remove the extra space before $image_name
                            
                            //Finaly upload the product image
                            $upload = move_uploaded_file($src,$dst);

                            //Check Whether Image Uploaded or not 
                            if($upload==false)
                            {
                                //Faild to upload the image 
                                //Redirect to add Product Page With Error Message 
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                                header('location:'.SITEURL.'admin/add_product.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = "";//Setting Default value as blank 
                    }

                    //3.Insert into Database

                    //Create a Sql Query to Save or Add Product 
                    //for a num valo we do not need ''/"".
                    // Code for adding a product
                    $sqli = "INSERT INTO tbl_product SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    // ... (uploading image and executing the query)


                    //3.Exicute the query and save in Database
                    $res2 = mysqli_query($conn, $sqli);

                    // Check whether the query executed or not and data added or not
                    if ($res2 == true) {
                        // Query executed and product added successfully
                        $_SESSION['add'] = "<div class='succes'>Product Added Successfully.</div>";
                        // Redirect to Manage Product Page
                        header('location:'.SITEURL.'admin/manage_Product.php');
                    } else {
                        // Failed to add product
                        $_SESSION['add'] = "<div class='error'>Failed to Add Product.</div>";
                        // Redirect to Manage Product Page
                        header('location:'.SITEURL.'admin/manage_Product.php');
                    }
                    
                }
            ?>
        </div>
    </div>
<?php include("partials/footer.php");?>
