<?php
include('../config/connect_database.php');
//get id send from form admin
$id = $_GET['id'];
//query delete admin
$query = "DELETE FROM tbl_admin WHERE id = $id";
//execute
$respone = execute($query);
//check execute
if($respone) {
    //execute successfully
    //create session to display message
    $_SESSION['delete'] = "<div class = 'success'>Admin delete successfully</div>";
    header('Location:'.SITEURL.'admin/manager-admin.php');
}else {
    //execute successfully
    //create session to display message
    $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try again later'</div>";
    header('Location:'.SITEURL.'admin/manager-admin.php');
}
