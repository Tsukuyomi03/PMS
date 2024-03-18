<?php
include("config.php");
session_start();
session_destroy();
session_start();
$_SESSION['status'] = "success";
$_SESSION['message'] = "Logout Sucessful";
header("Location: " . $path . "index_admin.php");
exit();
?>