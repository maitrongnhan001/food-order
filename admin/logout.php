<?php
    include('../config/connect_database.php');
    session_destroy();
    header('Location:'.SITEURL.'admin/login.php');
?>