<?php
include ("config.php");
session_start();
$user = $_SESSION["Username"];
$contents = '
<table class="table table-hover table-bordered" id="tblSales">
    <thead>
        <tr>
            <td>ID</td>
            <td>DATE</td>
            <td>QUANTITY</td>
            <td>TOTAL</td>
            <td>ACTION</td>
        </tr>
    </thead>
<tbody>';
$user = $_SESSION["Username"];
$sql = "SELECT * FROM `tbl_saleseggs` WHERE Sales_User = '$user'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $content .= '
        <tr>
            <td>' . $row['Sales_ID'] . '</td>
            <td>' . $row['Sales_Date'] . '</td>
            <td>' . $row['Sales_Quantity'] . '</td>
            <td>' . $row['Sales_Total'] . '</td>
            <td><button class="btn btn-danger btn-sm">DELETE</button></td>
        </tr>';
    }
}
echo json_encode($contents);
?>