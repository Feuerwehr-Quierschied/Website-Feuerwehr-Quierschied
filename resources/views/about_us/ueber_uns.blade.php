<x-layout>
    <div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
        {{-- Hero / Zitat --}}
        <div class="relative rounded-xl bg-gray-800 p-8 md:p-10 shadow-lg shadow-red-950/30 mb-12 text-center  border-fire-red">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Über uns</h1>
            <p class="text-xl md:text-2xl text-fire-red font-semibold italic">
                „Ehrenamtlich, professionell und seit über 125 Jahren für Sie da.“
            </p>
            <p class="text-def-text mt-2 text-sm">Ihre Feuerwehr in der Gemeinde Quierschied</p>
        </div>

        {{-- Wer wir sind --}}
        <section class="relative rounded-xl bg-gray-800 p-6 md:p-8 shadow-lg shadow-red-950/30 mb-12">
            <h2 class="text-2xl font-bold mb-4 text-white border-b-2 border-red-700 pb-2">
                Wer wir sind
            </h2>
            <p class="text-def-text leading-relaxed">
                Die Freiwillige Feuerwehr Quierschied ist mehr als nur Technik und Blaulicht – wir sind eine Gemeinschaft aus über 60 aktiven Bürgerinnen und Bürgern, die Tag und Nacht bereitstehen, um in unserer Gemeinde Hilfe zu leisten. Ob Brände, Unfälle oder technische Hilfeleistungen: Wir sind zur Stelle, wenn es darauf ankommt.
            </p>
        </section>

        {{-- Mannschaftsfoto --}}
        <div class="my-12 rounded-xl overflow-hidden border-4 border-red-700 shadow-lg shadow-red-950/30">
            <img src="{{ Storage::url('images/mannschaftsfoto.jpg') }}" 
                 alt="Mannschaft der Freiwilligen Feuerwehr Quierschied" 
                 class="w-full h-auto object-cover min-h-[280px] bg-gray-800"
                 onerror="this.src='https://placehold.co/1200x400/272a2e/FB2C36?text=Mannschaftsfoto'; this.onerror=null;">
        </div>

        {{-- Unsere Struktur --}}
        <section class="relative rounded-xl bg-gray-800 p-6 md:p-8 shadow-lg shadow-red-950/30 mb-12">
            <h2 class="text-2xl font-bold mb-4 text-white border-b-2 border-red-700 pb-2">
                Unsere Struktur: Zwei Standorte, eine Mission
            </h2>
            <p class="text-def-text leading-relaxed mb-6">
                Um im Notfall schnellstmöglich vor Ort zu sein, gliedert sich unsere Wehr in zwei starke Löschbezirke:
            </p>
            <div class="space-y-6">
                <div class="p-4 rounded-lg bg-background-dropdown border-l-4 border-fire-red">
                    <h3 class="text-lg font-semibold text-white mb-2">Löschbezirk 1 Quierschied</h3>
                    <p class="text-def-text leading-relaxed">
                        Unser Team im Kernort sorgt mit moderner Technik – unter anderem zwei HLF 20 und einer Drehleiter (DLK 18/12) – für Sicherheit. Geführt wird der Löschbezirk von drei Löschbezirksführern.
                    </p>
                </div>
                <div class="p-4 rounded-lg bg-background-dropdown border-l-4 border-fire-red">
                    <h3 class="text-lg font-semibold text-white mb-2">Löschbezirk 2 Fischbach-Camphausen</h3>
                    <p class="text-def-text leading-relaxed">
                        Mit einer soliden Ausstattung, bestehend aus einem TSF-W, dem LF 16 und einem GW-Logistik 2, ist der Löschbezirk 2 unter der Leitung von zwei Löschbezirksführern ein unverzichtbarer Teil unserer Einsatzbereitschaft.
                    </p>
                </div>
            </div>
            <p class="text-def-text leading-relaxed mt-6">
                Geleitet wird die gesamte Wehr der Gemeinde durch unsere zwei Wehrführer, die die strategischen Geschicke beider Löschbezirke koordinieren.
            </p>
        </section>

        {{-- Eine starke Tradition --}}
        <section class="relative rounded-xl bg-gray-800 p-6 md:p-8 shadow-lg shadow-red-950/30 mb-12">
            <h2 class="text-2xl font-bold mb-4 text-white border-b-2 border-red-700 pb-2">
                Eine starke Tradition
            </h2>
            <p class="text-def-text leading-relaxed">
                Unsere Wurzeln reichen weit zurück: Seit über 125 Jahren leisten wir ununterbrochen Dienst am Nächsten. Auf dieses Fundament aus über einem Jahrhundert Erfahrung bauen wir heute auf, indem wir modernste Ausrüstung mit Kameradschaft und Mut verbinden.
            </p>
        </section>

        {{-- Unsere Abteilungen --}}
        <section class="relative rounded-xl bg-gray-800 p-6 md:p-8 shadow-lg shadow-red-950/30">
            <h2 class="text-2xl font-bold mb-4 text-white border-b-2 border-red-700 pb-2">
                Unsere Abteilungen – Für jede Generation
            </h2>
            <p class="text-def-text leading-relaxed mb-6">
                Feuerwehr ist bei uns Teamarbeit über Altersgrenzen hinweg:
            </p>
            <ul class="space-y-4">
                <li class="flex gap-3 items-start">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-fire-red flex items-center justify-center text-white font-bold text-sm">1</span>
                    <div>
                        <span class="font-semibold text-white">Einsatzabteilung:</span>
                        <span class="text-def-text"> Das Herzstück unserer Wehr mit rund 60 aktiven Einsatzkräften.</span>
                    </div>
                </li>
                <li class="flex gap-3 items-start">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-fire-red flex items-center justify-center text-white font-bold text-sm">2</span>
                    <div>
                        <span class="font-semibold text-white">Jugendfeuerwehr:</span>
                        <span class="text-def-text"> Hier wachsen die Retter von morgen heran. Kameradschaft und Spaß an der Technik stehen hier im Vordergrund.</span>
                    </div>
                </li>
                <li class="flex gap-3 items-start">
                    <span class="flex-shrink-0 w-8 h-8 rounded-full bg-fire-red flex items-center justify-center text-white font-bold text-sm">3</span>
                    <div>
                        <span class="font-semibold text-white">Alters- & Ehrenabteilung:</span>
                        <span class="text-def-text"> Unsere erfahrenen Kameraden bleiben auch nach der aktiven Dienstzeit ein wichtiger Teil unserer Gemeinschaft.</span>
                    </div>
                </li>
            </ul>
        </section>
    </div>
</x-layout>
