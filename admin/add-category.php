<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Category</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30 center">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" class="format-input">
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image" class="format-input">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <div class="format-ip-radio center">
                            <input type="radio" name="featured" value="Yes" placeholder="Yes" checked> Yes
                            <input type="radio" name="featured" value="No" placeholder="No"> No
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <div class="format-ip-radio center">
                            <input type="radio" name="active" value="Yes" placeholder="Yes" checked> Yes
                            <input type="radio" name="active" value="No" placeholder="No"> No
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
    $title = $_POST['title'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    if($_FILES["image"]["name"] != "") {
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
    } else {
        $name = '';
    }
    //insert data to database
    $query = "INSERT INTO tbi_category (title, image_name, featured, active) VALUES (
        '$title',
        '$image_name',
        '$featured',
        '$active')";
    $result = execute($query);
    unset($_POST['submit']);
    unset($_POST['title']);
    unset($_POST['active']);
    unset($_FILES['image']);
    if ($result) {
        $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
        header('Location: '.SITEURL.'admin/manager-category.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
        header('Location: '.SITEURL.'admin/manager-category.php');
    }
}

include('partials/footer.php');
?>