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
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'].'<br>';
                    unset($_SESSION['login']);
                }
            ?>
            <form action="" method="POST">
                <input class="form-group" type="text" name="username" placeholder="Enter Username">
                <br>
                <input class="form-group" type="password" name="password" placeholder="Enter Password">
                <br>
                <input class="submit-login btn-primary" type="submit" name="submit" value="Login" class="btn-primary">
            </form>
        </div>
        <div class="footer-login">
            <p class="text-center">Create By <a href="#">Mai Trong Nhan</a></p>
        </div>
    </div>
</body>

</html>
<?php
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //check login
    $username = clearStringSql($username);
    $password = clearStringSql($password);
    $query = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
    $result = executeResult($query);
    if(count($result) == 1) {
        $_SESSION['username'] = $username;
        header('Location:'.SITEURL.'admin/');
    }else{
        $_SESSION['login'] = "<div class='error'>Username or Password is not match</div>";
        header('Location:'.SITEURL.'admin/login.php');
    }
}
?>