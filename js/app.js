document.addEventListener("DOMContentLoaded", () => {
  const page = document.querySelector(".page");
  const hamburgerBtn = document.getElementById("hamburgerBtn");

  if (!page || !hamburgerBtn) return;

  hamburgerBtn.addEventListener("click", () => {
    page.classList.toggle("menu-closed");
  });
});