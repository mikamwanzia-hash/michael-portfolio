<?php
session_start();
require "connect.php";

// Make sure user is logged in and cart is not empty
if (!isset($_SESSION['id']) || empty($_SESSION['cart'])) {
    header("location: user_page.php");
    exit();
}

$user_id = $_SESSION['id'];
$cart = $_SESSION['cart'];

// Calculate total
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Start transaction
$conn->begin_transaction();

try {
    // 1️⃣ Insert into orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // 2️⃣ Insert each cart item into order_items table
    $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, food_id, quantity) VALUES (?, ?, ?)");
    foreach ($cart as $item) {
        $itemStmt->bind_param("iii", $order_id, $item['id'], $item['quantity']);
        $itemStmt->execute();
    }

    // 3️⃣ Commit transaction
    $conn->commit();

    // 4️⃣ Clear cart
    unset($_SESSION['cart']);

    // 5️⃣ Set success message
    $_SESSION['order_message'] = "Your order has been placed successfully!";

    // Redirect back to user page
    header("location: user_page.php");
    exit();

} catch (Exception $e) {
    // Rollback on error
    $conn->rollback();
    die("Failed to place order: " . $e->getMessage());
}
?>
