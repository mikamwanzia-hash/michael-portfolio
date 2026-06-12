<?php
session_start();
require "connect.php";

// ===== Ensure only admin access =====
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("location: index.php");
    exit();
}

// ===== Handle Add Food Submission =====
$add_message = "";
if (isset($_POST['add_food'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $folder = "images/food/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);

        $imageName = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        $newName = time() . "_" . basename($imageName);

        if (move_uploaded_file($tmpName, $folder . $newName)) {
            $stmt = $conn->prepare("INSERT INTO food_menu (name, description, price, category, image, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssdss", $name, $description, $price, $category, $newName);
            $add_message = $stmt->execute() ? "Food item added successfully!" : "Database error: " . $stmt->error;
        } else {
            $add_message = "Failed to move uploaded file. Check folder permissions.";
        }
    } else {
        $add_message = "No image selected or upload error code: " . $_FILES['image']['error'];
    }
}

// ===== Handle Delete Food =====
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $result = $conn->query("SELECT image FROM food_menu WHERE id=$id");
    $row = $result->fetch_assoc();
    if ($row && file_exists("images/food/" . $row['image'])) unlink("images/food/" . $row['image']);
    $conn->query("DELETE FROM food_menu WHERE id=$id");
    header("location: admin_page.php");
    exit();
}

// ===== Fetch Data =====
$foods = $conn->query("SELECT * FROM food_menu ORDER BY created_at DESC");
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
$messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
$orders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Top Star Hotel</title>
<link rel="stylesheet" href="styles/admins.css">
</head>
<body>

<header class="header">
    <div class="logo">Top Star Hotel Admin</div>
    <nav class="nav" id="navMenu">
        <button class="btn-action" onclick="openModal('usersModal')">View Users</button>
        <button class="btn-action" onclick="openModal('messagesModal')">View Messages</button>
        <button class="btn-action" onclick="openModal('ordersModal')">View Orders</button>
        <button class="btn outline" id="themeBtn" onclick="toggleTheme()">🌙</button>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
    </nav>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
</header>

<div class="container">
<h2>Add New Food Item</h2>
<?php if($add_message) echo "<p class='message'>$add_message</p>"; ?>
<form method="POST" id="food-item" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Food Name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="number" name="price" placeholder="Price" step="0.01" required>
    <select name="category" required>
        <option value="" >Select Category</option>
        <option>Breakfast</option>
        <option>Lunch</option>
        <option>Dinner</option>
        <option>Drinks</option>
    </select>
    <input type="file" name="image" required>
    <button type="submit" name="add_food">Add Food</button>
</form>

<h2>Manage Food Menu</h2>
<table class="table">
<tr>
<th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Action</th>
</tr>
<?php while($food = $foods->fetch_assoc()): ?>
<tr>
<td><img src="images/food/<?= htmlspecialchars($food['image']) ?>" class="food-img"></td>
<td><?= htmlspecialchars($food['name']) ?></td>
<td><?= htmlspecialchars($food['category']) ?></td>
<td>KSh <?= number_format($food['price'], 2) ?></td>
<td><a href="admin_page.php?delete_id=<?= $food['id'] ?>" onclick="return confirm('Delete this item?')">Delete</a></td>
</tr>
<?php endwhile; ?>
</table>

<h2>Quick Admin Actions</h2>
<button class="btn-action" onclick="openModal('usersModal')">View Users</button>
<button class="btn-action" onclick="openModal('messagesModal')">View Messages</button>
<button class="btn-action" onclick="openModal('ordersModal')">View Orders</button>

</div>

<!-- ===== MODALS WITH DIFFERENT DIRECTIONS ===== -->

<!-- Users Modal (TOP) -->
<div id="usersModal" class="modal modal-top">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('usersModal')">&times;</span>
        <h3>Registered Users</h3>
        <table>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th> <th>Action</th></tr>
            <?php while($user = $users->fetch_assoc()): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['name']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>

                <td><a href="delete_user.php?delete_id=<?= $user['id'] ?>" onclick="return confirm('Delete this user?')">Delete</a></td>
                
                
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<!-- Messages Modal (RIGHT) -->
<div id="messagesModal" class="modal modal-right">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('messagesModal')">&times;</span>
        <h3>User Messages</h3>
        <table id="messagesTable">
            <tr>
                <th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Date</th><th>Status</th><th>Action</th>
            </tr>
            <?php while($msg = $messages->fetch_assoc()): ?>
            <tr data-email="<?= htmlspecialchars($msg['email']) ?>">
                <td><?= htmlspecialchars($msg['name']) ?></td>
                <td><?= htmlspecialchars($msg['email']) ?></td>
                <td><?= htmlspecialchars($msg['phone']) ?></td>
                <td><?= htmlspecialchars($msg['message']) ?></td>
                <td><?= $msg['created_at'] ?></td>
                <td class="status-cell">
                    <?php if($msg['replied']): ?>
                        <span style="color:green;font-weight:bold;">Replied</span>
                    <?php else: ?>
                        <span style="color:red;font-weight:bold;">Pending</span>
                    <?php endif; ?>
                </td>
                <td class="action-cell">
                    <?php if(!$msg['replied']): ?>
                        <button class="btn-action reply-btn" onclick="openReplyModal('<?= htmlspecialchars($msg['email']) ?>')">Reply</button>
                    <?php else: ?>
                        <button class="btn-action" disabled style="background:#ccc; cursor:not-allowed;">Reply</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<!-- Orders Modal (LEFT) -->
<div id="ordersModal" class="modal modal-left">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('ordersModal')">&times;</span>
        <h3>User Orders</h3>
        <table>
            <tr><th>Order ID</th><th>User ID</th><th>Total</th><th>Date</th><th>Action</th></tr>
            <?php while($order = $orders->fetch_assoc()): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['user_id'] ?></td>
                <td>KSh <?= number_format($order['total'],2) ?></td>
                <td><?= $order['created_at'] ?></td>
                <td><button class="btn-action" onclick="openOrderItemsModal(<?= $order['id'] ?>)">View Items</button></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<!-- Reply Modal (BOTTOM) -->
<div id="replyModal" class="modal modal-bottom">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('replyModal')">&times;</span>
        <h3>Reply to User</h3>
        <form id="replyForm">
            <input type="hidden" name="to_email" id="to_email">
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message_body" placeholder="Write your message here..." required></textarea>
            <button type="submit">Send Reply</button>
        </form>
        <p id="replyFeedback"></p>
    </div>
</div>

<!-- Order Items Modal (CENTER) -->
<div id="orderItemsModal" class="modal modal-center">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal('orderItemsModal')">&times;</span>
        <h3>Order Items</h3>
        <div id="orderItemsContent"></div>
    </div>
</div>

<script src="styles/admin.js"></script>
</body>
</html>
