<?php
include ("config.php");
session_start();

$oid = $_POST["oid"];
$ocustomer = $_POST['ocustomer'];
$oseller2 = $_POST['oseller2'];
$oqty = $_POST['oqty'];
$oprod = $_POST['oprod'];
$oprice = $_POST['oprice'];
$ototal = $oprice * $oqty;
$ostatus = "Pending";

$sql = "INSERT INTO `tbl_orders`(`O_Customer`, `O_Seller`, `O_ProductID`, `O_QTY`, `O_Total`, `O_Status`) 
VALUES ('$ocustomer','$oseller2','$oid','$oqty','$ototal','$ostatus')";
if (mysqli_query($db, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
?>