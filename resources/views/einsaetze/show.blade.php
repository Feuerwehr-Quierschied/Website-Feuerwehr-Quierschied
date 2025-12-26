<x-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('einsaetze.index') }}" 
           class="inline-flex items-center text-fire-red hover:text-red-600 mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Zurück zur Einsatzübersicht
        </a>

        <article class="bg-background-dropdown rounded-lg shadow-lg overflow-hidden">
            @if($einsatz->image_url)
                <div class="w-full h-64 md:h-96 overflow-hidden">
                    <img src="{{ $einsatz->image_url }}" 
                         alt="{{ $einsatz->title }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

            <div class="p-8">
                <header class="mb-6 pb-6 border-b-2 border-gray-700">
                <h1 class="text-4xl font-bold text-white mb-4">{{ $einsatz->title }}</h1>

                <div class="flex flex-wrap gap-4 text-sm text-gray-400">
                    <span class="flex items-center gap-2">
                        <span class="font-semibold">Einsatznummer:</span>
                        {{ $einsatz->einsatznummer }}
                    </span>
                    @if($einsatz->timestamp)
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="font-semibold">Einsatzdatum:</span>
                            {{ $einsatz->timestamp->format('d.m.Y H:i') }}
                        </span>
                    @endif
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-semibold">Erstellt:</span>
                        {{ $einsatz->created_at->format('d.m.Y H:i') }}
                    </span>
                    @if($einsatz->updated_at->ne($einsatz->created_at))
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span class="font-semibold">Aktualisiert:</span>
                            {{ $einsatz->updated_at->format('d.m.Y H:i') }}
                        </span>
                    @endif
                </div>
                </header>

            @if($einsatz->description)
                <div class="mb-6 p-4 bg-gray-800 rounded-lg border-l-4 border-fire-red">
                    <p class="text-def-text text-lg leading-relaxed">{{ $einsatz->description }}</p>
                </div>
            @endif

            <div class="text-def-text leading-relaxed
                [&_h1]:text-4xl [&_h1]:font-semibold [&_h1]:text-white [&_h1]:mt-8 [&_h1]:mb-4
                [&_h2]:text-3xl [&_h2]:font-semibold [&_h2]:text-white [&_h2]:mt-8 [&_h2]:mb-4
                [&_h3]:text-2xl [&_h3]:font-semibold [&_h3]:text-white [&_h3]:mt-8 [&_h3]:mb-4
                [&_h4]:text-xl [&_h4]:font-semibold [&_h4]:text-white [&_h4]:mt-8 [&_h4]:mb-4
                [&_h5]:text-lg [&_h5]:font-semibold [&_h5]:text-white [&_h5]:mt-8 [&_h5]:mb-4
                [&_h6]:text-base [&_h6]:font-semibold [&_h6]:text-white [&_h6]:mt-8 [&_h6]:mb-4
                [&_p]:mb-5
                [&_ul]:mb-5 [&_ul]:pl-6
                [&_ol]:mb-5 [&_ol]:pl-6
                [&_li]:mt-2 [&_li]:mb-2
                [&_strong]:text-white [&_strong]:font-semibold
                [&_a]:text-fire-red [&_a]:underline [&_a:hover]:text-red-600
                [&_blockquote]:border-l-4 [&_blockquote]:border-fire-red [&_blockquote]:pl-4 [&_blockquote]:my-6 [&_blockquote]:italic
                [&_code]:bg-black/30 [&_code]:px-1.5 [&_code]:py-0.5 [&_code]:rounded [&_code]:text-sm
                [&_pre]:bg-black/30 [&_pre]:p-4 [&_pre]:rounded-lg [&_pre]:overflow-x-auto [&_pre]:my-6
                [&_img]:max-w-full [&_img]:h-auto [&_img]:rounded-lg [&_img]:my-6">
                {!! $einsatz->rendered_body !!}
            </div>

            @if($einsatz->im_einsatz_waren && count($einsatz->im_einsatz_waren) > 0)
                <div class="mt-6 pt-6 border-t-2 border-gray-700">
                    <h3 class="text-xl font-semibold text-white mb-4">Im Einsatz waren:</h3>
                    <ul class="list-disc list-inside space-y-2 text-def-text">
                        @foreach($einsatz->im_einsatz_waren as $person)
                            <li>{{ $person }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
        </article>
    </div>
</x-layout>

