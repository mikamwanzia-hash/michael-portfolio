<?php
session_start();
require "connect.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM users WHERE id=$id AND role != 'admin'");
}

header("location: admin_page.php");
exit();
?>