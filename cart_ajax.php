<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = &$_SESSION['cart'];

$response = [
    'success' => false,
    'cart' => [],
    'total' => '0.00',
    'cartCount' => 0
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // UPDATE QUANTITY
    if (isset($_POST['update_id'], $_POST['quantity'])) {

        $id = (int)$_POST['update_id'];
        $qty = max(1, (int)$_POST['quantity']);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
            $response['success'] = true;
        }
    }

    // REMOVE ITEM
    if (isset($_POST['remove_id'])) {

        $id = (int)$_POST['remove_id'];

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $response['success'] = true;
        }
    }
}

$total = 0;
$cartCount = 0;

foreach ($cart as $id => $item) {

    $total += $item['price'] * $item['quantity'];
    $cartCount += $item['quantity'];

    $response['cart'][] = [
        'id' => $id,
        'name' => $item['name'],
        'price' => $item['price'],
        'image' => $item['image'],
        'quantity' => $item['quantity']
    ];
}

$response['total'] = number_format($total,2);
$response['cartCount'] = $cartCount;

header("Content-Type: application/json");
echo json_encode($response);
exit;