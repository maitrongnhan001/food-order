<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Admin</h1>

        <br /><br />

        <?php
        //get id
        $id = $_GET['id'];
        //execute query
        $query = "SELECT * FROM tbl_admin WHERE id = $id";
        $result = executeResult($query);
        if (count($result) == 1) {
            //get data
            $full_name = $result[0]['full_name'];
            $username = $result[0]['username'];
        } else {
            header('Location:'.SITEURL.'admin/manager-admin.php');
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30 center">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" class="format-input" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Usesrname: </td>
                    <td><input type="text" name="username" class="format-input" value="<?php echo $username; ?>"></td>
                </tr>
            </table>
            <div class="btn-center center"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></div>
        </form>
    </div>
</div>

<?php
if($_POST['full_name'] != $full_name && $_POST['username'] != $username) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    //update data
    $query = "UPDATE tbl_admin SET
                    full_name = '$full_name',
                    username = '$username'
                WHERE id = '$id'
    ";
    $result = execute($query);
    //check execute
    if ($result) {
        $_SESSION['update'] = "<div class = 'success'>Admin update successfully.</div>";
        header('Location:'.SITEURL.'admin/manager-admin.php');
    } else {
        $_SESSION['update'] = "<div class = 'error'>Failed to delete Admin.</div>";
        header('Location:'.SITEURL.'admin/manager-admin.php');
    }
}

include('partials/footer.php');
?>