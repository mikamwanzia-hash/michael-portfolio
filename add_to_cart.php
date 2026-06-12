<?php
session_start();
require "connect.php";

if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
$cart = &$_SESSION['cart'];

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['food_id'])){
    $id = (int)$_POST['food_id'];

    $stmt = $conn->prepare("SELECT id,name,price,image FROM food_menu WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $food = $stmt->get_result()->fetch_assoc();

    if($food){
        if(isset($cart[$id])) $cart[$id]['quantity']++;
        else $cart[$id] = ['id'=>$food['id'],'name'=>$food['name'],'price'=>$food['price'],'image'=>$food['image'],'quantity'=>1];

        header("Content-Type: application/json");
        echo json_encode(['success'=>true,'message'=>$food['name']." added to cart!",'cartCount'=>array_sum(array_column($cart,'quantity'))]);
        exit;
    }
}

header("Content-Type: application/json");
echo json_encode(['success'=>false,'message'=>'Item not added']);
