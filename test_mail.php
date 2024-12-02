<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-PHPMailer-cd72ef3/src/Exception.php';
require 'PHPMailer-PHPMailer-cd72ef3/src/PHPMailer.php';
require 'PHPMailer-PHPMailer-cd72ef3/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smartlinkcourier.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'info@smartlinkcourier.com';
    $mail->Password = 'admin@smartlinkcourier';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('info@smartlinkcourier.com', 'Smartlink Courier');
    $mail->addAddress('davidaniago@gmail.com');

    $mail->Subject = 'Test Mail';
    $mail->Body = 'This is a test email.';

    $mail->send();
    echo "Mail sent successfully!";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}

