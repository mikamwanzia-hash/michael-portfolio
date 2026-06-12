<?php
session_start();
require "connect.php";

// Redirect if not logged in
if(!isset($_SESSION['email'])) header("Location: index.php");

// Initialize cart
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
$cart = &$_SESSION['cart'];

// Fetch foods
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
<title>User Page | Top Star Hotel</title>
<link rel="stylesheet" href="styles/user.css">

</head>
<body>

<div class="bg-slideshow">
    <img src="images/background002.png" class="active" />
    <img src="images/background003.png" />
    <img src="images/background004.png" />
    <img src="images/background005.png" />
    <img src="images/background006.png" />
    <img src="images/background007.png" />
    <img src="images/background008.png" />
    <img src="images/background009.png" />
    <img src="images/background010.png" />
    <img src="images/background011.png" />
    <img src="images/background012.png" />
    <img src="images/background013.png" />
    <img src="images/background014.png" />
    <img src="images/background015.png" />
    <img src="images/background016.png" />
    <img src="images/background017.png" />
    <img src="images/services/background018.png" />
    <img src="images/services/background019.png" />
    <img src="images/services/background020.png" />
    <img src="images/services/background021.png" />
    <img src="images/services/background022.png" />
    <img src="images/services/background023.png" />
    <img src="images/services/background024.png" />
    <img src="images/services/background025.png" />
    <img src="images/services/background026.png" />
    <img src="images/services/background027.png" />
    <img src="images/services/background028.png" />
     <img src="images/services/background029.png" />
    <img src="images/services/background030.png" />
    <img src="images/services/background031.png" />
   
</div>

<?php
include "loggedin_user_header.php"
?>

<!-- FOOD MENU -->
<main class="container">
<h2>Food Menu</h2>
<div class="services-grid">
<?php if($result->num_rows>0): ?>
    <?php while($food=$result->fetch_assoc()): ?>
        <div class="service-card">
            <img src="images/food/<?= htmlspecialchars($food['image']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" style="width:100%;height:150px;object-fit:cover;">
            <h4><?= htmlspecialchars($food['name']) ?></h4>
            <p><?= htmlspecialchars($food['description']) ?></p>
            <strong>KSh <?= number_format($food['price'],2) ?></strong><br>
            <button class="btn" onclick="addToCart(<?= $food['id'] ?>)">Add to Cart</button>
        </div>
    <?php endwhile; ?>
<?php else: ?>
<p>No food items available at the moment.</p>
<?php endif; ?>
</div>
</main>

<!-- CART MODAL -->
<div id="cartModal" class="modal">
<div class="modal-content">
    <span class="close-btn" onclick="closeCart()">&times;</span>
    <h3>Your Cart</h3>
    <div id="cartItems"></div>
    <form action="place_order.php" method="POST" style="text-align:right;margin-top:20px;">
        <button type="submit" class="btn">Place Order</button>
    </form>
</div>
</div>

<script>
// ===== THEME TOGGLE =====
const themeBtn=document.getElementById("themeBtn");
if(localStorage.theme==='dark') document.body.classList.add('dark');
function toggleTheme(){
    document.body.classList.toggle('dark');
    localStorage.theme = document.body.classList.contains('dark')?'dark':'light';
    themeBtn.textContent = document.body.classList.contains('dark')?'☀️':'🌙';
}

// ===== CART FUNCTIONS =====
function openCart(){document.getElementById("cartModal").style.display="flex"; refreshCart();}
function closeCart(){document.getElementById("cartModal").style.display="none";}

function addToCart(id){
    fetch("add_to_cart.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`food_id=${id}`
    }).then(r=>r.json()).then(data=>{
        if(data.success){
            alert(data.message);
            document.getElementById("cartCount").innerText=data.cartCount;
            refreshCart();
        } else alert(data.message);
    }).catch(err=>console.log(err));
}

function refreshCart(){
    fetch("cart_ajax.php").then(r=>r.json()).then(data=>{
        const cartItems=document.getElementById("cartItems");
        if(!cartItems) return;
        cartItems.innerHTML="";
        if(data.cart.length===0){cartItems.innerHTML="<p>Your cart is empty</p>"; return;}
        let total=0;
        data.cart.forEach(item=>{
            total+=item.price*item.quantity;
            const div=document.createElement("div");
            div.style.display="flex"; div.style.justifyContent="space-between"; div.style.alignItems="center"; div.style.marginBottom="10px";
            div.innerHTML=`<strong>${item.name}</strong>
                <span>KSh ${(item.price*item.quantity).toFixed(2)}</span>
                <input type="number" min="1" value="${item.quantity}" onchange="updateQty(${item.id},this.value)">
                <button onclick="removeItem(${item.id})">Remove</button>`;
            cartItems.appendChild(div);
        });
        const totalDiv=document.createElement("div");
        totalDiv.style.fontWeight="bold"; totalDiv.style.marginTop="10px";
        totalDiv.innerText="Total: KSh "+total.toFixed(2);
        cartItems.appendChild(totalDiv);
    });
}

function updateQty(id,qty){
    fetch("cart_ajax.php",{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded"},body:`update_id=${id}&quantity=${qty}`})
    .then(r=>r.json()).then(data=>{if(data.success) refreshCart();});
}

function removeItem(id){
    fetch("cart_ajax.php",{method:"POST",headers:{"Content-Type":"application/x-www-form-urlencoded"},body:`remove_id=${id}`})
    .then(r=>r.json()).then(data=>{if(data.success) refreshCart();});
}
</script>
<?php
include "footer.php";
?>
<script src="styles/main.js"></script>
</body>
</html>
