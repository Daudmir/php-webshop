const menuBtn = document.getElementById("menu-btn");
const menu = document.getElementById("menu");

menuBtn.addEventListener("click", () => {
  menu.classList.toggle("active");

  if (menuBtn.textContent === 'Menu') {
    menuBtn.textContent = '←';
  } else {
    menuBtn.textContent = 'Menu';
  }
});

