<?php include('partials/menu.php');?>

<div class="mains-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br><br>

        <?php
            //1.Get the ID of Selected Admin
            $id=$_GET['id'];

            //2.Qureat SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Exicute the Query 
            $res=mysqli_query($conn, $sql);

            //Chack Whether the query is wxicuted or not
            if($res==true)
            {
                //check wherther the data is available or not
                $count = mysqli_num_rows($res);
                //Chack whether we have admin data or not
                if($count==1)
                {
                    //Get the Details 
                    // echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else{
                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage_admin.php'); 
                }
            }
            
        ?>


        <form action="" method="POST">

            <table class="tbl-03">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" Value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Apdate Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    //Chack Whether the Submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // echo "Button Clicked";
        //Get all the values from form to Update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_admin SET 
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'
    ";


        //Exicute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Exicuted and Admin Updated 
            $_SESSION['update'] = "<div class='succes'> Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
        else
        {
            //Faild to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage_admin.php');
        }

    }


?>

<?php include('partials/footer.php');?>