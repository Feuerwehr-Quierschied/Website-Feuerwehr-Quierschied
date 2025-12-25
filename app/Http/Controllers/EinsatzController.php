<?php

namespace App\Http\Controllers;

use App\Models\Einsatz;

class EinsatzController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $query = Einsatz::query();

        // Filter by month and year if provided
        $year = request()->query('year');
        $month = request()->query('month');

        if ($year && $month) {
            $query->whereYear('timestamp', $year)
                ->whereMonth('timestamp', $month);
        } elseif ($year) {
            $query->whereYear('timestamp', $year);
        }

        $einsaetze = $query->orderBy('timestamp', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('einsaetze.index', [
            'einsaetze' => $einsaetze,
            'selectedYear' => $year,
            'selectedMonth' => $month,
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
