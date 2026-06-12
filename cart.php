<?php
session_start();
require "connect.php";

if (!isset($_SESSION['email'])) {
    header("Location:index.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];

$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Cart | Top Star Hotel</title>
<link rel="stylesheet" href="styles/cart.css">
</head>

<body>

<?php include "loggedin_user_header.php"; ?>

<main class="container">

<h2>Your Cart</h2>

<?php if (empty($cart)): ?>

<p>Your cart is empty.</p>

<?php else: ?>

<div id="cartContainer">

<?php foreach ($cart as $id => $item): ?>

<div class="cart-item" style="display:flex;gap:15px;align-items:center;margin-bottom:15px;">

<img src="images/food/<?= htmlspecialchars($item['image']) ?>" width="80">

<div style="flex:1">

<strong><?= htmlspecialchars($item['name']) ?></strong>

<div style="margin-top:5px">

<input 
type="number" 
min="1" 
value="<?= $item['quantity'] ?>" 
onchange="updateQty(<?= $id ?>, this.value)"
>

<button class="btn outline" onclick="removeItem(<?= $id ?>)">
Remove
</button>

</div>

</div>

<strong>
KSh <?= number_format($item['price'] * $item['quantity'],2) ?>
</strong>

</div>

<?php endforeach; ?>

</div>

<h3 id="cartTotal">
Total: KSh <?= number_format($total,2) ?>
</h3>

<form action="place_order.php" method="POST">
<button class="btn">Place Order</button>
</form>

<?php endif; ?>

</main>

<?php include "footer.php"; ?>

<script src="styles/user.js"></script>

</body>
</html>