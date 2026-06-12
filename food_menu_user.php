<?php
session_start();
require "connect.php";

if (!isset($_SESSION['email'])) header("location: index.php");

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
$cart = &$_SESSION['cart'];

$limit = 8;
$page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;
$offset = ($page-1)*$limit;

$total_result = $conn->query("SELECT COUNT(*) AS total FROM food_menu");
$total_items = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_items/$limit);

$stmt = $conn->prepare("SELECT * FROM food_menu ORDER BY created_at DESC LIMIT ?, ?");
$stmt->bind_param("ii",$offset,$limit);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Food Menu | Top Star Hotel</title>
<link rel="stylesheet" href="styles/food.css">
</head>
<body>

<?php include "loggedin_user_header.php"; ?>

<main class="container">
<h2 class="section-title">Food Menu</h2>
<div class="services-grid">
<?php if($result->num_rows>0): ?>
    <?php while($food=$result->fetch_assoc()): ?>
        <div class="service-card">
            <img src="images/food/<?= htmlspecialchars($food['image']) ?>" alt="<?= htmlspecialchars($food['name']) ?>">
            <div class="service-content">
                <h4><?= htmlspecialchars($food['name']) ?></h4>
                <p><?= htmlspecialchars($food['description']) ?></p>
                <strong>KSh <?= number_format($food['price'],2) ?></strong>
                <button class="btn" onclick="addToCart(<?= $food['id'] ?>)">Add to Cart</button>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p style="text-align:center;">No food items available at the moment.</p>
<?php endif; ?>
</div>

<div class="pagination">
<?php if($page>1): ?><a href="?page=<?= $page-1 ?>">Prev</a><?php endif; ?>
<?php for($i=1;$i<=$total_pages;$i++): ?>
    <a href="?page=<?= $i ?>" class="<?= $i==$page?'active':'' ?>"><?= $i ?></a>
<?php endfor; ?>
<?php if($page<$total_pages): ?><a href="?page=<?= $page+1 ?>">Next</a><?php endif; ?>
</div>
</main>

<!-- Cart Modal -->
<div id="cartModal" class="modal">
<div class="modal-content">
    <span class="close-btn" onclick="closeCart()">&times;</span>
    <h3>Your Cart</h3>
    <div id="cartItems"></div>
    <form action="place_order.php" method="POST" style="text-align:right; margin-top:20px;">
        <button type="submit" class="btn">Place Order</button>
    </form>
</div>
</div>

<?php include "footer.php"; ?>
<script src="styles/food.js"></script>
</body>
</html>
