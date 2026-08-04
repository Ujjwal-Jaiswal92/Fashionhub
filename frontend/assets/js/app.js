// =========================
// Mobile Navigation
// =========================

const menuBtn = document.querySelector(".menu-toggle");
const navMenu = document.querySelector(".nav-links");

if (menuBtn) {
    menuBtn.addEventListener("click", () => {
        navMenu.classList.toggle("active");
    });
}

// =========================
// Sticky Navbar
// =========================

window.addEventListener("scroll", () => {

    const navbar = document.querySelector(".navbar");

    if (!navbar) return;

    if (window.scrollY > 50) {
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }

});

// =========================
// Scroll To Top
// =========================

const topBtn = document.getElementById("scrollTop");

if (topBtn) {

    window.addEventListener("scroll", () => {

        topBtn.style.display = window.scrollY > 300 ? "block" : "none";

    });

    topBtn.addEventListener("click", () => {

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    });

}