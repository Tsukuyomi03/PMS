<?php
include ("config.php");
session_start();
$user = $_SESSION['Username'];
$sql = "SELECT SUM(`Sales_Quantity`) AS total_qty FROM `tbl_saleseggs` WHERE `Sales_User` = '$user'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['total_qty'];
$db->close();
?>