<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);
$mail->isHTML(true);
$mail->isSMTP();
$mail->CharSet = "utf-8";

$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'mh.tokio@gmail.com';
$mail->Password = 'ykjm qmeg bibi hard';
$mail->SMTPSecure = "ssl";
$mail->Port = 465;

?>