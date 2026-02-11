<?php

namespace Database\Seeders;

use App\Models\WelcomeIntro;
use Illuminate\Database\Seeder;

class WelcomeIntroSeeder extends Seeder
{
    public function run(): void
    {
        if (WelcomeIntro::query()->exists()) {
            return;
        }

        WelcomeIntro::query()->create([
            'title' => 'Willkommen bei der Freiwilligen Feuerwehr Quierschied',
            'body' => 'Wir sind rund um die Uhr für Ihre Sicherheit im Einsatz. Unsere ehrenamtlichen Einsatzkräfte stehen bereit, um bei Bränden, Unfällen und technischen Notlagen schnelle Hilfe zu leisten. Auf unserer Webseite finden Sie aktuelle Informationen zu unseren Einsätzen, Einblicke in unsere Technik und nützliche Tipps für Ihre Sicherheit zu Hause.',
        ]);
    }
}
