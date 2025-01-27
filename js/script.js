// Gérer l'affichage de la flèche de défilement vers le bas
const scrollDown = document.querySelector(".scroll-down"),
  navLists = document.querySelector(".nav__lists"),
  menuBtn = document.querySelector("#menu-btn");

// Masquer la flèche de défilement si l'utilisateur a fait défiler vers le bas
window.addEventListener("scroll", () => {
  if (window.scrollY > 60) {
    scrollDown.classList.add("hide");
  } else {
    scrollDown.classList.remove("hide");
  }
});

// Gérer l'ouverture et la fermeture du menu de navigation
let menuIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", () => {
  // Basculer la classe pour afficher ou masquer le menu
  navLists.classList.toggle("open-menu");

  // Basculer les icônes de menu et de fermeture
  if (menuIcon.classList.contains("ri-menu-line")) {
    menuIcon.classList.remove("ri-menu-line");
    menuIcon.classList.add("ri-close-line");
  } else {
    menuIcon.classList.add("ri-menu-line");
    menuIcon.classList.remove("ri-close-line");
  }

  // Fermer le menu lorsqu'un élément est cliqué
  navLists.addEventListener("click", () => {
    navLists.classList.remove("open-menu");
    menuIcon.classList.remove("ri-close-line");
    menuIcon.classList.add("ri-menu-line");
  });
});

// Gérer le mode sombre
const darkModeBtn = document.getElementById("toggle-mode");
const lightModeImgs = document.querySelectorAll(".light-mode");
const darkModeImgs = document.querySelectorAll(".dark-mode");

// Mettre à jour l'état du mode sombre en fonction du stockage local
const updateDarkMode = () => {
  const isDark = localStorage.getItem("darkMode") === "true";

  if (isDark) {
    document.body.classList.add("dark");
    darkModeBtn.classList.add("ri-moon-fill");
    darkModeBtn.classList.remove("ri-sun-fill");
    lightModeImgs.forEach((img) => (img.style.display = "block"));
    darkModeImgs.forEach((img) => (img.style.display = "none"));
  } else {
    document.body.classList.remove("dark");
    darkModeBtn.classList.add("ri-sun-fill");
    darkModeBtn.classList.remove("ri-moon-fill");
    lightModeImgs.forEach((img) => (img.style.display = "none"));
    darkModeImgs.forEach((img) => (img.style.display = "block"));
  }
};

// Basculer entre mode sombre et mode clair
darkModeBtn.addEventListener("click", () => {
  const isDark = document.body.classList.toggle("dark");

  // Sauvegarder l'état dans le stockage local
  localStorage.setItem("darkMode", isDark.toString());

  if (isDark) {
    darkModeBtn.classList.remove("ri-sun-fill");
    darkModeBtn.classList.add("ri-moon-fill");
    lightModeImgs.forEach((img) => (img.style.display = "block"));
    darkModeImgs.forEach((img) => (img.style.display = "none"));
  } else {
    darkModeBtn.classList.remove("ri-moon-fill");
    darkModeBtn.classList.add("ri-sun-fill");
    lightModeImgs.forEach((img) => (img.style.display = "none"));
    darkModeImgs.forEach((img) => (img.style.display = "block"));
  }
});

// Initialiser le mode sombre au chargement de la page
updateDarkMode();

// Gérer la mise en surbrillance du lien actif dans le menu de navigation
const navLinks = document.querySelectorAll(".nav__lists li a");

navLinks.forEach((link) => {
  link.addEventListener("click", () => {
    navLinks.forEach((link) => link.removeAttribute("id"));
    link.setAttribute("id", "active");
  });
});

// Défilement fluide vers les sections avec les liens d'ancrage
const links = document.querySelectorAll('a[href^="#"]');

links.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();

    const targetId = link.getAttribute("href");
    const targetElement = document.querySelector(targetId);
    const targetPosition = targetElement?.offsetTop - 100;

    window.scrollTo({
      top: targetPosition,
      behavior: "smooth",
    });
  });
});
