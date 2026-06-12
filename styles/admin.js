// ===== MENU TOGGLE WITH ICON CHANGE =====
function toggleMenu() {
    const nav = document.getElementById('navMenu');
    const toggle = document.querySelector('.menu-toggle');

    nav.classList.toggle('show');

    // Change icon
    toggle.textContent = nav.classList.contains('show') ? '✖' : '☰';
}

// ===== OPEN MODAL WITH DIRECTIONAL ANIMATION =====
function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    modal.style.display = 'flex';
    const content = modal.querySelector('.modal-content');

    // Reset initial transform and opacity
    content.style.transition = 'transform 0.3s ease, opacity 0.3s ease';
    content.style.opacity = '0';

    if(modal.classList.contains('modal-top')) content.style.transform = 'translateY(-50px)';
    else if(modal.classList.contains('modal-bottom')) content.style.transform = 'translateY(50px)';
    else if(modal.classList.contains('modal-left')) content.style.transform = 'translateX(-50px)';
    else if(modal.classList.contains('modal-right')) content.style.transform = 'translateX(50px)';
    else content.style.transform = 'translateY(0)'; // center

    // Animate to final position
    setTimeout(() => {
        content.style.transform = 'translateX(0) translateY(0)';
        content.style.opacity = '1';
    }, 10);
}

// ===== CLOSE MODAL WITH ANIMATION =====
function closeModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;

    const content = modal.querySelector('.modal-content');

    if(modal.classList.contains('modal-top')) content.style.transform = 'translateY(-50px)';
    else if(modal.classList.contains('modal-bottom')) content.style.transform = 'translateY(50px)';
    else if(modal.classList.contains('modal-left')) content.style.transform = 'translateX(-50px)';
    else if(modal.classList.contains('modal-right')) content.style.transform = 'translateX(50px)';
    else content.style.transform = 'translateY(0)';

    content.style.opacity = '0';

    setTimeout(() => {
        modal.style.display = 'none';
        content.style.transition = '';
        content.style.transform = '';
        content.style.opacity = '';
    }, 300);

    if(id === 'orderItemsModal') document.getElementById('orderItemsContent').innerHTML = '';
}

// ===== REPLY MODAL =====
function openReplyModal(email) {
    openModal('replyModal');
    document.getElementById('to_email').value = email;
}

// ===== AJAX SEND REPLY =====
document.getElementById('replyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const feedback = document.getElementById('replyFeedback');
    feedback.style.color = 'green';
    feedback.innerText = 'Sending...';

    fetch('send_reply.php', { method:'POST', body: formData })
        .then(res => res.text())
        .then(data => {
            if(data.trim() === 'success'){
                feedback.innerText = 'Reply sent successfully!';
                const email = formData.get('to_email');
                const row = document.querySelector(`#messagesTable tr[data-email='${email}']`);
                if(row){
                    row.querySelector('.status-cell').innerHTML = '<span style="color:green;font-weight:bold;">Replied</span>';
                    row.querySelector('.action-cell').innerHTML = '<button class="btn-action" disabled style="background:#ccc; cursor:not-allowed;">Reply</button>';
                }
                setTimeout(() => {
                    document.getElementById('replyForm').reset();
                    closeModal('replyModal');
                }, 1500);
            } else {
                feedback.style.color = 'red';
                feedback.innerText = 'Failed to send reply. Try again.';
            }
        })
        .catch(err => {
            feedback.style.color = 'red';
            feedback.innerText = 'An error occurred. Please try again.';
        });
});

// ===== FETCH ORDER ITEMS =====
function openOrderItemsModal(orderId){
    openModal('orderItemsModal');
    fetch('get_order_items.php?order_id=' + orderId)
        .then(response => response.text())
        .then(html => {
            document.getElementById('orderItemsContent').innerHTML = html;
        })
        .catch(err => {
            document.getElementById('orderItemsContent').innerHTML = '<p>Error loading items</p>';
        });
}

// ===== CLOSE MODAL WHEN CLICKING OUTSIDE =====
window.onclick = function(e) {
    ['usersModal','messagesModal','ordersModal','orderItemsModal','replyModal'].forEach(id => {
        if(e.target === document.getElementById(id)) closeModal(id);
    });
}

// ===== THEME TOGGLE =====
document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("themeBtn");
    if(localStorage.theme === "dark"){
        document.body.classList.add("dark");
        btn.textContent = "☀️";
    }
    window.toggleTheme = () => {
        document.body.classList.toggle("dark");
        localStorage.theme = document.body.classList.contains("dark") ? "dark" : "light";
        btn.textContent = document.body.classList.contains("dark") ? "☀️" : "🌙";
    }
});
