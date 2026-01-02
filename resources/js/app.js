import "./bootstrap";

document.addEventListener('DOMContentLoaded', function () {
    // 1. Hauptmenü Toggle (Hamburger)
    const menuButton = document.getElementById('navbar-mv-button');
    const navbar = document.getElementById('navbar-default');

    menuButton.addEventListener('click', function() {
        navbar.classList.toggle('hidden');
    });

    // 2. Dropdown Toggle für Mobile (nur Chevron)
    const dropdownContainers = document.querySelectorAll('.dropdown-container');

    dropdownContainers.forEach(container => {
        const chevronButton = container.querySelector('.dropdown-chevron');
        const menu = container.querySelector('.dropdown-menu');
        const chevronIcon = chevronButton?.querySelector('svg');

        if (chevronButton && chevronIcon) {
            chevronButton.addEventListener('click', function(event) {
                // Nur auf Mobile aktiv (Tailwind md = 768px)
                if (window.innerWidth < 768) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    // Andere offene Dropdowns schließen (optional)
                    dropdownContainers.forEach(other => {
                        if (other !== container) {
                            other.querySelector('.dropdown-menu')?.classList.add('hidden');
                            const otherChevron = other.querySelector('.dropdown-chevron svg');
                            if (otherChevron) {
                                otherChevron.classList.remove('rotate-180');
                            }
                        }
                    });

                    // Aktuelles Dropdown toggeln
                    menu.classList.toggle('hidden');
                    chevronIcon.classList.toggle('rotate-180');
                }
            });
        }
    });

    // 3. Mobile: Toggle nested 'Abteilungen' submenu on chevron click
    const abtChevronButtons = document.querySelectorAll('.abteilungen-chevron');

    abtChevronButtons.forEach(btn => {
        btn.addEventListener('click', function(event) {
            if (window.innerWidth < 768) {
                event.preventDefault();
                event.stopPropagation();
                const abteilungenGroup = btn.closest('.abteilungen-group');
                if (!abteilungenGroup) return;
                const submenu = abteilungenGroup.querySelector('.abteilungen-submenu');
                if (!submenu) return;
                submenu.classList.toggle('hidden');
                const chevronIcon = btn.querySelector('svg');
                if (chevronIcon) {
                    chevronIcon.classList.toggle('rotate-180');
                    chevronIcon.classList.toggle('rotate-0');
                }
            }
        });
    });

});
