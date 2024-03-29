<?php
include ("config.php");
session_start();
$user = $_SESSION["Username"];
$ptype = $_POST['ptype'];
$pdes = $_POST['pdes'];
$pprice = $_POST['pprice'];

$sql = "INSERT INTO `tbl_products`(`P_Seller`, `P_Type`, `P_Description`, `P_Price`) VALUES ('$user','$ptype','$pdes','$pprice')";
if (mysqli_query($db, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
?>