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
            <?php
            if (isset($_SESSION['add_customer'])) {
                echo $_SESSION['add_customer'];
                unset($_SESSION['add_customer']);
            }
            ?>
            <form action="" method="POST">
                <input class="form-group" type="text" name="username" placeholder="Enter Username">
                <br>
                <input class="form-group" type="password" name="password" placeholder="Enter Password">
                <br>
                <div class="row">
                    <a href= <?php echo SITEURL.'Customer/Register.php'; ?> class = "register">Register</a>
                    <a href= <?php echo SITEURL.'Customer/ForgotPassword.php'; ?> class = "forgot">Forgot Password</a>
                </div>
                <br>
                <?php
                if (isset($_SESSION['login-faild'])) {
                    echo $_SESSION['login-faild'];
                    unset($_SESSION['login-faild']);
                }
                ?>
                <input class="submit-login btn-primary" type="submit" name="submit" value="Login" class="btn-primary">
            </form>
        </div>
        <div class="footer-login">
            <p class="text-center">Create By <a href="#">Mai Trong Nhan</a></p>
        </div>
    </div>
</body>
<?php
if (isset($_POST['submit'])) {
    //get data
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //check login
    $query = "SELECT * FROM tbl_customer WHERE customer_name = '$username' AND Password = '$password'";
    $result = executeResult($query);
    //check result
    if (count($result) == 1) {
        //same
        $_SESSION['username'] = $username;
        header('Location: '.SITEURL);
    } else {
        //error
        $_SESSION['login-faild'] = '<div class="error">Faild to Login.</div>';
        header('Location: '.SITEURL.'customer/Login.php');
    }
}
?>

</html>
