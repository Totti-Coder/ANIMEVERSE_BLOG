// Esperamos a que el HTML esté cargado completamente
document.addEventListener('DOMContentLoaded', () => {

    // --- MENÚ DE NAVEGACIÓN PARA MOVILES ---
    const navItems = document.querySelector(".nav__items");
    const openNavBtn = document.querySelector("#open__nav-btn");
    const closeNavBtn = document.querySelector("#close__nav-btn");

    if (openNavBtn && closeNavBtn && navItems) {
        openNavBtn.addEventListener("click", () => {
            navItems.style.display = "flex";
            openNavBtn.style.display = "none";
            closeNavBtn.style.display = "inline-block";
        });

        closeNavBtn.addEventListener("click", () => {
            navItems.style.display = "none";
            openNavBtn.style.display = "inline-block";
            closeNavBtn.style.display = "none";
        });
    }

    // --- SIDEBAR (PANEL DE CONTROL / SECCION DE ADMIN) ---
    const sidebar = document.querySelector("aside");
    const showSideBarBtn = document.querySelector("#show__sidebar-btn");
    const hideSideBarBtn = document.querySelector("#hide__sidebar-btn");

    if (showSideBarBtn && hideSideBarBtn && sidebar) {
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
    }

    // --- BARRA DE BUSQUEDA EN EL BLOG.PHP  ---
    const searchInput = document.querySelector('input[name="search"]');
    const postsContainer = document.querySelector('.posts__container');

    if (searchInput && postsContainer) {
        searchInput.addEventListener('input', () => {
            const value = searchInput.value;

            fetch(`search-logic.php?search=${value}`)
                .then(response => response.text())
                .then(data => {
                    postsContainer.innerHTML = data;
                })
                .catch(error => console.error('Error en fetch:', error));
        });
    }
});