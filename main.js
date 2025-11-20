const navItems = document.querySelector(".nav__items")
const openNavBtn = document.querySelector("#open__nav-btn")
const closeNavBtn = document.querySelector("#close__nav-btn")

// Open Nav Menu
openNavBtn.addEventListener("click", () => {
    navItems.style.display = "flex";
    openNavBtn.style.display = "none";
    closeNavBtn.style.display = "inline-block";
});

// Close Nav Menu
closeNavBtn.addEventListener("click", () => {
    navItems.style.display = "none";
    openNavBtn.style.display = "inline-block";
    closeNavBtn.style.display = "none";
});


const sidebar = document.querySelector("aside");
const showSideBarBtn = document.querySelector("#show__sidebar-btn");
const hideSideBarBtn = document.querySelector("#hide__sidebar-btn");


showSideBarBtn.addEventListener("click", () => {
    sidebar.style.left = "0";
    showSideBarBtn.style.display = "none";
    hideSideBarBtn.style.display = "inline-block";
});

hideSideBarBtn.addEventListener("click", () => {
    sidebar.style.left = "-100%";
    showSideBarBtn.style.display = "inline-block";
    hideSideBarBtn.style.display = "none";
});