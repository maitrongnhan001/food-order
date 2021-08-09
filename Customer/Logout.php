<?php
require_once('../config/connect_database.php');
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}
header('Location: '.SITEURL);
?>