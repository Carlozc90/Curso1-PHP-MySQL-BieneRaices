document.addEventListener("DOMContentLoaded", function () {
  eventListeners();

  darkMode();
});

function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", navResponsive);
}

function darkMode() {
  const botonDarkMode = document.querySelector(".dark-mode-boton");
  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
  });
}

function navResponsive() {
  const navegacion = document.querySelector(".navegacion");

  navegacion.classList.toggle("mostrar"); //es lo mismo que el if

  // if (navegacion.classList.contains("mostrar")) {
  //   navegacion.classList.remove("mostrar");
  // } else {
  //   navegacion.classList.add("mostrar");
  // }
}
