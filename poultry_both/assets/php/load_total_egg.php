<?php
include ("config.php");
session_start();
$user = $_SESSION['Username'];
$sql = "SELECT SUM(O_QTY) AS totalEggs FROM `tbl_orders` LEFT JOIN tbl_products ON tbl_orders.O_ProductID = tbl_products.P_ID WHERE O_Seller='$user' AND O_Status='Completed' AND P_Type='Egg'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['totalEggs'];
$db->close();
?>