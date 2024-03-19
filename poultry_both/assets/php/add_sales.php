<?php
include ("config.php");
session_start();
$user = $_SESSION["Username"];
$sdate = $_POST['sdate'];
$sqty = $_POST['sqty'];
$stotal = $_POST['stotal'];
$sql = "INSERT INTO `tbl_saleseggs`(`Sales_User`, `Sales_Quantity`, `Sales_Total`, `Sales_Date`) VALUES ('$user','$sqty','$stotal','$sdate')";
if (mysqli_query($db, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
?>