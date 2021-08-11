<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manager Food</h1>
        <br />
        <?php
        //check food
        if (isset($_SESSION['add_food'])) {
            echo $_SESSION['add_food'] . '<br/><br/><br/>';
            unset($_SESSION['add_food']);
        }
        //check remove
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'] . '<br/><br/><br/>';
            unset($_SESSION['remove']);
        }
        //check Delete
        if (isset($_SESSION['delete_food'])) {
            echo $_SESSION['delete_food'] . '<br/><br/><br/>';
            unset($_SESSION['delete_food']);
        }
        //check get food from database
        if (isset($_SESSION['no-found'])) {
            echo $_SESSION['no-found'] . '<br/><br/><br/>';
            unset($_SESSION['no-found']);
        }
        //check upload the image
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'] . '<br/><br/><br/>';
            unset($_SESSION['upload']);
        }
        //check update data
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'] . '<br/><br/><br/>';
            unset($_SESSION['update']);
        }
        ?>
        <a href=<?php echo SITEURL . 'admin/add-food.php' ?> class="row-200 btn-primary">Add Food</a>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Description</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            //show list food.
            //get data from database
            $query = "SELECT * FROM tbl_food";
            $result = executeResult($query);
            //format data with catagory
            //sort array with category id
            for ($i = 0; $i < count($result); $i++) {
                for ($j = $i; $j < count($result); $j++) {
                    if ($result[$i]['category_id'] >= $result[$j]['category_id']) {
                        //swap index
                        $temp = $result[$i];
                        $result[$i] = $result[$j];
                        $result[$j] = $temp;
                    }
                }
            }
            //display data
            foreach ($result as $index) {
            ?>
                <tr>
                    <td> <?php echo $index['id']; ?> </td>
                    <td> <?php echo $index['title']; ?> </td>
                    <td> <?php echo $index['description']; ?> </td>
                    <td> <?php echo $index['price']; ?> </td>
                    <td>
                        <?php
                        if ($index['image_name'] != "") {
                            //display the image
                        ?>
                            <img src="<?php echo SITEURL . 'images/food/' . $index['image_name']; ?>" width="100px" alt="">
                        <?php
                        } else {
                            //display the message
                            echo '<div class="error">Image not Added</div>';
                        }
                        ?>
                    </td>
                    <td> <?php echo $index['category_id']; ?> </td>
                    <td> <?php echo $index['featured']; ?> </td>
                    <td> <?php echo $index['active'] ?> </td>
                    <td>
                        <div class="row">
                            <a class="btn-secondary" href=<?php
                                                            //get id and image name
                                                            echo SITEURL . 'admin/update-food.php?id=' . $index['id'];
                                                            ?>>Update Admin</a>
                            <a class="btn-danger" href=<?php
                                                        //get id and image name
                                                        echo SITEURL . 'admin/delete-food.php?id=' . $index['id'] . '&image_name=' . $index['image_name'];
                                                        ?>>Delete Admin</a>
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