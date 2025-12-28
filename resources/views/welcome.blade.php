<x-layout>

<style>
.widgets-row{display:flex;align-items:stretch;justify-content:center;gap:1rem;margin:1.5rem 0;}
.widget{flex:1;min-width:0;display:flex}
.widget-center{flex:2;display:flex;justify-content:center;align-items:center}
.widget-center img{width:100%;max-width:100%;height:auto;display:block}
@media (max-width:640px){.widgets-row{flex-direction:column}.widget-center{width:80%; margin-left: auto; margin-right: auto;}}
</style>

<div class="widgets-row">
    <div class="widget widget-left hidden">
        <x-aktuelles-widget />
    </div>

    <div class="widget widget-center border-4 border-red-700">
        <img src="{{ Storage::url('images/image.png') }}" alt="Titelfoto">
    </div>

    <div class="widget widget-right hidden md:block">
        <x-einsaetze-widget />
    </div>
</div>

</x-layout>