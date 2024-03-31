<?php
include "config.php";
session_start();

$datenow = date("Y/m/d");
$oid = $_POST['oid'];

$sql = "UPDATE `tbl_orders` SET `O_Status`='Declined' WHERE O_ID='$oid'";
if (mysqli_query($db, $sql)) {
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
?>