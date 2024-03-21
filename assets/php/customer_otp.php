<?php
include ("config.php");
session_start();

$email = $_POST['email'];
$otp = $_POST['otp'];

$sql = "SELECT * FROM tbl_customer WHERE Email='$email'";
$result = $db->query($sql);
$fetch = mysqli_fetch_assoc($result);
if ($otp != $fetch["Code"]) {
    echo json_encode(array("statusCode" => 201));
} else {
    $sql2 = "UPDATE `tbl_customer` SET Code='0', Account_Status='Verified' WHERE Email='$email'";
    if (mysqli_query($db, $sql2)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 203));
    }
}
?>