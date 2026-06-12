<?php
session_start();
require "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {

    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $phone   = trim($_POST['phone']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        header("location: contact_user.php?status=error");
        exit();
    }

    $stmt = $conn->prepare(
        "INSERT INTO contact_messages (name, email, phone, message) 
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        header("location: contact_user.php?status=success");
    } else {
        header("location: contact_user.php?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>
