<?php
include('../config/connect_database.php');
include('check-login.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
</head>

<body>
    <!--menu section start-->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manager-admin.php">Admin Manager</a></li>
                <li><a href="manager-category.php">Category</a></li>
                <li><a href="manager-food.php">Food</a></li>
                <li><a href="manager-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!--menu section end-->