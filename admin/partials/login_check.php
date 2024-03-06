<?php
    //Anthorization - Access Control

    //Check Whether the user is logged in or not
    if(!isset($_SESSION['user']))
    {
        //User is not loged in
        //Redirect to login page With message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";

        //Redirect too Login Page
        header('location:'.SITEURL.'admin/login.php');
    }
?>