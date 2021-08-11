<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manager Categogy</h1>
        <br />
        <?php
        //check session create admin
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'] . '<br /><br /><br />';
            unset($_SESSION['add']);
        }
        //check message upload file
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'] . '<br /><br /><br />';
            unset($_SESSION['upload']);
        }
        //check remove image
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'] . '<br /><br /><br />';
            unset($_SESSION['remove']);
        }
        //check remove image
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'] . '<br /><br /><br />';
            unset($_SESSION['delete']);
        }
        //check get category
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'] . '<br /><br /><br />';
            unset($_SESSION['no-category-found']);
        }
        //check update category
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'] . '<br /><br /><br />';
            unset($_SESSION['update']);
        }
        ?>

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="row-200 btn-primary">Add Category</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            //selete table category
            $query = "SELECT * FROM tbi_category";
            //execute
            $result = executeResult($query);
            foreach ($result as $index) {

            ?>
                <tr>
                    <td><?php echo $index['id']; ?></td>
                    <td><?php echo $index['title']; ?></td>
                    <td>
                        <?php
                        if ($index['image_name'] != "") {
                            //display the image
                        ?>
                            <img src="<?php echo SITEURL . 'images/category/' . $index['image_name']; ?>" width="100px" alt="">
                        <?php
                        } else {
                            //display the message
                            echo '<div class="error">Image not Added</div>';
                        }
                        ?>
                    </td>
                    <td><?php echo $index['featured']; ?></td>
                    <td><?php echo $index['active']; ?></td>
                    <td>
                        <div class="row">
                            <a class="btn-secondary" href=<?php echo SITEURL . 'admin/update-category.php?id=' . $index['id']; ?>>Update Category</a>
                            <a class="btn-danger" href=<?php echo SITEURL . 'admin/delete-category.php?id=' . $index['id'] . '&image_name=' . $index['image_name']; ?>>Delete Category</a>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php') ?>