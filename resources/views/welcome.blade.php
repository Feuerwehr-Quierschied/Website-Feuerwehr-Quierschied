<x-layout>
<h1>Willkommen</h1>

<style>
.widgets-row{display:flex;align-items:center;justify-content:center;gap:1rem;margin:1.5rem 0;}
.widget{flex:1;min-width:0}
.widget-center{flex:2;display:flex;justify-content:center}
.widget-center img{width:100%;max-width:100%;height:auto;display:block}
@media (max-width:640px){.widgets-row{flex-direction:column}.widget-center{width:80%}}
</style>

<div class="widgets-row">
    <div class="widget widget-left">
        {{-- Left widget placeholder --}}
    </div>

    <div class="widget widget-center border-4 border-red-700">
        <img src="{{ Storage::url('images/image.png') }}" alt="Description">
    </div>

    <div class="widget widget-right">
        {{-- Right widget placeholder --}}
    </div>
</div>

</x-layout>