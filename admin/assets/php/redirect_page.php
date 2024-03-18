<?php
include ("config.php");
session_start();
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_users WHERE User_ID='$id'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $type = $row['Type'];
    if ($type == 1) {
        header("Location: " . $path . "admin/admin_page_chicken.php?id=$id");
    } else if ($type == 2) {
        header("Location: " . $path . "admin/admin_page_eggs.php?id=$id");
    } else {
        header("Location: " . $path . "admin/admin_page_both.php?id=$id");
    }
} else {
    header("Location: " . $path . "admin/admin_users.php");
}
?>