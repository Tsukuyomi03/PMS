<?php
include ("config.php");
session_start();
$user = $_SESSION['Username'];
$sql = "SELECT SUM(O_Total) AS totalSales FROM `tbl_orders` LEFT JOIN tbl_products ON tbl_orders.O_ProductID = tbl_products.P_ID WHERE O_Seller='$user' AND O_Status='Completed'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['totalSales'];
$db->close();
?>