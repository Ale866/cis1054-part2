const toggleButton = document.getElementById("open-button");
const closeButton = document.getElementById("close-button");
const navContainer = document.getElementById("nav-container");
const navbar = document.getElementById("navbar");

toggleButton.addEventListener("click", () => {
    navContainer.classList.add("navbar-show");
    navContainer.classList.remove("navbar-hide");
    navbar.style.position = "fixed";
    toggleButton.style.display = "none";
    closeButton.style.display = "block";
});

closeButton.addEventListener("click", () => {

    navContainer.classList.remove("navbar-show");
    navContainer.classList.add("navbar-hide");
    navbar.style.position = "relative";
    toggleButton.style.display = "block";
    closeButton.style.display = "none";
});
