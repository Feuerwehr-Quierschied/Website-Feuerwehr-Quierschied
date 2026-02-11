<x-layout>

<div class="flex items-stretch justify-center gap-4 md:py-6 max-sm:flex-col">
    <div class="flex-1 min-w-0 flex !hidden md:!flex">
        <x-aktuelles-widget />
    </div>

    <div class="flex-2 flex flex-col justify-center items-center border-b-4 md:border-4 border-red-700  max-sm:mx-auto">
        <img src="{{ Storage::url('images/image.png') }}" alt="Titelfoto" class="w-full max-w-full h-auto block">

    </div>
    <div class="md:hidden">
        <x-mobile-widgets-tabbed />
    </div>

    <div class="flex-1 min-w-0 flex !hidden md:!flex">
        <x-einsaetze-widget />
    </div>
</div>
@if($welcomeIntro ?? null)
<div class="max-w-4xl mx-auto my-8 px-4 mt-10">
    <div class="relative rounded-xl bg-gray-800 p-6 shadow-lg shadow-red-950/30">
        <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white border-b-2 border-red-700 pb-2">
            {{ $welcomeIntro->title }}
        </h2>
        <p class="text-def-text leading-relaxed whitespace-pre-line">{{ $welcomeIntro->body }}</p>
    </div>
</div>
@endif
</x-layout>