<?php
include("config.php");
session_start();

$oid = $_GET["oid"];

$sql = "UPDATE `tbl_users` SET `Status`='Approved' WHERE User_ID='$oid'";
$result = $db->query($sql);
if ($result) {
    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Deleted Successfuly";
    header("Location: " . $path . "admin/admin_users.php");
    exit();
} else {
    $_SESSION['status'] = "error";
    $_SESSION['message'] = "Something Went Wrong";
    header("Location: " . $path . "admin/admin_users.php");
    exit();
}
?>