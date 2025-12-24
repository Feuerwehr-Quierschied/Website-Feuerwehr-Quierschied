<!DOCTYPE html>
<html lang="de">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feuerwehr Quierschied</title>
    <style>
    /* Scoped desktop hover for Abteilungen: only this wrapper controls its submenu/chevron */
    @media (min-width:768px) {
        .abteilungen-btn .chevron { transform: rotate(-180deg); transition: transform .15s ease; }
        .abteilungen-group:hover .chevron { transform: rotate(0deg); }
        .abteilungen-submenu { display: none !important; }
        .abteilungen-group:hover .abteilungen-submenu { display: block !important; }
    }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <header>
        <nav class="bg-background-dark  border-b-4 border-red-700 w-full z-20 top-0 start-0 shadow-lg">
    <div class="max-w-7xl flex flex-wrap items-center justify-between mx-auto p-4">
        
        <a href="/" class="flex items-center space-x-3 group">
            
                <x-banner-dark class="w-auto"/>
            

        </a>

        <button id="navbar-mv-button" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-gray-400 rounded-lg md:hidden hover:bg-gray-800 focus:outline-none">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
        </button>

        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 md:flex-row md:space-x-8 md:mt-0">
                <li>
                    <a href="#" class="block py-2 px-3 text-fire-red hover:text-red-600  rounded md:bg-transparent  md:p-0 active" aria-current="page">Home</a>
                </li>

                <li class="relative group dropdown-container">
                    <button type="button" class="dropdown-button flex items-center justify-between w-full py-2 px-3 text-def-text hover:text-white md:p-0">
                        Über uns
                        <svg class="w-2.5 h-2.5 ms-2.5 transition-transform md:group-hover:rotate-180" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <div class="dropdown-menu hidden md:group-hover:block md:absolute left-0 z-10 md:w-56 pt-2 md:pt-4">
                        <ul class="bg-background-dropdown border-t-2 border-red-700 shadow-xl py-2 text-sm text-def-text">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-700 hover:text-fire-red">Geschichte der Feuerwehr</a>
                            </li>

                            <li class="relative abteilungen-group">
                                <button type="button" class="abteilungen-btn peer w-full text-left px-4 py-2 flex items-center justify-between hover:bg-gray-700 hover:text-fire-red">
                                    Abteilungen
                                    <svg class="chevron w-3 h-3 ms-2 transition-transform duration-150 rotate-180 md:group-hover:rotate-0" fill="none" viewBox="0 0 10 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 3l3 3 3-3"/>
                                    </svg>
                                </button>

                                <div class="abteilungen-submenu hidden md:group-hover:block md:absolute md:left-full md:top-0 z-20 w-44 mt-0 md:ml-0">
                                    <ul class="bg-background-dropdown border-t-2 border-red-700 shadow-xl py-2 text-sm text-def-text">
                                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-700 hover:text-fire-red">Jugendwehr</a></li>
                                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-700 hover:text-fire-red">Aktiv</a></li>
                                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-700 hover:text-fire-red">Ehrenabteilung</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                 <a href="#" class="block px-4 py-2 hover:bg-gray-700 hover:text-fire-red">Fahrzeuge</a>
                            </li>
                        </ul>
                    </div>

                </li>




                
                <li>
                    <a href="#" class="block py-2 px-3 text-def-text hover:text-white md:p-0 transition-colors">Fahrzeuge</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-def-text hover:text-white md:p-0 transition-colors">Aktuelles</a>
                </li>
                <li class="relative group dropdown-container"> <button type="button" class="dropdown-button flex items-center justify-between w-full py-2 px-3 text-def-text hover:text-white md:p-0">
                        Einsätze
                        <svg class="w-2.5 h-2.5 ms-2.5 transition-transform md:group-hover:rotate-180" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button> 
                    
                    <div class="dropdown-menu hidden md:group-hover:block md:absolute left-0 z-10 w-full md:w-44 pt-2 md:pt-4"> 
                        <ul class="bg-background-dropdown border-t-2 border-red-700 shadow-xl py-2 text-sm text-def-text">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-700 hover:text-fire-red">Fahrzeuge</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-def-text hover:text-white md:p-0 transition-colors">Förderverein</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 text-def-text hover:text-white md:p-0 transition-colors">Kontakt</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
    </header>

    <main class="grow">
        {{$slot}}
    </main>

<footer class="flex flex-col md:flex-row gap-3 items-center justify-around w-full py-4 text-sm bg-background-dark text-def-text ">

    <p>Copyright © 2025 Feuerwehr Quierschied</p>

    <div class="flex items-center gap-4">

        <a href="#" class="hover:text-white transition-all">
            Kontakt
        </a>

        <div class="h-8 w-px bg-white/20"></div>

        <a href="#" class="hover:text-white transition-all">
            Impressum
        </a>

        <div class="h-8 w-px bg-white/20"></div>

        <a href="#" class="hover:text-white transition-all">
            Datenschutz
        </a>

    </div>

</footer>
</body>
</html>