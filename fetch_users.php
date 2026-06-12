<?php
require "connect.php";

$users_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $users_per_page;

$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$total_pages = ceil($total_users / $users_per_page);

$result = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT $start, $users_per_page");

$users = [];
while($row = $result->fetch_assoc()) $users[] = $row;

echo json_encode([
    'users' => $users,
    'current_page' => $page,
    'total_pages' => $total_pages
]);
