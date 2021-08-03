<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Food</h1>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'] . '<br/><br/><br/>';
            unset($_SESSION['upload']);
        }
        ?>
        <br /><br />
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30 center">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food" class="format-input">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="10" placeholder="Desription of the Food" class="format-textarea"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" class="format-input">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
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
                                foreach ($result as $index) {
                            ?>
                                    <option value=<?php echo $index['id'] ?>> <?php echo $index['title'] ?> </option>
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
                            <input type="radio" name="featured" value="Yes" checked>Yes
                            <input type="radio" name="featured" value="No">No
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <div class="format-ip-radio center">
                            <input type="radio" name="active" value="Yes" checked>Yes
                            <input type="radio" name="active" value="No">No
                        </div>

                    </td>
                </tr>
            </table>
            <div class="btn-center center">
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    //get data from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    //upload the image
    if (isset($_FILES['image']['name'])) {
        //get the details the select
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            //rename the image
            $ext = end(explode('.', $image_name));
            //create new name for image
            $image_name = 'Food-Name-' . rand(0000, 9999) . '.' . $ext;
            //source path of the image
            $src = $_FILES['image']['tmp_name'];
            //detination path of the image
            $dst = "../images/food/" . $image_name;
            //upload
            $upload = move_uploaded_file($src, $dst);
            unset($_FILES['image']);
            if ($upload == false) {
                //failed to upload image
                $_SESSION['upload'] = '<div class="error text-center">Failed to Upload Image</div>';
                header('Location: ' . SITEURL . 'admin/add-food.php');
                //stop process
                die();
            }
        } else {
            $image_name = "";
        }
    }
    //insert to database
    $query = "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active) VALUES (
        '$title',
        '$description',
        '$price',
        '$image_name',
        $category,
        '$featured',
        '$active')";
    //execute query
    $result = execute($query);
    //unset data
    unset($_POST['title']);
    unset($_POST['description']);
    unset($_POST['category']);
    unset($_POST['featured']);
    unset($_POST['active']);
    if ($result) {
        $_SESSION['add_food'] = '<div class="success">Added Food successfully</div>';
        header('Location: '. SITEURL . 'admin/manager-food.php');
    } else {
        $_SESSION['add_food'] = '<div class="error">Faild to added Food</div>';
        header('Location: '. SITEURL . 'admin/manager-food.php');
    }
}
include('partials/footer.php');
?>