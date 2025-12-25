<?php

namespace App\Http\Controllers;

use App\Models\Einsatz;

class EinsatzController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $einsaetze = Einsatz::query()
            ->orderBy('timestamp', 'desc')
            ->paginate(10);

        return view('einsaetze.index', [
            'einsaetze' => $einsaetze,
        ]);
    }

    public function show(string $slug): \Illuminate\Contracts\View\View
    {
        $einsatz = Einsatz::where('slug', $slug)->firstOrFail();

        return view('einsaetze.show', [
            'einsatz' => $einsatz,
        ]);
    }
}
