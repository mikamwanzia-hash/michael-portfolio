function toggleMenu() {
    const nav = document.getElementById('navMenu');
    const toggle = document.querySelector('.menu-toggle');

    nav.classList.toggle('show');

    // Change icon
    toggle.textContent = nav.classList.contains('show') ? '✖' : '☰';
}