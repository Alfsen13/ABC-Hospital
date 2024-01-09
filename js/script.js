// Togle Class Active
const navbarNav = document.querySelector(".navbar-nav");
//Ketika Menu di klik
document.querySelector("#menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

//Klik diluar sidebar untuk menghilangkan nav
const daftar = document.querySelector("#menu");

document.addEventListener("click", function (e) {
  if (!daftar.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});
