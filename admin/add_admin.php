<?php include('partials/menu.php'); ?>


<div class="mains-conten">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
            <?php
            if(isset($_SESSION['add'])) //Checking whether the session is set of not
            {
                echo $_SESSION['add']; //Display the session message if set 
                unset($_SESSION['add']); //Remove session message 
            }
            
            ?>



            <!-- Add admin form -->
        <form action="" method="POST">        
            <table class="tbl-03" >
                <tr>
                    <td  style="">Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td style="">Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Your username">
                    </td>
                </tr>
                <tr>
                    <td style="">Password</td>
                    <td>
                        <input type="password" name="Password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                 </tr>
            </table> 
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php
//Process the Value form Form and Save it in Database

//Check whether the submit button is clicked or not 

    if(isset($_POST['submit'])) 
    {
        // Button clicked
        // echo "Button Clicked";

        //1.Get the Data form Form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['Password']); //password encryption with md5

        //2.SQL Query to save the data info database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password' 
        ";

        //3. Executing Query to Saving Data into Database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check Whethar the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            // Data Insarted
            // echo "Data Inserted";

            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='succes'>Admin Added Successfully</div>";
            // Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage_admin.php');
        }
        else
        {
            // Failed to Insart Data
            // echo "Faile to Insart Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class= 'error'>Faile to Add Admin</div";
            // Redirect Page to add Admin
            header("location:".SITEURL.'admin/add_admin.php');

        }
    }

    

?>