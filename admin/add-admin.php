<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Admin</h1>
        <br /><br />
        <form action="" method="POST">
            <table class="tbl-30 center">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name" class="format-input"></td>
                </tr>
                <tr>
                    <td>Usesrname: </td>
                    <td><input type="text" name="username" placeholder="Enter your username" class="format-input"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter your password" class="format-input"></td>
                </tr>
            </table>
            <div class="btn-center center"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></div>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>
<?php
    //process the value from form and save it in database
    //check whether and submit button is clicked or not
    if(isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        unset($_POST['submit']);

        $query = "INSERT INTO tbl_admin (full_name, username, password) VALUES (
            '$full_name',
            '$username',
            '$password')";
        $result = execute($query);
        if($result) {
            $_SESSION['add'] = 'Admin added successfully';
            header('Location: '.SITEURL.'admin/manager-admin.php');
        }else{
            $_SESSION['add'] = 'Failed to Add Admin';
            header('Location: '.SITEURL.'admin/add-admin.php');
        }
    }
?>