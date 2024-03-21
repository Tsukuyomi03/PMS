<?php
include ("config.php");
include ("mailer_config.php");
session_start();

$email = $_POST["email"];
$sql = "SELECT * FROM tbl_customer WHERE Email='$email'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);

    $code = rand(999999, 111111);

    $name = $row['Name'];
    $surname = $row['Surname'];

    //==========================  EMAIL INFORMATIONS
    $mail->setFrom("PMS@gmail.com", "PMS DEV");
    $newname = $name . " " . $surname;
    $mail->addAddress("$email", $name);

    $email_template = 'customer_mail.html';
    $message = file_get_contents($email_template);
    $message = str_replace('%user%', $newname, $message);
    $message = str_replace('%code%', $code, $message);

    $mail->msgHTML($message);

    if ($mail->send()) {
        $sql2 = "UPDATE tbl_customer SET Code='$code' WHERE Email='$email'";
        if (mysqli_query($db, $sql2)) {
            echo json_encode(array("statusCode" => 200));
        } else {
            echo json_encode(array("statusCode" => 201));
        }
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}
?>