<?php

use App\Mail\KontaktMail;
use Illuminate\Support\Facades\Mail;

test('kontakt page is accessible', function () {
    $response = $this->get(route('kontakt.index'));

    $response->assertSuccessful();
    $response->assertSee('Kontakt');
    $response->assertSee('Wehrführer');
    $response->assertSee('Löschbezirksführer Quierschied');
    $response->assertSee('Löschbezirksführer Fischbach');
});

test('contact form sends email on valid submission', function () {
    Mail::fake();

    $response = $this->post(route('kontakt.store'), [
        'email' => 'test@example.com',
        'empfaenger' => 'wehrfuehrer',
        'nachricht' => 'Testnachricht',
    ]);

    $response->assertRedirect(route('kontakt.index'));
    $response->assertSessionHas('success');

    Mail::assertSent(KontaktMail::class, function (KontaktMail $mail) {
        return $mail->data['email'] === 'test@example.com'
            && $mail->data['nachricht'] === 'Testnachricht'
            && $mail->data['empfaenger_label'] === 'Wehrführer';
    });
});

test('contact form accepts optional name and telefon', function () {
    Mail::fake();

    $this->post(route('kontakt.store'), [
        'name' => 'Max Mustermann',
        'email' => 'max@example.com',
        'telefon' => '06897 12345',
        'empfaenger' => 'loeschbezirksfuehrer_quierschied',
        'nachricht' => 'Meine Nachricht',
    ]);

    Mail::assertSent(KontaktMail::class, function (KontaktMail $mail) {
        return $mail->data['name'] === 'Max Mustermann'
            && $mail->data['telefon'] === '06897 12345'
            && $mail->data['empfaenger_label'] === 'Löschbezirksführer Quierschied';
    });
});

test('contact form requires email', function () {
    $response = $this->post(route('kontakt.store'), [
        'empfaenger' => 'wehrfuehrer',
        'nachricht' => 'Testnachricht',
    ]);

    $response->assertSessionHasErrors('email');
});

test('contact form requires valid email', function () {
    $response = $this->post(route('kontakt.store'), [
        'email' => 'invalid-email',
        'empfaenger' => 'wehrfuehrer',
        'nachricht' => 'Testnachricht',
    ]);

    $response->assertSessionHasErrors('email');
});

test('contact form requires nachricht', function () {
    $response = $this->post(route('kontakt.store'), [
        'email' => 'test@example.com',
        'empfaenger' => 'wehrfuehrer',
    ]);

    $response->assertSessionHasErrors('nachricht');
});

test('contact form requires valid empfaenger', function () {
    $response = $this->post(route('kontakt.store'), [
        'email' => 'test@example.com',
        'empfaenger' => 'invalid_empfaenger',
        'nachricht' => 'Testnachricht',
    ]);

    $response->assertSessionHasErrors('empfaenger');
});
