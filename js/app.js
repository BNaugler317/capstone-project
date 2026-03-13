document.addEventListener("DOMContentLoaded", () => {
  const page = document.querySelector(".page");
  const hamburgerBtn = document.getElementById("hamburgerBtn");

  if (!page || !hamburgerBtn) return;

  hamburgerBtn.addEventListener("click", () => {
    page.classList.toggle("menu-closed");
  });
});

document.addEventListener("DOMContentLoaded", () => {

  document.querySelectorAll(".menu-toggle").forEach(toggle=> {
  
    toggle.addEventListener("click", () => {
    
      const submenu = toggle.nextElementSibling;

      submenu.classList.toggle("closed");

    });

  });

});