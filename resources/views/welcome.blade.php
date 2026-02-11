<x-layout>

<style>
.widgets-row{display:flex;align-items:stretch;justify-content:center;gap:1rem;margin:1.5rem 0;}
.widget{flex:1;min-width:0;display:flex}
.widget-center{flex:2;display:flex;justify-content:center;align-items:center}
.widget-center img{width:100%;max-width:100%;height:auto;display:block}
@media (max-width:640px){.widgets-row{flex-direction:column}.widget-center{width:80%; margin-left: auto; margin-right: auto;}}
</style>



<div class="widgets-row">
    <div class="widget widget-left !hidden md:!flex">
        <x-aktuelles-widget />
    </div>

    <div class="widget widget-center border-4 border-red-700 flex flex-col items-center">
        <img src="{{ Storage::url('images/image.png') }}" alt="Titelfoto">
        {{-- Mobile-only tabbed widget: Einsätze / Aktuelles below the image --}}
        
    </div>
    <div class="md:hidden">
        <x-mobile-widgets-tabbed />
    </div>
    
    <div class="widget widget-right !hidden md:!flex">
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