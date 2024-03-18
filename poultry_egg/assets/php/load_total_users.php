<?php
include ("config.php");
session_start();
$sql = "SELECT Count(`User_ID`) AS total_users FROM `tbl_users` WHERE `Status` = 'Approved' LIMIT 1";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['total_users'];
$db->close();
?>