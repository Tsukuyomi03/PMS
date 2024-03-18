<?php
include ("config.php");
session_start();
$user = $_SESSION['Username'];
$sql = "SELECT SUM(`Sales_Total`) AS total_sales FROM `tbl_saleseggs` WHERE `Sales_User` = '$user'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['total_sales'];
$db->close();
?>