<?php
include ("config.php");
session_start();
$sql = "SELECT Count(`C_ID`) AS total_users FROM `tbl_customer` WHERE `Account_Status` = 'Unverified'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['total_users'];
$db->close();
?>