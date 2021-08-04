<?php
include('../config/connect_database.php');
if (isset($_GET['id']) AND isset($_GET['image_name'])) {
    //get value
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove physical image file is available
    if ($image_name != "") {
        //Reomve it
        $path = '../images/category/'.$image_name;
        $remove = unlink($path);
        //check remove
        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Faile to Remove Category Image.</div>";
            header('Location: '.SITEURL.'admin/manager-category.php');
            die();
        }
    }
    //Remove data in database
    $query = "DELETE FROM tbi_category WHERE id = $id";
    $result = execute($query);
    //check execute
    if ($result) {
        $_SESSION['delete'] = "<div class='success'>Category Delete Successfully.</div>";
        header('Location: '.SITEURL.'admin/manager-category.php');
    } else {
        $_SESSION['remove'] = "<div class='error'>Faile to Delete Category.</div>";
        header('Location: '.SITEURL.'admin/manager-category.php');
    }
} else {
    header('Location: '.SITEURL.'admin/manager-category.php');
}
?>