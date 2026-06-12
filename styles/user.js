/* ================= MENU TOGGLE ================= */

function toggleMenu() {
const menu = document.getElementById("navMenu");
if (menu !== null) {
menu.classList.toggle("show");
}
}


/* ================= CART MODAL ================= */

function openCart() {

const modal = document.getElementById("cartModal");
const footer = document.querySelector(".footer");

if (modal !== null) modal.style.display = "flex";
if (footer !== null) footer.style.display = "none";

refreshCart();
}

function closeCart() {

const modal = document.getElementById("cartModal");
const footer = document.querySelector(".footer");

if (modal !== null) modal.style.display = "none";
if (footer !== null) footer.style.display = "flex";
}


/* ================= ADD TO CART ================= */

function addToCart(id, name, price, image) {

fetch("user_page.php", {
method: "POST",
headers: {
"Content-Type": "application/x-www-form-urlencoded",
"X-Requested-With": "XMLHttpRequest"
},
body:
"food_id=" + id +
"&food_name=" + encodeURIComponent(name) +
"&food_price=" + price +
"&food_image=" + encodeURIComponent(image)
})

.then(function(res){ return res.text(); })
.then(function(text){

let data;

try {
data = JSON.parse(text);
} catch (e) {
console.error("Invalid JSON:", text);
return;
}

if (data.success) {

showMessage(data.message || "Item added to cart");

const count = document.getElementById("cartCount");

if (count !== null) {
count.innerText = data.cartCount;
}

refreshCart();
}

})

.catch(function(err){
console.error("Add to cart error:", err);
});

}


/* ================= UPDATE QUANTITY ================= */

function updateQty(id, qty) {

fetch("cart_ajax.php", {
method: "POST",
headers: {
"Content-Type": "application/x-www-form-urlencoded"
},
body: "update_id=" + id + "&quantity=" + qty
})

.then(function(res){ return res.text(); })
.then(function(text){

let data;

try {
data = JSON.parse(text);
} catch (e) {
console.error("Invalid JSON:", text);
return;
}

if (data.success) {
refreshCart();
}

})

.catch(function(err){
console.error("Quantity update error:", err);
});

}


/* ================= REMOVE ITEM ================= */

function removeItem(id) {

fetch("cart_ajax.php", {
method: "POST",
headers: {
"Content-Type": "application/x-www-form-urlencoded"
},
body: "remove_id=" + id
})

.then(function(res){ return res.text(); })
.then(function(text){

let data;

try {
data = JSON.parse(text);
} catch (e) {
console.error("Invalid JSON:", text);
return;
}

if (data.success) {
refreshCart();
}

})

.catch(function(err){
console.error("Remove item error:", err);
});

}


/* ================= REFRESH CART ================= */

function refreshCart() {

fetch("cart_ajax.php")

.then(function(res){ return res.text(); })
.then(function(text){

let data;

try {
data = JSON.parse(text);
} catch (e) {
console.error("Invalid JSON:", text);
return;
}

const cartItems = document.getElementById("cartItems");
const cartCount = document.getElementById("cartCount");

if (cartCount !== null) {
cartCount.innerText = data.cartCount || 0;
}

if (cartItems === null) return;

cartItems.innerHTML = "";

if (!data.cart || data.cart.length === 0) {
cartItems.innerHTML = "<p>Your cart is empty</p>";
return;
}

let total = 0;

data.cart.forEach(function(item){

total += item.price * item.quantity;

const div = document.createElement("div");

div.className = "cart-item";

div.innerHTML =
'<img src="images/food/' + item.image + '" width="60">' +

'<div style="flex:1;">' +

'<strong>' + item.name + '</strong>' +

'<div style="display:flex;gap:5px;margin-top:6px;">' +

'<input type="number" min="1" value="' + item.quantity + '" onchange="updateQty(' + item.id + ',this.value)">' +

'<button class="btn outline" onclick="removeItem(' + item.id + ')">Remove</button>' +

'</div>' +

'</div>' +

'<strong>KSh ' + (item.price * item.quantity).toFixed(2) + '</strong>';

cartItems.appendChild(div);

});

const totalDiv = document.createElement("div");

totalDiv.className = "cart-total";
totalDiv.style.marginTop = "15px";
totalDiv.style.fontWeight = "bold";

totalDiv.innerText = "Total: KSh " + (data.total || "0.00");

cartItems.appendChild(totalDiv);

})

.catch(function(err){
console.error("Cart refresh error:", err);
});

}


/* ================= SUCCESS MESSAGE ================= */

function showMessage(text) {

const msg = document.createElement("p");

msg.className = "success-msg";
msg.innerText = text;

const container = document.querySelector(".container");

if (container !== null) {
container.prepend(msg);
}

setTimeout(function(){

msg.style.transition = "opacity 0.8s, transform 0.8s";
msg.style.opacity = "0";
msg.style.transform = "translateY(-10px)";

setTimeout(function(){
msg.remove();
},800);

},2000);

}


/* ================= DARK MODE ================= */

document.addEventListener("DOMContentLoaded", function(){

const btn = document.getElementById("themeBtn");

if (localStorage.theme === "dark") {

document.body.classList.add("dark");

if (btn !== null) {
btn.textContent = "☀️";
}

}

window.toggleTheme = function(){

document.body.classList.toggle("dark");

localStorage.theme =
document.body.classList.contains("dark") ? "dark" : "light";

if (btn !== null) {
btn.textContent =
document.body.classList.contains("dark") ? "☀️" : "🌙";
}

};

});