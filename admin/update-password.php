<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Password</h1>
        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <br /><br />
        <form action="" method="POST">
            <table class="tbl-30 center">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" class="format-input" placeholder="Old Password" required></td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" class="format-input" placeholder="New Passowrd" required></td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" class="format-input" placeholder="Confirm Passowrd" required></td>
                </tr>
            </table>
            <div class="btn-center center"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $old_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    unset($_POST['current_password']);
    unset($_POST['current_password']);
    unset($_POST['current_password']);
    //select password
    $query = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$old_password'";
    $result = executeResult($query);
    if (count($result) == 1) {
        if ($new_password == $confirm_password) {
            $query = "UPDATE tbl_admin SET password = '$new_password'";
            $result = execute($query);
            if ($result) {
                $_SESSION['update'] = "<div class = 'success'>Admin update successfully.</div>";
                header('Location:'.SITEURL.'admin/manager-admin.php');
            } else {
                $_SESSION['update'] = "<div class = 'error'>Failed to delete Admin.</div>";
                header('Location:'.SITEURL.'admin/manager-admin.php');
            }
        } else {
            $_SESSION['update'] = "<div class = 'error'>Failed to update Admin.</div>";
            header('Location:'.SITEURL.'admin/manager-admin.php');
        }
    } else {
        $_SESSION['update'] = "<div class = 'error'>Failed to update Admin.</div>";
        header('Location:'.SITEURL.'admin/manager-admin.php');
    }
}

include('partials/footer.php');
?>