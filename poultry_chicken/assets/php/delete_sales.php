<?php
include ("config.php");
session_start();

$id = $_GET["id"];

$sql = "DELETE FROM `tbl_saleseggs` WHERE `Sales_ID` = $id";
$result = $db->query($sql);
if ($result) {
    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Deleted Successfuly";
    header("Location: " . $path . "poultry_egg/poultry_dashboard.php");
    exit();
} else {
    $_SESSION['status'] = "error";
    $_SESSION['message'] = "Something Went Wrong";
    header("Location: " . $path . "poultry_egg/poultry_dashboard.php");
    exit();
}
?>