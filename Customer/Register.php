<?php
include('../config/connect_database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-login.css">
    <title>Login - Food Order System</title>
</head>

<body>
    <h1 class="text-center login-header">ONLINE LOGIN FORM</h1>
    <div class="login">
        <div class="form-login">
            <h2>LOGIN FORM</h2>
            <form action="" method="POST">
                <input class="form-group" type="text" name="username" placeholder="Enter Username">
                <br>
                <input class="form-group" type="password" name="password" placeholder="Enter Password">
                <br>
                <input class="form-group" type="password" name="confim-password" placeholder="Confim Password">
                <br>
                <input class="form-group" type="text" name="address" placeholder="Enter Address">
                <br>
                <input class="form-group" type="number" name="age" placeholder="Enter Age">
                <br>
                <div class="row">
                    <input type="radio" name="sex" class="check-sex" placeholder="Choose Sex">Male
                    <input type="radio" name="sex" class="check-sex" placeholder="Choose Sex">Female
                </div>
                <br>
                <br>
                <input class="submit-login btn-primary" type="submit" name="submit" value="Register" class="btn-primary">
            </form>
        </div>
        <div class="footer-login">
            <p class="text-center">Create By <a href="#">Mai Trong Nhan</a></p>
        </div>
    </div>
</body>

</html>