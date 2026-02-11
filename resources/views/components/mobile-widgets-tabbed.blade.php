@php
    $einsaetze = \App\Models\Einsatz::query()
        ->whereNotNull('timestamp')
        ->latest('timestamp')
        ->limit(5)
        ->get();
    $aktuelles = \App\Models\Aktuelles::query()
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->limit(5)
        ->get();
    $defaultTab = $einsaetze->isNotEmpty() ? 'einsaetze' : 'aktuelles';
@endphp

@if($einsaetze->isNotEmpty() || $aktuelles->isNotEmpty())
    <div id="mobile-widgets-tabbed" class="md:hidden w-full max-w-md mx-auto mt-4 px-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col">
            {{-- Tab buttons --}}
            <div class="flex border-b-2 border-red-700">
                <button type="button"
                        data-tab="einsaetze"
                        class="mobile-widget-tab flex-1 py-3 px-4 text-center font-semibold transition-colors border-b-2 border-transparent -mb-0.5 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white data-[active=true]:text-red-700 dark:data-[active=true]:text-red-400 data-[active=true]:border-red-700 data-[active=true]:border-b-2"
                        data-active="{{ $defaultTab === 'einsaetze' ? 'true' : 'false' }}">
                    Einsätze
                </button>
                <button type="button"
                        data-tab="aktuelles"
                        class="mobile-widget-tab flex-1 py-3 px-4 text-center font-semibold transition-colors border-b-2 border-transparent -mb-0.5 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white data-[active=true]:text-red-700 dark:data-[active=true]:text-red-400 data-[active=true]:border-red-700 data-[active=true]:border-b-2"
                        data-active="{{ $defaultTab === 'aktuelles' ? 'true' : 'false' }}">
                    Aktuelles
                </button>
            </div>

            {{-- Tab panels --}}
            <div class="p-4 grow">
                <div data-panel="einsaetze" class="mobile-widget-panel space-y-4" style="{{ $defaultTab !== 'einsaetze' ? 'display: none;' : '' }}">
                    @forelse($einsaetze as $einsatz)
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-3 last:border-b-0 last:pb-0">
                            <a href="{{ route('einsaetze.show', $einsatz->slug) }}"
                               class="block hover:text-red-700 dark:hover:text-red-400 transition-colors">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2">
                                    {{ $einsatz->title }}
                                </h3>
                                @if($einsatz->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                        {{ $einsatz->description }}
                                    </p>
                                @endif
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Aktuell keine Einsätze.</p>
                    @endforelse
                    <div class="mt-4">
                        <a href="{{ route('einsaetze.index') }}"
                           class="text-sm text-red-700 dark:text-red-400 hover:underline font-medium">
                            Alle anzeigen →
                        </a>
                    </div>
                </div>

                <div data-panel="aktuelles" class="mobile-widget-panel space-y-4" style="{{ $defaultTab !== 'aktuelles' ? 'display: none;' : '' }}">
                    @forelse($aktuelles as $item)
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-3 last:border-b-0 last:pb-0">
                            <a href="{{ route('aktuelles.show', $item->slug) }}"
                               class="block hover:text-red-700 dark:hover:text-red-400 transition-colors">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                @if($item->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                        {{ $item->description }}
                                    </p>
                                @endif
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">Aktuell keine Einträge.</p>
                    @endforelse
                    <div class="mt-4">
                        <a href="{{ route('aktuelles.index') }}"
                           class="text-sm text-red-700 dark:text-red-400 hover:underline font-medium">
                            Alle anzeigen →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('mobile-widgets-tabbed');
            if (!container) return;

            const tabs = container.querySelectorAll('.mobile-widget-tab');
            const panels = container.querySelectorAll('.mobile-widget-panel');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;

                    tabs.forEach(t => {
                        t.dataset.active = t.dataset.tab === targetTab ? 'true' : 'false';
                    });

                    panels.forEach(panel => {
                        panel.style.display = panel.dataset.panel === targetTab ? '' : 'none';
                    });
                });
            });
        });
    </script>
@endif
