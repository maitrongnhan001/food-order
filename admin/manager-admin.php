<?php include('partials/menu.php') ?>
<!--main content section start-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manager Admin</h1>
        <br />
        <?php
        //check session create admin
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'] . '<br /><br /><br />';
            unset($_SESSION['add']);
        }
        //check session delete admin
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'] . '<br /><br /><br />';
            unset($_SESSION['delete']);
        }
        //check session update admin
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'] . '<br /><br /><br />';
            unset($_SESSION['update']);
        }
        ?>
        <a href="add-admin.php" class="row-200 btn-primary">Add Admin</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
            $query = "SELECT * FROM tbl_admin";
            $result = executeResult($query);
            foreach ($result as $index) {
                $Delete_Url = SITEURL . 'admin/delete-admin.php?id=' . $index['id'];
                $Update_Url = SITEURL . 'admin/update-admin.php?id=' . $index['id'];
                $ChangePass_Url = SITEURL . 'admin/update-password.php?id=' . $index['id'];
            ?>
                <tr>
                    <td><?php echo $index['id'] ?></td>
                    <td><?php echo $index['full_name'] ?></td>
                    <td><?php echo $index['username'] ?></td>
                    <td>
                        <div class="row">
                            <a class='btn-primary' href=<?php echo $ChangePass_Url ?>>Update Password</a>
                            <a class='btn-secondary' href=<?php echo $Update_Url ?>>Update Admin</a>
                            <a class='btn-danger' href=<?php echo $Delete_Url ?>>Delete Admin</a>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
<!--main content section end-->
<?php include('partials/footer.php') ?>