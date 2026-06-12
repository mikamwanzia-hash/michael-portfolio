<?php
session_start();
require "../connect.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("location: ../index.php");
    exit();
}

$message = "";

if (isset($_POST['add_food'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];

    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    $folder = "../images/food/";
    $newName = time() . "_" . $imageName;

    if (move_uploaded_file($tmpName, $folder . $newName)) {
        $stmt = $conn->prepare(
            "INSERT INTO food_menu (name, description, price, category, image)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssdss", $name, $description, $price, $category, $newName);

        if ($stmt->execute()) {
            $message = "Food item added successfully!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Food</title>
</head>
<body>
<h2>Add Food Item</h2>

<p style="color:green"><?= $message ?></p>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Food Name" required><br><br>
    <textarea name="description" placeholder="Description" required></textarea><br><br>
    <input type="number" name="price" step="0.01" placeholder="Price" required><br><br>

    <select name="category" required>
        <option value="">Select Category</option>
        <option>Breakfast</option>
        <option>Lunch</option>
        <option>Dinner</option>
        <option>Drinks</option>
    </select><br><br>

    <input type="file" name="image" required><br><br>
    <button type="submit" name="add_food">Add Food</button>
</form>
</body>
</html>
