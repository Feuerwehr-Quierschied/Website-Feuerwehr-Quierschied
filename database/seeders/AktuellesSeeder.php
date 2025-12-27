<?php

namespace Database\Seeders;

use App\Models\Aktuelles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Database\Seeders\EinsatzSeeder;
use Database\Seeders\AktuellesSeeder;

class AktuellesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aktuelles = [
            [
                'title' => 'Neue Ausrüstung für die Feuerwehr Quierschied',
                'description' => 'Die Feuerwehr Quierschied hat neue Atemschutzgeräte erhalten, die die Sicherheit der Einsatzkräfte erheblich verbessern.',
                'body' => '<p>Die Feuerwehr Quierschied freut sich über die Anschaffung neuer Atemschutzgeräte. Diese modernen Geräte bieten verbesserte Sicherheitsstandards und ermöglichen längere Einsatzzeiten unter Atemschutz.</p><p>Die neuen Geräte wurden bereits in den Dienst gestellt und werden bei den nächsten Einsätzen zum Einsatz kommen. Die Kameradinnen und Kameraden wurden entsprechend geschult und sind mit der neuen Ausrüstung vertraut gemacht worden.</p>',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Jahreshauptversammlung 2025',
                'description' => 'Die diesjährige Jahreshauptversammlung der Feuerwehr Quierschied findet am 15. März 2025 statt.',
                'body' => '<p>Alle Mitglieder der Feuerwehr Quierschied sind herzlich zur Jahreshauptversammlung 2025 eingeladen. Die Versammlung findet am 15. März 2025 um 19:00 Uhr im Feuerwehrhaus statt.</p><p>Auf der Tagesordnung stehen unter anderem der Jahresbericht, die Wahl neuer Funktionsträger und die Planung der Aktivitäten für das kommende Jahr. Wir freuen uns auf eine rege Teilnahme.</p>',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Tag der offenen Tür - Ein voller Erfolg',
                'description' => 'Der Tag der offenen Tür am vergangenen Wochenende lockte zahlreiche Besucher an und war ein großer Erfolg.',
                'body' => '<p>Am vergangenen Wochenende öffnete die Feuerwehr Quierschied ihre Tore für die Öffentlichkeit. Zahlreiche Besucher nutzten die Gelegenheit, die Feuerwehrfahrzeuge zu besichtigen, sich über die Arbeit der Feuerwehr zu informieren und bei verschiedenen Vorführungen dabei zu sein.</p><p>Besonders die Vorführung der technischen Rettung und die Möglichkeit, selbst einmal ein Feuerlöscher zu bedienen, stießen auf großes Interesse. Vielen Dank an alle Besucher und Helfer, die zu diesem erfolgreichen Tag beigetragen haben!</p>',
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Neue Mitglieder gesucht',
                'description' => 'Die Feuerwehr Quierschied sucht engagierte neue Mitglieder, die sich für den Brandschutz und die technische Hilfeleistung einsetzen möchten.',
                'body' => '<p>Die Feuerwehr Quierschied sucht neue engagierte Mitglieder. Wenn Sie Interesse haben, sich für den Brandschutz und die technische Hilfeleistung einzusetzen, sind Sie bei uns herzlich willkommen.</p><p>Wir bieten regelmäßige Ausbildungen, interessante Einsätze und eine starke Gemeinschaft. Vorkenntnisse sind nicht erforderlich - wir bilden Sie gerne aus. Interessierte können sich jederzeit bei uns melden oder zu unseren Übungsabenden vorbeikommen.</p>',
                'published_at' => now()->subDays(30),
            ],
        ];

        foreach ($aktuelles as $item) {
            // Generate slug from title
            $item['slug'] = Str::slug($item['title']);

            Aktuelles::create($item);
        }
    }
}
