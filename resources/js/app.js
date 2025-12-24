import "./bootstrap";

document.addEventListener('DOMContentLoaded', function () {
    // 1. Hauptmenü Toggle (Hamburger)
    const menuButton = document.getElementById('navbar-mv-button');
    const navbar = document.getElementById('navbar-default');

    menuButton.addEventListener('click', function() {
        navbar.classList.toggle('hidden');
    });

    // 2. Dropdown Toggle für Mobile
    const dropdownContainers = document.querySelectorAll('.dropdown-container');

    dropdownContainers.forEach(container => {
        const button = container.querySelector('.dropdown-button');
        const menu = container.querySelector('.dropdown-menu');
        const icon = container.querySelector('svg');

        button.addEventListener('click', function(event) {
            // Nur auf Mobile aktiv (Tailwind md = 768px)
            if (window.innerWidth < 768) {
                event.preventDefault(); // Verhindert ungewollte Links
                
                // Andere offene Dropdowns schließen (optional)
                dropdownContainers.forEach(other => {
                    if (other !== container) {
                        other.querySelector('.dropdown-menu').classList.add('hidden');
                        other.querySelector('svg').classList.remove('rotate-180');
                    }
                });

                // Aktuelles Dropdown toggeln
                menu.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            }
        });
    });

    // 3. Mobile: Toggle nested 'Abteilungen' submenu on click
    const abtButtons = document.querySelectorAll('.abteilungen-btn');

    abtButtons.forEach(btn => {
        btn.addEventListener('click', function(event) {
            if (window.innerWidth < 768) {
                event.preventDefault();
                const submenu = btn.nextElementSibling; // .abteilungen-submenu
                if (!submenu) return;
                submenu.classList.toggle('hidden');
                const chevron = btn.querySelector('.chevron');
                if (chevron) {
                    chevron.classList.toggle('rotate-180');
                    chevron.classList.toggle('rotate-0');
                }
            }
        });
    });

});
