const toggleButton = document.getElementById("toggle-button");
const closeButton = document.getElementById("close-button");
const navbar = document.getElementById("nav-container");

toggleButton.addEventListener("click", () => {
    // navbar.style.display = "flex";
    navbar.classList.add("navbar-show");
    navbar.classList.remove("navbar-hide");
    toggleButton.style.display = "none";
    closeButton.style.display = "block";
});

closeButton.addEventListener("click", () => {
    // navbar.style.display = "none";
    navbar.classList.remove("navbar-show");
    navbar.classList.add("navbar-hide");
    toggleButton.style.display = "block";
    closeButton.style.display = "none";
});
