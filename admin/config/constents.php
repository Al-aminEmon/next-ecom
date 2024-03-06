<?php

// session_start
session_start();


//create constents to stor none repeating values
define('SITEURL','http://localhost/next-Ecommerce-Templete/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ecommerce_data');


$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());  //Select Database


?> 