<x-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('einsaetze.index') }}" 
           class="inline-flex items-center text-fire-red hover:text-red-600 mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Zurück zur Einsatzübersicht
        </a>

        <article class="bg-background-dropdown rounded-lg shadow-lg p-8">
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

            <div class="prose prose-invert prose-lg max-w-none">
                <div class="text-def-text leading-relaxed">
                    {!! $einsatz->rendered_body !!}
                </div>
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
        </article>
    </div>

    <style>
        .prose {
            color: #d1d5dc;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4,
        .prose h5,
        .prose h6 {
            color: #fff;
            font-weight: 600;
            margin-top: 2em;
            margin-bottom: 1em;
        }

        .prose h1 {
            font-size: 2.25em;
        }

        .prose h2 {
            font-size: 1.875em;
        }

        .prose h3 {
            font-size: 1.5em;
        }

        .prose p {
            margin-bottom: 1.25em;
        }

        .prose ul,
        .prose ol {
            margin-bottom: 1.25em;
            padding-left: 1.625em;
        }

        .prose li {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }

        .prose strong {
            color: #fff;
            font-weight: 600;
        }

        .prose a {
            color: #FB2C36;
            text-decoration: underline;
        }

        .prose a:hover {
            color: #dc2626;
        }

        .prose blockquote {
            border-left: 4px solid #FB2C36;
            padding-left: 1em;
            margin: 1.5em 0;
            font-style: italic;
        }

        .prose code {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 0.2em 0.4em;
            border-radius: 0.25em;
            font-size: 0.875em;
        }

        .prose pre {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 1em;
            border-radius: 0.5em;
            overflow-x: auto;
            margin: 1.5em 0;
        }

        .prose img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5em;
            margin: 1.5em 0;
        }
    </style>
</x-layout>

