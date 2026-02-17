<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Theme
    |--------------------------------------------------------------------------
    |
    | Define the admin panel colors here. This is the single source of truth
    | for the /admin theme. The theme.css file uses these via the panel.
    |
    | Primary: #FB2C36 (fire-red) matches the frontpage.
    | Use a hex string and Filament will generate the full palette.
    |
    */

    'admin' => [
        'colors' => [
            'primary' => '#FB2C36',
            'gray' => '#272a2e',   // your background-dark
            'danger' => '#FB2C36',   // same accent
            'success' => '#FB2C36',   // or a lighter shade
            'warning' => '#FB2C36',
            'info' => '#FB2C36',
        ],
        'font' => 'Instrument Sans',
    ],

];
