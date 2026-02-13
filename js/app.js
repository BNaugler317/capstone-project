const layout = document.getElementById('layout');
const hamburgerBtn = document.getElementById('hamburgerBtn');

if (hamburgerBtn && layout) {
    hamburgerBtn.addEventListener('click', () => {
        layout.classList.toggle("menu-closed");
    });
}