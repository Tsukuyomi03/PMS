<?php
include ("config.php");
session_start();

$uname = $_POST['uname'];
$pword = $_POST['pword'];

$sql = "SELECT * FROM tbl_users WHERE Username='$uname' and `Password`='$pword'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['Status'] == "Pending") {
        echo json_encode(array("statusCode" => 201));
    } else {
        if ($row['Type'] == 1) {
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['User_Type'] = $row['Type'];
            echo json_encode(array("statusCode" => 203));
        } else if ($row['Type'] == 2) {
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['User_Type'] = $row['Type'];
            echo json_encode(array("statusCode" => 204));
        } else {
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['User_Type'] = $row['Type'];
            echo json_encode(array("statusCode" => 205));
        }
    }
} else {
    echo json_encode(array("statusCode" => 202));
}
?>