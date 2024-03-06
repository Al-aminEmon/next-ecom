<?php
    //Include constsnts.php for SITEURL
    include('./config/constents.php');

    //1.Destory the sesson
    session_destroy();//Unset user

    //2. Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');
?>