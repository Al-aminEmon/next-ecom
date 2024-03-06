<?php
include('./config/constents.php');
include('login_check.php');

?>


<html >
<head>
    <title>Next-Ecommerce-Home Page</title>
    <!-- admin custom css link -->
    <link rel="stylesheet" href="../assets/css/admin.css">
    <!-- font cdn link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap">
</head>
<body>
    <!-- Menu section Start -->
    <div class="menu">
        <div class="wrapper">
            <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage_admin.php">Admin</a></li>
            <li><a href="manage_Category.php">Category</a></li>
            <li><a href="manage_product.php">Product</a></li>
            <li><a href="manage_order.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu section End -->