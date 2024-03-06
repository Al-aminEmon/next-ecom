<!-- <?php
    // include Constents.php file hear
   include('./config/constents.php');
    //1. get the ID of Admin to be delited
   $id = $_GET['id'];

    //2. Create SQL Query to Delite Admin 
  $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Exicute the Query
    $res = mysqli_query($conn, $sql);

    //Chack Wathear the query exicuted successfully or not
    if($res==true)
    {
        //Query exicuted successfully and add admin Deleted
        // echo "Admin Deleted";     
        //Creat Sesson variable To display message
        $_SESSION['delete'] = "<div class='succes'>Admin Deleted Successfully.</div>";
        //Redirect to Manage Admin page
        header('location:'.SITEURL.'admin/manage_admin.php');
    }
    else
    {
        //Faild to Delete Admin
        // echo "Failed to Delete Admin";
        $_SESSION['delete']= "<div class='error'> Faild to Delete Admin. try Again Leter.</div>";
        header('location:'.SITEURL.'admin/manage_admin.php');
    }

    //3. Redirect to Manage Admin with message (success/error)



?> 