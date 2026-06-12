<?php
session_start();
require "connect.php";

// Ensure admin access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied!";
    exit();
}

if (!isset($_GET['order_id'])) {
    echo "Order ID missing!";
    exit();
}

$order_id = (int)$_GET['order_id'];

// Fetch order items with food image
$stmt = $conn->prepare("
    SELECT oi.quantity, f.name, f.price, f.image
    FROM order_items oi
    JOIN food_menu f ON oi.food_id = f.id
    WHERE oi.order_id = ?
");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "<table style='width:100%; border-collapse:collapse;'>";
    echo "<tr style='background:#0a2540; color:#fff;'>
            <th>Image</th>
            <th>Food Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
          </tr>";

    $total = 0;
    $row_index = 0;
    while($row = $result->fetch_assoc()){
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
        $bg = $row_index % 2 == 0 ? "#f4f6f8" : "#e0e0e0";

        echo "<tr style='background:$bg;'>";
        echo "<td><img src='images/food/".htmlspecialchars($row['image'])."' 
                    style='width:50px; height:40px; object-fit:cover; border-radius:4px;'></td>";
        echo "<td>".htmlspecialchars($row['name'])."</td>";
        echo "<td>".$row['quantity']."</td>";
        echo "<td>KSh ".number_format($row['price'],2)."</td>";
        echo "<td>KSh ".number_format($subtotal,2)."</td>";
        echo "</tr>";
        $row_index++;
    }

    echo "<tr style='font-weight:bold; background:#cfcfcf;'>";
    echo "<td colspan='4'>Total</td><td>KSh ".number_format($total,2)."</td>";
    echo "</tr>";

    echo "</table>";
} else {
    echo "<p>No items found for this order.</p>";
}
?>
