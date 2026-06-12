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

function toggleMenu() {
    document.getElementById('navMenu').classList.toggle('show');
}