<?php include('partials/menu.php') ?>
<!--main content section start-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manager Admin</h1>
        <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'].'<br /><br /><br />';
            unset($_SESSION['add']);
        }
        ?>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Mai Trong Nhan</td>
                <td>TrongNhan</td>
                <td>
                    <a class="btn-secondary">Update Admin</a>
                    <a class="btn-danger">Delete Admin</a>
                </td>
            </tr>

            <?php
            $query = "SELECT * FROM tbl_admin";
            $result = executeResult($query);
            foreach($result as $index) {
                echo ("
                    <tr>
                        <td>".$index['id']."</td>
                        <td>".$index['full_name']."</td>
                        <td>".$index['username']."</td>
                        <td>
                            <a class='btn-secondary'>Update Admin</a>
                            <a class='btn-danger'>Delete Admin</a>
                        </td>
                    </tr>
                ");
            }
            ?>

            <tr>
                <td>1</td>
                <td>Mai Trong Nhan</td>
                <td>TrongNhan</td>
                <td>
                    <a class="btn-secondary">Update Admin</a>
                    <a class="btn-danger">Delete Admin</a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Mai Trong Nhan</td>
                <td>TrongNhan</td>
                <td>
                    <a class="btn-secondary">Update Admin</a>
                    <a class="btn-danger">Delete Admin</a>
                </td>
            </tr>
        </table>
    </div>
</div>
<!--main content section end-->
<?php include('partials/footer.php') ?>