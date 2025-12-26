<x-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-fire-red mb-8">Einsätze</h1>

        <form method="GET" action="{{ route('einsaetze.index') }}" class="mb-8 bg-background-dropdown p-6 rounded-lg shadow-lg">
            <div class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 md:flex-none">
                    <label for="year" class="block text-sm font-medium text-def-text mb-2">Jahr</label>
                    <select name="year" id="year" class="w-full md:w-32 px-4 py-2 bg-background-dark border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-fire-red">
                        <option value="">Alle Jahre</option>
                        @for($y = date('Y'); $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="flex-1 md:flex-none">
                    <label for="month" class="block text-sm font-medium text-def-text mb-2">Monat</label>
                    <select name="month" id="month" class="w-full md:w-40 px-4 py-2 bg-background-dark border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-fire-red">
                        <option value="">Alle Monate</option>
                        @foreach([
                            1 => 'Januar',
                            2 => 'Februar',
                            3 => 'März',
                            4 => 'April',
                            5 => 'Mai',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'August',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Dezember'
                        ] as $num => $name)
                            <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-6 py-2 bg-fire-red text-white rounded-lg hover:bg-red-600 transition-colors font-medium">
                        Filtern
                    </button>
                    @if($selectedYear || $selectedMonth)
                        <a href="{{ route('einsaetze.index') }}" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors font-medium">
                            Zurücksetzen
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <div class="w-full overflow-x-auto border border-gray-200 rounded-lg">
            <table class="bg-background-dropdown min-w-full text-def-text table-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-def-text uppercase tracking-wider">Titel</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-def-text uppercase tracking-wider">Einsatznummer</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-def-text uppercase tracking-wider">Alarmzeit</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-def-text uppercase tracking-wider">Mehr lesen</th>
                </tr>

                    
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($einsaetze as $einsatz)
             
                <tr>
                    <td class="px-6 py-3 border-b text-left text-xs font-medium text-def-text uppercase tracking-wider">{{ $einsatz->title }}</td>
                    <td class="px-6 py-3 border-b text-left text-xs font-medium text-def-text uppercase tracking-wider">{{ $einsatz->einsatznummer }}</td>
                    <td class="px-6 py-3 border-b text-left text-xs font-medium text-def-text uppercase tracking-wider">{{ $einsatz->timestamp->format('d.m.Y H:i') }}</td>
                    <td class="px-6 py-3 border-b text-left text-xs font-medium text-def-text uppercase tracking-wider"><a href="{{ route('einsaetze.show', $einsatz->slug) }}" class="text-fire-red hover:text-red-600 transition-colors">Mehr lesen</a></td>
                    
                </tr>
             
<!--                 <article class="bg-background-dropdown border-l-4 border-fire-red p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex flex-col md:flex-row gap-6">
                        {{-- @if($einsatz->image_url)
                            <div class="md:w-1/3 flex-shrink-0">
                                <a href="{{ route('einsaetze.show', $einsatz->slug) }}">
                                    <img src="{{ $einsatz->image_url }}" 
                                         alt="{{ $einsatz->title }}"
                                         class="w-full h-48 object-cover rounded-lg hover:opacity-90 transition-opacity">
                                </a>
                            </div>
                        @endif --}}

                        <div class="flex-1 flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                            <div class="flex-1">
                                <div class="mb-2">
                                    <span class="text-fire-red font-semibold">Einsatz {{ $einsatz->einsatznummer }}</span>
                                </div>

                                <h2 class="text-2xl font-semibold text-white mb-2">
                                    <a href="{{ route('einsaetze.show', $einsatz->slug) }}" 
                                       class="hover:text-fire-red transition-colors">
                                        {{ $einsatz->title }}
                                    </a>
                                </h2>

                                @if($einsatz->description)
                                    <p class="text-def-text mb-4 line-clamp-2">
                                        {{ $einsatz->description }}
                                    </p>
                                @endif

                                <div class="flex flex-wrap gap-4 text-sm text-gray-400">
                                    @if($einsatz->timestamp)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $einsatz->timestamp->format('d.m.Y H:i') }}
                                        </span>
                                    @endif
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Erstellt: {{ $einsatz->created_at->format('d.m.Y') }}
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('einsaetze.show', $einsatz->slug) }}" 
                               class="inline-flex items-center px-4 py-2 bg-fire-red text-white rounded-lg hover:bg-red-600 transition-colors self-start">
                                Mehr lesen
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article> -->
            @empty
                <div class="bg-background-dropdown border-l-4 border-gray-500 p-8 rounded-lg text-center">
                    <p class="text-def-text text-lg">Keine Einsätze gefunden.</p>
                </div>
            @endforelse
            </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $einsaetze->links() }}
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-layout>

