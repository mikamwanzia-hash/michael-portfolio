<?php
require "connect.php";

$messages_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $messages_per_page;

$total_messages = $conn->query("SELECT COUNT(*) as total FROM messages")->fetch_assoc()['total'];
$total_pages = ceil($total_messages / $messages_per_page);

$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT $start, $messages_per_page");

$messages = [];
while($row = $result->fetch_assoc()) $messages[] = $row;

echo json_encode([
    'messages' => $messages,
    'current_page' => $page,
    'total_pages' => $total_pages
]);
