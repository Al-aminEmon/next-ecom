<?php

    //Include Constents File 
    include('./config/constents.php');

    //Check Whether the id and image_name value is set or not

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and Delete
        // echo "Get Value and Delete";
        $id =$_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the Physicle image file is available
        if($image_name != "")
        {
            //Image is Available.So remove it
            $path ="../assets/imgs/category/".$image_name;

            //Remove the image 
            $remove = unlink($path);
            
            //If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the Session Message 
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";

                //Redirect to Manage Category Page
                header('location:'.SITEURL.'admin/manage_category.php');
                
                //Stop the Process
                die();
            }
        }

        //Delete Data From Database 
        //SQL Query to delete Data form Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Exicute the Query
        $res = mysqli_query($conn,$sql);

        //Check Whether the Data is delete from database or not
        if($res==true)
        {
            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='succes'>Category Deleted Successfull.</div>";
            //Redirect to Manage Category 
            header('location:'.SITEURL.'admin/manage_category.php');
        } 
        else
        {
            //Set Fail Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //Redirect to Manage Category 
            header('location:'.SITEURL.'admin/manage_category.php');
        }


    }
    else
    {
        ///Redirect to Manage Category Page
        header('location'.SITEURL.'admin/manage_Category.php');
    }


?>