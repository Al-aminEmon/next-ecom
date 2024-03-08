<?php include('partials/menu.php'); ?>

<div class="mains-content">
    <div class="wrapper">
        <h1> Add Category</h1>
        
        <br> <br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>
        <br><br>

        <!-- Add category Form Starts  -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-03">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Cutagory Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image </td>
                    <td class="cate-td">
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td class="cate-td">                      
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td class="cate-td">
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspsn="2">
                        <input type="submit" class="btn-secondary" action="" name="submit" value="Add Category">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category Form Ends  -->
        <?php

            //Check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // echo"clicked";

                //1.Get the value from Caregory Form
                $title =$_POST['title'];

                //For Radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //Get the Value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Select the Default Value
                    $featured = "no";
                }
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "no";
                }

                ///Check Whether the image is seleectd or not and Set value for image name accoridingly
                // print_r($_FILES['image']);

                //die(); //Brack The Code Here

                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image
                    //To upload Image we need Image_name , Source_path and Destination_path
                    $image_name = $_FILES['image']['name'];

                    //Upload the Image only if image selected
                    if($image_name != "")
                    {
                        //Auto Rename Our Image
                        //Get the Extension of our image (jpg,png,gif,etc) e.g. "special.product1.jpg"
                        $ext = end(explode('.',$image_name));

                        //Rename the image
                        $image_name="Nest_Ecommerce_".rand(000,999).'.'.$ext; //e.g. Product_Catagory_834.jpg
                        

                        $source_path =$_FILES['image']['tmp_name'];

                        $destination_path ="assets/imgs/product".$image_name;

                        // Finaly Upload the Image 
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check Whether the Image is upload or not
                        // And if the image is not uploaded, then we will stop the process and redirect with an error message
                        if ($upload==false) 
                        {
                            // Set message 
                            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image.</div>";

                            // Redirect to Add Category Page
                            header('location:'.SITEURL.'admin/add_category.php');

                            // Stop the process
                            die();
                        }
                    }
                }
                else
                {
                    ///Don't Upload image and set the Image name value as black
                    $image_name="";
                }

                //2.Create SQL Query to Insert Category into Database
                $sql ="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                //3.Exicute the query and save in Database
                $res = mysqli_query($conn,$sql);

                //4.Check whether the query exicuted or not and data added or not 
                if($res==true)
                {
                    //Query Exicute and Category Added
                    $_SESSION['add'] = "<div class='succes'>Category Added Successfully.</div>";
                    //Redirect to Manage Catagory Page
                    header('location:'.SITEURL.'admin/manage_Category.php');
                }
                else
                {
                    //Failed to Add Category 
                    $_SESSION['add'] = "<div class='error'>Failed to Added Category. </div>";
                    //Redirect to Manage Catagory Page
                    header('location:'.SITEURL.'admin/add_category.php');
                }
            }
        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
