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
                <input class="form-group" type="password" id="pw" name="password" placeholder="Enter Password">
                <br>
                <input class="form-group" type="password" id="cpw" name="confim-password" placeholder="Confim Password">
                <div class="error" id="message_pwd"></div>
                <br>
                <input class="form-group" type="text" name="address" placeholder="Enter Address">
                <br>
                <input class="form-group" type="number" name="age" placeholder="Enter Age">
                <br>
                <div class="row">
                    <input type="radio" name="sex" class="check-sex" placeholder="Choose Sex" value="male" checked>Male
                    <input type="radio" name="sex" class="check-sex" placeholder="Choose Sex" value="famale">Female
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
<?php
//check data
if (isset($_POST['submit'])) {
    require('../Debug/Debug.php');
    //get data
    $customer_name = $_POST['username'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    //store data to database
    $query = "INSERT INTO tbl_customer (
        customer_name,
        Address,
        Age,
        Password,
        sex
    )
    VALUES (
        '$customer_name',
        '$address',
        $age,
        '$password',
        '$sex'
    )";
    $resulf = execute($query);
    //check execute
    if ($resulf) {
        $_SESSION['add_customer'] = '<div class="success">Add Customer Successfully.</div>';
        header('Location: '.SITEURL.'Customer/Login.php');
    } else {
        $_SESSION['add_customer'] = '<div class="error">Faild to Add Customer.</div>';
        header('Location: '.SITEURL.'Customer/Login.php');
    }
}
?>
<script src="../App/CheckPassword.js"></script>
</html>