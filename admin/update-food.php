<?php
ob_start();
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Food</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //select data in database
            $query = "SELECT * FROM tbl_food WHERE id = $id";
            $result = executeResult($query);
            if (count($result) == 0) {
                $_SESSION['no-found'] = '<div class="error">Food not Found</div>';
                header('Location: ' . SITEURL . 'admin/manager-food.php');
            }
            $index = $result[0];
        } else {
            header('Location: ' . SITEURL . 'admin/manager-category.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30 center">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food" class="format-input" value=<?php echo $index['title']; ?>>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="10" placeholder="Desription of the Food" class="format-textarea"><?php echo $index['description']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" class="format-input" value=<?php echo $index['price']; ?>>
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td>
                        <?php
                        if ($index['image_name'] != "") {
                            //Display the image
                        ?>
                            <img src=<?php echo SITEURL . 'images/food/' . $index['image_name']; ?> width="300em" class="center-image" alt="">
                        <?php
                        } else {
                            //Display message
                            echo ' <div class="error text-center">Image not Added.</div>';
                        }
                        ?>
                        <!-- <input type="file" name="image" class="format-input"> -->
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image" class="format-input">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" class="format-input">
                            <?php
                            //select data from database
                            $query = "SELECT * FROM tbi_category WHERE active='Yes'";
                            $result = executeResult($query);
                            if (count($result) > 0) {
                                foreach ($result as $element) {
                            ?>
                                    <option value=<?php echo $element['id'] ?> <?php if ($index['category_id'] == $element['id']) {
                                                                                    echo 'selected';
                                                                                } ?>> <?php echo $element['title'] ?> </option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value='0'> No Category Found </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <div class="format-ip-radio center">
                            <input type="radio" name="featured" value="Yes" <?php
                                                                            if ($index['featured'] == 'Yes') {
                                                                                echo 'checked';
                                                                            }
                                                                            ?>>Yes
                            <input type="radio" name="featured" value="No" <?php
                                                                            if ($index['featured'] == 'No') {
                                                                                echo 'checked';
                                                                            }
                                                                            ?>>No
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <div class="format-ip-radio center">
                            <input type="radio" name="active" value="Yes" <?php
                                                                            if ($index['active'] == 'Yes') {
                                                                                echo 'checked';
                                                                            }
                                                                            ?>>Yes
                            <input type="radio" name="active" value="No" <?php
                                                                            if ($index['active'] == 'No') {
                                                                                echo 'checked';
                                                                            }
                                                                            ?>>No
                        </div>

                    </td>
                </tr>
            </table>
            <div class="btn-center center">
                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    //get data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $index['image_name'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //update image

    //check image
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            //auto rename the image
            $ext = end(explode('.', $image_name));

            //rename the image
            $image_name = 'Food_Name_' . rand(0000, 9999) . '.' . $ext;

            //upload the image
            $source = $_FILES['image']['tmp_name'];
            $destination = '../images/food/' . $image_name;
            $upload = move_uploaded_file($source, $destination);
            unset($_FILES['image']);
            //check upload
            if ($upload == false) {
                $_SESSION['upload'] = '<div class="error">Faild to Upload Image.</div>';
                header('Location: ' . SITEURL . 'admin/manager-food.php');
                //stop process
                die();
            }

            if ($current_image != "") {
                //remove the current image
                $path = '../images/food/' . $current_image;
                $remove = unlink($path);

                //check remove
                if ($remove == false) {
                    $_SESSION['remove'] = '<div class="error">Faild to Remove Current Image.</div>';
                    header('Location: ' . SITEURL . 'admin/manager-food.php');
                    //stop process
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }
    //update data to database
    $query = "UPDATE tbl_food SET
        title='$title',
        description='$description',
        price='$price',
        image_name='$image_name',
        category_id=$category,
        featured='$featured',
        active='$active'
        WHERE id = $id";
    $result = execute($query);
    //unset data
    unset($_POST['title']);
    unset($_POST['description']);
    unset($_POST['category']);
    unset($_POST['featured']);
    unset($_POST['active']);
    //check $result
    if ($result) {
        //food updated
        $_SESSION['update'] = '<div class="success">Food Update Successfully.</div>';
        header('Location: '. SITEURL . 'admin/manager-food.php');
    } else {
        //food updated
        $_SESSION['update'] = '<div class="error">Faild to Update Food.</div>';
        header('Location: '. SITEURL . 'admin/manager-food.php');
    }
}
include('partials/footer.php');
?>