<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Kontaktformular Empfänger
    |--------------------------------------------------------------------------
    |
    | E-Mail-Adressen für die verschiedenen Ansprechpartner des Kontaktformulars.
    | Diese werden in der .env konfiguriert.
    |
    */

    'recipients' => [
        'wehrfuehrer' => [
            'label' => 'Wehrführer',
            'email' => env('CONTACT_WEHRFUEHRER_EMAIL', env('MAIL_FROM_ADDRESS', 'hello@example.com')),
        ],
        'loeschbezirksfuehrer_quierschied' => [
            'label' => 'Löschbezirksführer Quierschied',
            'email' => env('CONTACT_LOESCHBEZIRKSFUEHRER_QUIERSCHIED_EMAIL', env('MAIL_FROM_ADDRESS', 'hello@example.com')),
        ],
        'loeschbezirksfuehrer_fischbach' => [
            'label' => 'Löschbezirksführer Fischbach',
            'email' => env('CONTACT_LOESCHBEZIRKSFUEHRER_FISCHBACH_EMAIL', env('MAIL_FROM_ADDRESS', 'hello@example.com')),
        ],
        'gemeindejugendwart' => [
            'label' => 'Gemeindejugendwart',
            'email' => env('CONTACT_GEMEINDEJUGENDWART_EMAIL', env('MAIL_FROM_ADDRESS', 'hello@example.com')),
        ],
    ],

];
