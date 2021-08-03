<?php
include('../config/connect_database.php');
if (isset($_GET)) {
    //get data
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //remove image in food forder
    if ($image_name != "") {
        $path = '../images/food/' . $image_name;
        $remove = unlink($path);
        if ($remove == false) {
            $_SESSION['remove'] = '<div class="error">Faild to Remove Image.</div>';
            header('Location: ' . SITEURL . 'admin/manager-food.php');
            die();
        }
    }
    //delete data fromd database
    $query = "DELETE FROM tbl_food WHERE id=$id";
    $result = execute($query);
    //check execute
    if ($result) {
        //execute successfully
        $_SESSION['delete_food'] = '<div class="success">Delete Food is Successfully.</div>';
        header('Location: ' . SITEURL . 'admin/manager-food.php');
    } else {
        //Faild to Delete Food
        $_SESSION['delete_food'] = '<div class="error">Faild to Delete Food.</div>';
        header('Location: ' . SITEURL . 'admin/manager-food.php');
    }
} else {
    header('Location: ' . SITEURL . 'admin/manager-food.php');
}
