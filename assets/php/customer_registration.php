<?php
include ("config.php");
include ("mailer_config.php");
session_start();

$cname = $_POST['cname'];
$csname = $_POST['csname'];
$ccontact = $_POST['ccontact'];
$cemail = $_POST['cemail'];
$region = $_POST['region'];
$province = $_POST['province'];
$city = $_POST['city'];
$brgy = $_POST['brgy'];
$street = $_POST['street'];
$cuname = $_POST['cuname'];
$cpword = $_POST['cpword1'];

$sql1 = "SELECT Username FROM tbl_customer WHERE Username = '$cuname' OR Email = '$cemail' LIMIT 1";
$result1 = mysqli_query($db, $sql1);
$fetch1 = mysqli_fetch_assoc($result1);
if ($result1->num_rows > 0) {
    echo json_encode(array("statusCode" => 201));
} else {
    $code = rand(999999, 111111);
    $account_status = "Unverified";

    $mail->setFrom("PMS@gmail.com", "PMS DEV");
    $newname = $cname . " " . $csname;

    $mail->addAddress("$cemail", $newname);

    $email_template = 'customer_mail.html';
    $message = file_get_contents($email_template);
    $message = str_replace('%user%', $newname, $message);
    $message = str_replace('%code%', $code, $message);

    $mail->msgHTML($message);
    if ($mail->send()) {
        $sql2 = "INSERT INTO `tbl_customer` (`Username`, `Password`, `Name`, `Surname`, `Street`, `Brgy`, `City`, `Province`, `Region`, `Contact_No`, `Email`, `Code`, `Account_Status`) VALUES ('$cuname','$cpword','$cname','$csname','$street','$brgy','$city','$province','$region','$ccontact','$cemail','$code','$account_status')";
        if (mysqli_query($db, $sql2)) {
            echo json_encode(array("statusCode" => 200, "Email" => $cemail));
        }
    } else {
        echo json_encode(array("statusCode" => 202));
    }
}

?>