<?php
include ("config.php");
session_start();
$sql = "SELECT Count(`C_ID`) AS total_customer FROM `tbl_customer` WHERE `Account_Status` = 'Verified' LIMIT 1";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['total_customer'];
$db->close();
?>