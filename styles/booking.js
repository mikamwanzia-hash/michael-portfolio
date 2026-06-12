

// TYPING EFFECT
const typeText = document.getElementById('typeText');
const messages = [
    "To Book,Kindly...",
    "Don't misout!!...",

];

let msg = 0, char = 0, typing = true;

function typeEffect() {
    if (!typeText) return;

    if (typing) {
        if (char < messages[msg].length) {
            typeText.textContent += messages[msg][char++];
            setTimeout(typeEffect, 100);
        } else {
            typing = false;
            setTimeout(typeEffect, 2000);
        }
    } else {
        if (char > 0) {
            typeText.textContent = messages[msg].substring(0, --char);
            setTimeout(typeEffect, 50);
        } else {
            typing = true;
            msg = (msg + 1) % messages.length;
            setTimeout(typeEffect, 200);
        }
    }
}

window.addEventListener('load', () => setTimeout(typeEffect, 1000));


