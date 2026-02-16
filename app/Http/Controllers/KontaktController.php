<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKontaktRequest;
use App\Mail\KontaktMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class KontaktController extends Controller
{
    /**
     * Show the contact form.
     */
    public function index(): View
    {
        return view('kontakt.index', [
            'recipients' => config('contact.recipients'),
        ]);
    }

    /**
     * Store the contact form submission and send email.
     */
    public function store(StoreKontaktRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $recipientConfig = config('contact.recipients')[$validated['empfaenger']];

        $data = [
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'],
            'telefon' => $validated['telefon'] ?? null,
            'nachricht' => $validated['nachricht'],
            'empfaenger_label' => $recipientConfig['label'],
        ];

        Mail::to($recipientConfig['email'])
            ->send(new KontaktMail($data));

        return redirect()
            ->route('kontakt.index')
            ->with('success', 'Ihre Nachricht wurde erfolgreich gesendet. Wir melden uns in Kürze bei Ihnen.');
    }
}
