<?php
include("config.php");
session_start();

$uname = $_POST['uname'];
$pword = $_POST['pword'];

$sql = "SELECT * FROM tbl_admin WHERE Username='$uname' and `Password`='$pword'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}
?>