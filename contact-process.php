<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer-PHPMailer-cd72ef3/src/Exception.php';
require 'PHPMailer-PHPMailer-cd72ef3/src/PHPMailer.php';
require 'PHPMailer-PHPMailer-cd72ef3/src/SMTP.php';

// Initialize an empty errors array
$errors = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_message'])) {
    // Retrieve form data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    // Validate form fields
    if (empty($name)) {
        $errors['name'] = "Please enter your name.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    }
    if (empty($subject)) {
        $errors['subject'] = "Please enter a subject.";
    }
    if (empty($message)) {
        $errors['message'] = "Please enter your message.";
    }

    // If there are no errors, send the email
    if (!array_filter($errors)) {
        try {
            // Initialize PHPMailer
            $mail = new PHPMailer(true);

            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smartlinkcourier.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'info@smartlinkcourier.com'; // SMTP username
            $mail->Password = 'admin@smartlinkcourier'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type
            $mail->Port = 587; // SMTP port

            // Email headers and content
            $mail->setFrom('info@smartlinkcourier.com', 'Smartlink Courier');
            $mail->addAddress('info@smartlinkcourier.com'); // Your email address
            $mail->addReplyTo($email, $name); // User's email and name

            $mail->Subject = "New Contact Message: $subject";
            $mail->Body = "You have received a new message from your website contact form.\n\n" .
                          "Name: $name\n" .
                          "Email: $email\n" .
                          "Subject: $subject\n\n" .
                          "Message:\n$message\n";

            // Send email
            $mail->send();
            $success = "Your message has been sent successfully.";
        } catch (Exception $e) {
            $errors['general'] = "There was an error sending your message. Please try again later.";
        }
    }
}
?>
