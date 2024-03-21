<?php
include ("config.php");
session_start();
$_SESSION["User"] = null;
$_SESSION['status'] = "success";
$_SESSION['message'] = "Logout Sucessful";
header("Location: " . $path . "customer_login.php");
exit();
?>