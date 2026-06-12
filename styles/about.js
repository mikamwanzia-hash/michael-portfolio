
function toggleMenu(){
    document.getElementById("navMenu").classList.toggle("show");
}


// BACKGROUND SLIDESHOW
const slides = document.querySelectorAll('.bg-slideshow img');
let currentSlide = 0;

function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
}

if (slides.length > 1) {
    setInterval(nextSlide, 3000);  // Changed interval to 2 seconds
}



// TYPING EFFECT
const typeText = document.getElementById('typeText');
const messages = [
    "Top Star Hotel.",

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