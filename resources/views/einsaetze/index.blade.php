<x-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-fire-red mb-8">Einsätze</h1>

        <div class="space-y-6">
            @forelse($einsaetze as $einsatz)
                <article class="bg-background-dropdown border-l-4 border-fire-red p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
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
                           class="inline-flex items-center px-4 py-2 bg-fire-red text-white rounded-lg hover:bg-red-600 transition-colors">
                            Mehr lesen
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="bg-background-dropdown border-l-4 border-gray-500 p-8 rounded-lg text-center">
                    <p class="text-def-text text-lg">Keine Einsätze gefunden.</p>
                </div>
            @endforelse
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

