<?php
include ("config.php");
session_start();
$user = $_SESSION['Username'];
$sql = "SELECT COUNT(P_ID) AS totalProducts FROM `tbl_products` WHERE P_Seller='$user'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['totalProducts'];
$db->close();
?>