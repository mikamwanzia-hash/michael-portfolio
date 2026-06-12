function addToCart(id){
    fetch("add_to_cart.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`food_id=${id}`
    }).then(r=>r.json()).then(data=>{
        if(data.success){
            showMessage(data.message);
            const countEl=document.getElementById("cartCount");
            if(countEl) countEl.innerText=data.cartCount;
            refreshCart();
        } else alert(data.message);
    }).catch(err=>console.log(err));
}

function refreshCart(){
    fetch("cart_ajax.php").then(r=>r.json()).then(data=>{
        const cartItems=document.getElementById("cartItems");
        if(!cartItems) return;
        cartItems.innerHTML="";
        if(data.cart.length===0) cartItems.innerHTML="<p>Your cart is empty</p>";
        else {
            let total=0;
            data.cart.forEach(item=>{
                total+=item.price*item.quantity;
                const div=document.createElement("div");
                div.className="cart-item";
                div.style.display="flex"; div.style.gap="10px"; div.style.alignItems="center";
                div.innerHTML=`<img src="images/food/${item.image}" width="60">
                    <div style="flex:1;">
                        <strong>${item.name}</strong>
                        <div style="margin-top:5px;display:flex;gap:5px;">
                            <input type="number" min="1" value="${item.quantity}" onchange="updateQty(${item.id},this.value)">
                            <button class="btn outline" onclick="removeItem(${item.id})">Remove</button>
                        </div>
                    </div>
                    <strong>KSh ${(item.price*item.quantity).toFixed(2)}</strong>`;
                cartItems.appendChild(div);
            });
            const totalDiv=document.createElement("div");
            totalDiv.className="cart-total";
            totalDiv.innerText="Total: KSh "+total.toFixed(2);
            cartItems.appendChild(totalDiv);
        }
        const countEl=document.getElementById("cartCount");
        if(countEl) countEl.innerText=data.cart.reduce((s,i)=>s+i.quantity,0);
    });
}

function updateQty(id,qty){
    fetch("cart_ajax.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`update_id=${id}&quantity=${qty}`
    }).then(r=>r.json()).then(data=>{if(data.success) refreshCart();});
}

function removeItem(id){
    fetch("cart_ajax.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`remove_id=${id}`
    }).then(r=>r.json()).then(data=>{if(data.success) refreshCart();});
}

function showMessage(text){
    const container=document.querySelector(".container");
    if(!container) return;
    const msg=document.createElement("p");
    msg.className="success-msg";
    msg.innerText=text;
    container.prepend(msg);
    setTimeout(()=>{msg.style.transition="opacity 0.8s, transform 0.8s"; msg.style.opacity="0"; msg.style.transform="translateY(-10px)"; setTimeout(()=>msg.remove(),800);},2000);
}

function toggleMenu(){
    document.getElementById("navMenu").classList.toggle("show");
}


/* MENU */
function toggleMenu(){ document.getElementById("navMenu").classList.toggle("show"); }


document.addEventListener("DOMContentLoaded",()=>{
    const btn=document.getElementById("themeBtn");
    if(localStorage.theme==="dark"){
        document.body.classList.add("dark");
        btn.textContent="☀️";
    }
    window.toggleTheme=()=>{
        document.body.classList.toggle("dark");
        localStorage.theme=document.body.classList.contains("dark")?"dark":"light";
        btn.textContent=document.body.classList.contains("dark")?"☀️":"🌙";
    }
});
