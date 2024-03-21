<?php
include ("config.php");
session_start();

$uname = $_POST['uname'];
$pword = $_POST['pword'];

$sql = "SELECT * FROM `tbl_customer` WHERE Username = '$uname' and Password = '$pword'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['Email'];
    if ($row['Account_Status'] == 'Unverified') {
        echo json_encode(array("statusCode" => 200, "Email" => $email));
    } else {
        $_SESSION['User'] = $row['Username'];
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Login Sucessful";
        echo json_encode(array("statusCode" => 202, "Username" => $row['Username']));
    }
} else {
    echo json_encode(array("statusCode" => 201));
}
?>