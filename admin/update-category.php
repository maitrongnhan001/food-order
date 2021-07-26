<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Category</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //select data in database
            $query = "SELECT * FROM tbi_category WHERE id = $id";
            $result = executeResult($query);
            if (count($result) == 0) {
                $_SESSION['no-category-found'] = '<div class="error">Category not Found</div>';
                header('Location: '.SITEURL.'admin/manager-category.php');
            }
        } else {
            header('Location: '.SITEURL.'admin/manager-category.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30 center">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" class="format-input"
                            value=<?php echo $result[0]['title'] ?>
                        >
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td>
                        <?php
                            if ($result[0]['image_name'] != "") {
                                //Display the image
                                ?>
                                    <img src=<?php echo SITEURL.'images/category/'.$result[0]['image_name']; ?> width="300em" class="center-image" alt="">
                                <?php
                            } else {
                                //Display message
                                echo' <div class="error text-center">Image not Added.</div>';
                            }
                        ?>
                        <!-- <input type="file" name="image" class="format-input"> -->
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <div class="format-ip-radio center">
                            <input type="radio" name="featured" value="Yes" placeholder="Yes" 
                            <?php 
                            if ($result[0]['featured'] == "Yes") {
                                echo 'checked';
                            }
                            ?>> Yes
                            <input type="radio" name="featured" value="No" placeholder="No"<?php 
                            if ($result[0]['featured'] == "No") {
                                echo 'checked';
                            }
                            ?>> No
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <div class="format-ip-radio center">
                            <input type="radio" name="active" value="Yes" placeholder="Yes" <?php 
                            if ($result[0]['active'] == "Yes") {
                                echo 'checked';
                            }
                            ?>> Yes
                            <input type="radio" name="active" value="No" placeholder="No" <?php 
                            if ($result[0]['active'] == "No") {
                                echo 'checked';
                            }
                            ?>> No
                        </div>
                    </td>
                </tr>
            </table>
            <div class="btn-center center">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    //get data
    $title = $_POST['title'];
    $current_image = $result[0]['image_name'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    //update image
    //check image
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != ""){
            $image_name = $_FILES["image"]["name"];
            //auto rename out image
            //get extension of out image(jpg, png, gif, etc) e.g "abc.jpg"
            $ext = end(explode('.',$image_name));

            //rename the image
            $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
            //e.g: Food_category_002.jpg

            $source_path = $_FILES["image"]["tmp_name"];
            $destination_path = "../images/category/$image_name";
            //finaly upload image
            $upload = move_uploaded_file($source_path, $destination_path);
            //check the whether the image is upload or not
            //and if the image is not upload the we will stop the process and redirect with orror message
            if ($upload == false) {
                //set message
                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                header('Location: '.SITEURL.'admin/manager-category.php');
                //stop the process
                die();
            }
            if ($current_image != "") {
                //remove image
                $path = "../images/category/$current_image";
                $remove = unlink($path);
                //check remove
                if ($remove == false) {
                    $_SESSION['remove'] = "<div class='error'>Faile to Remove current Image.</div>";
                    header('Location: '.SITEURL.'admin/manager-category.php');
                    die();
                } 
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }
    //update database
    $query = "UPDATE tbi_category SET 
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active' 
        WHERE id=$id
    ";
    $result = execute($query);
    //check execute query
    if ($result) {
        //category update
        $_SESSION['update'] = '<div class="success">Category Update Successfully</div>';
        header('Location: '.SITEURL.'admin/manager-category.php');
    } else {
        //category update failed
        $_SESSION['update'] = '<div class="error">Failed to Update Category</div>';
        header('Location: '.SITEURL.'admin/manager-category.php');
    }

}
include('partials/footer.php');
?>