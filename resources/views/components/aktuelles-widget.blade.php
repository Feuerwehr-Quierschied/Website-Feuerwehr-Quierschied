@php
    $aktuelles = \App\Models\Aktuelles::query()
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->limit(5)
        ->get();
@endphp

@if($aktuelles->isNotEmpty())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 w-full flex flex-col">
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white border-b-2 border-red-700 pb-2">
            Aktuelles
        </h2>
        <div class="space-y-4 flex-grow">
            @foreach($aktuelles as $item)
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
            @endforeach
        </div>
        <div class="mt-4">
            <a href="{{ route('aktuelles.index') }}" 
               class="text-sm text-red-700 dark:text-red-400 hover:underline font-medium">
                Alle anzeigen →
            </a>
        </div>
    </div>
@endif

