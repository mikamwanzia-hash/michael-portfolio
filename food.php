<?php
session_start();
require "connect.php";



// ===== CART INIT =====
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$cart = &$_SESSION['cart'];

// ===== ADD TO CART (AJAX-compatible) =====
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['food_id'])) {
    $id = (int)$_POST['food_id'];

    // Fetch food from DB
    $stmt = $conn->prepare("SELECT id, name, price, image FROM food_menu WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $food = $stmt->get_result()->fetch_assoc();

    if ($food) {
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $food['id'],
                'name' => $food['name'],
                'price' => $food['price'],
                'image' => $food['image'],
                'quantity' => 1
            ];
        }

        // AJAX response
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            echo json_encode([
                'success' => true,
                'message' => $food['name'] . " added to cart!",
                'cartCount' => array_sum(array_column($cart, 'quantity'))
            ]);
            exit();
        }

        $added_message = $food['name'] . " added to cart!";
    }
}

// ===== FETCH FOODS =====
$limit = 8;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$total_result = $conn->query("SELECT COUNT(*) AS total FROM food_menu");
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $limit);

$stmt = $conn->prepare("SELECT * FROM food_menu ORDER BY created_at DESC LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Food Menu | Top Star Hotel</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles/food.css">
</head>
<body>

<?php
include "header.php";
?>

<div class="bg-slideshow">
    <img src="images/food/background001.png" class="active" />
    <img src="images/food/background02.png" />
    <img src="images/food/background008.png" />
    <img src="images/food/background010.png" />
    <img src="images/food/background011.png" />
    <img src="images/food/background012.png" />
    <img src="images/food/background013.png" />
</div>

<main class="container">

<!-- SUCCESS MESSAGE -->
<?php if (isset($added_message)): ?>
<p class="success-msg" id="successMsg"><?= htmlspecialchars($added_message) ?></p>
<?php endif; ?>

<h2 class="section-title" id="food-menu">Food Menu</h2>
<div class="services-grid">
    <?php if($result->num_rows > 0): ?>
        <?php while($food = $result->fetch_assoc()): ?>
            <div class="service-card">
                <img src="images/food/<?= htmlspecialchars($food['image']) ?>" alt="<?= htmlspecialchars($food['name']) ?>">
                <div class="service-content">
                    <h4><?= htmlspecialchars($food['name']) ?></h4>
                    <p><?= htmlspecialchars($food['description']) ?></p>
                    <strong>KSh <?= number_format($food['price'],2) ?></strong>
                   
                    <span><p>Kindly Login to place your order</p></span>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center;">No food items available at the moment.</p>
    <?php endif; ?>
</div>

<!-- PAGINATION -->
<div class="pagination">
    <?php if($page>1): ?><a href="?page=<?= $page-1 ?>">Prev</a><?php endif; ?>
    <?php for($i=1; $i<=$total_pages; $i++): ?>
        <a href="?page=<?= $i ?>" class="<?= $i==$page?'active':'' ?>"><?= $i ?></a>
    <?php endfor; ?>
    <?php if($page<$total_pages): ?><a href="?page=<?= $page+1 ?>">Next</a><?php endif; ?>
</div>

</main>

<!-- CART MODAL -->
<div id="cartModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeCart()">&times;</span>
        <h3>Your Cart</h3>
        <div id="cartItems">
            <!-- JS will populate cart items here -->
        </div>
        <form action="place_order.php" method="POST" style="margin-top:20px; text-align:right;">
            <button type="submit" class="btn">Place Order</button>
        </form>
    </div>
</div>

<?php
include "footer.php";
?>
<script src="styles/food.js"></script>
</body>
</html>
