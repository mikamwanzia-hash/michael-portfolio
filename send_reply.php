<?php
session_start();
require "connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure PHPMailer is installed

// Ensure only admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "error";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $to_email = trim($_POST['to_email']);
    $subject = trim($_POST['subject']);
    $message_body = trim($_POST['message_body']);

    if (empty($to_email) || empty($subject) || empty($message_body)) {
        echo "error";
        exit();
    }

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your-email@gmail.com'; // Replace with your email
        $mail->Password   = 'your-app-password';    // Replace with app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('no-reply@topstarhotel.com', 'Top Star Hotel');
        $mail->addAddress($to_email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message_body);

        $mail->send();

        // Mark message as replied
        $stmt = $conn->prepare("UPDATE contact_messages SET replied=1 WHERE email=?");
        $stmt->bind_param("s", $to_email);
        $stmt->execute();
        $stmt->close();

        echo "success";

    } catch (Exception $e) {
        echo "error";
    }

    $conn->close();
}
?>
