<?php

namespace App\Http\Controllers;

use App\Models\Aktuelles;

class AktuellesController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $aktuelles = Aktuelles::query()
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('aktuelles.index', [
            'aktuelles' => $aktuelles,
        ]);
    }

    public function show(string $slug): \Illuminate\Contracts\View\View
    {
        $aktuelles = Aktuelles::where('slug', $slug)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        return view('aktuelles.show', [
            'aktuelles' => $aktuelles,
        ]);
    }
}
