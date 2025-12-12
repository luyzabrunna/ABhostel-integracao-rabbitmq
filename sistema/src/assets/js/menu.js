// Espera o DOM carregar antes de executar
document.addEventListener("DOMContentLoaded", function () {
  const btnOpen = document.querySelector(".btn.open");
  const mobileMenu = document.querySelector(".mobile-menu");

  // Abre o menu
  btnOpen.addEventListener("click", () => {
    mobileMenu.classList.toggle("open");
    const isOpen = mobileMenu.classList.contains("open");
    mobileMenu.setAttribute("aria-hidden", !isOpen);
    btnOpen.setAttribute("aria-label", isOpen ? "Fechar menu" : "Abrir menu");
    btnOpen.innerHTML = isOpen
      ? '<i class="fas fa-times"></i>' // Ícone de fechar
      : '<i class="fas fa-bars"></i>'; // Ícone de abrir
  });

  // Fecha o menu ao clicar em um link
  const links = mobileMenu.querySelectorAll("a");
  links.forEach((link) => {
    link.addEventListener("click", () => {
      mobileMenu.classList.remove("open");
      mobileMenu.setAttribute("aria-hidden", "true");
      btnOpen.setAttribute("aria-label", "Abrir menu");
      btnOpen.innerHTML = '<i class="fas fa-bars"></i>';
    });
  });
});