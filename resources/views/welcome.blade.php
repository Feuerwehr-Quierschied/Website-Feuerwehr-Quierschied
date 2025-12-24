<x-layout>
<h1>Willkommen</h1>
    <br>
    <p>Noch bissl anschaulicher Müll^^</p>
    @if (file_exists(storage_path('logs/perf.log')))
    <div class="mt-4 p-4 bg-gray-100 text-sm text-gray-800">
        <strong>perf.log</strong>
        <pre class="whitespace-pre-wrap">{{ file_get_contents(storage_path('logs/perf.log')) }}</pre>
    </div>
    @endif
</x-layout>