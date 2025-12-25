<?php

namespace Database\Seeders;

use App\Models\Einsatz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EinsatzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $einsaetze = [
            [
                'title' => 'Technische Hilfeleistung - Baum auf Straße',
                'einsatznummer' => '104/2025',
                'description' => 'Am Heiligabend stürzte aufgrund von Sturmböen ein Baum auf die L266 im Ortsteil Göttelborn und blockierte die Fahrbahn.',
                'body' => '<p>Am heutigen Heiligabend stürzte aufgrund von Sturmböen ein Baum auf die Straße und blockierte die Fahrbahn. Die Feuerwehr zerkleinerte den umgestürzten Baum mit einer Kettensäge und entfernte ihn von der Straße.</p><p>Etwa zwei Stunden später stürzte ein weiterer Baum um und verfing sich in umliegenden Ästen. Der Baum hing im Seitenstreifen beziehungsweise im Bereich der Fahrbahnbegrenzung. Aufgrund der anhaltend hohen Windgeschwindigkeit und der Tatsache, dass keine akute Gefahr bestand, wurden keine weiteren Maßnahmen durch die Feuerwehr ergriffen.</p><p>Aufgrund weiterer Meldungen über umgestürzte Bäume kontrollierten die Einsatzkräfte die L266 in ihrem Verlauf bis zum Ortseingang Wahlschied; es konnten jedoch keine weiteren umgestürzten Bäume festgestellt werden.</p><p>Nach Abschluss der Maßnahmen konnten die Kameradinnen und Kameraden wieder einrücken und zu ihren Familien zurückkehren, um den Heiligabend im Kreise ihrer Angehörigen zu verbringen.</p>',
                'timestamp' => '2025-12-24 21:28:00',
                'im_einsatz_waren' => [
                    'stellvertretender Wehrführer Feuerwehr Quierschied',
                    'Löschbezirk Quierschied',
                ],
            ],
            [
                'title' => 'Technische Hilfeleistung - Baum auf Straße',
                'einsatznummer' => '103/2025',
                'description' => 'Am Heiligabend stürzte aufgrund von Sturmböen ein Baum auf die Holzer Straße / L262 im Ortsteil Quierschied und blockierte die Fahrbahn.',
                'body' => '<p>Am heutigen Heiligabend stürzte aufgrund von Sturmböen ein Baum auf die Straße und blockierte die Fahrbahn. Die Feuerwehr zerkleinerte den umgestürzten Baum mit einer Kettensäge und entfernte ihn von der Straße. Anschließend wurde die Einsatzstelle an die Polizei übergeben.</p>',
                'timestamp' => '2025-12-24 19:44:00',
                'im_einsatz_waren' => [
                    'stellvertretender Wehrführer Feuerwehr Quierschied',
                    'Löschbezirk Quierschied',
                    'Polizei',
                ],
            ],
            [
                'title' => 'ABC Messen - Austritt Flüssigsauerstoff aus Tank',
                'einsatznummer' => '102/2025',
                'description' => 'Hausbewohner alarmierten die Feuerwehr, da an einem Flüssigsauerstofftank Sauerstoff fontänenartig ausströmte.',
                'body' => '<p>Hausbewohner alarmierten die Feuerwehr, da an einem Flüssigsauerstofftank Sauerstoff fontänenartig ausströmte.</p><p>Durch die Feuerwehr wurde ein Servicetechniker des Sauerstoffversorgers kontaktiert.</p><p>Eine Gefahr für die Bewohner bestand nicht.</p><p>Ein weiteres Handeln der Feuerwehr war nicht erforderlich.</p><p>Die Einsatzstelle wurde an die Bewohner übergeben.</p>',
                'timestamp' => '2025-12-24 16:55:00',
                'im_einsatz_waren' => [
                    'stellvertretender Wehrführer Feuerwehr Quierschied',
                    'Löschbezirk Quierschied',
                ],
            ],
            [
                'title' => 'Brand 1 - brennt Mülleimer',
                'einsatznummer' => '101/2025',
                'description' => 'Anwohner alarmierten die Feuerwehr, da ein Mülleimer vor einer Gaststätte brannte.',
                'body' => '<p>Anwohner alarmierten die Feuerwehr, da ein Mülleimer vor einer Gaststätte brannte.</p><p>Beim Eintreffen der Feuerwehr war der Brand bereits durch die ersteintreffende Polizei weitestgehend gelöscht worden.</p><p>Die Feuerwehr führte lediglich Nachlöscharbeiten durch.</p><p>Weitere Maßnahmen waren nicht erforderlich.</p>',
                'timestamp' => '2025-12-23 07:14:00',
                'im_einsatz_waren' => [
                    'stellvertretender Wehrführer Feuerwehr Quierschied',
                    'Löschbezirk Fischbach',
                    'Löschbezirk Quierschied',
                    'Polizei',
                ],
            ],
        ];

        foreach ($einsaetze as $einsatz) {
            // Generate slug automatically using the same logic as the form
            $einsatz['slug'] = $this->generateSlug($einsatz['einsatznummer'], $einsatz['title']);

            Einsatz::create($einsatz);
        }
    }

    /**
     * Generate slug from einsatznummer and title.
     * Format: {part1-einsatznummer}-{part2-einsatznummer}-{title-slug}
     */
    private function generateSlug(string $einsatznummer, string $title): string
    {
        // Split einsatznummer by "/" (e.g., "123/2025" -> ["123", "2025"])
        $parts = explode('/', $einsatznummer, 2);
        $part1 = trim($parts[0] ?? '');
        $part2 = trim($parts[1] ?? '');

        // Generate slug from title
        $titleSlug = Str::slug($title);

        // Combine: {part1}-{part2}-{title-slug}
        return "{$part1}-{$part2}-{$titleSlug}";
    }
}
