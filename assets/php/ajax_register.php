<?php
include("config.php");
session_start();

$name = $_POST['name'];
$lname = $_POST['lname'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$uname = $_POST['uname'];
$pword = $_POST['pword'];
$type = $_POST['type'];
$date = date("Y/m/d");

$sql = "SELECT * FROM tbl_users WHERE Username='$uname' LIMIT 1";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    echo json_encode(array("statusCode" => 201));
} else {
    $sql2 = "INSERT INTO `tbl_users`(`Date_Created`, `Name`, `Surname`, `Address`, `Contact`, `Username`, `Password`, `Type`,`Status`) 
    VALUES ('$date','$name','$lname','$address','$contact','$uname','$pword','$type','Pending')";
    if (mysqli_query($db, $sql2)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 203));
    }
}
?>