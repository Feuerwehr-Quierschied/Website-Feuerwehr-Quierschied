<?php

namespace Database\Seeders;

use App\Models\Einsatz;
use Illuminate\Database\Seeder;

class EinsatzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $einsaetze = [
            [
                'title' => 'Einsatz 104/2025 - Technische Hilfeleistung - Baum auf Straße',
                'slug' => 'einsatz-104-2025-technische-hilfeleistung-baum-auf-strasse',
                'description' => 'Am Heiligabend stürzte aufgrund von Sturmböen ein Baum auf die L266 im Ortsteil Göttelborn und blockierte die Fahrbahn.',
                'body' => '<p>Am heutigen Heiligabend stürzte aufgrund von Sturmböen ein Baum auf die Straße und blockierte die Fahrbahn. Die Feuerwehr zerkleinerte den umgestürzten Baum mit einer Kettensäge und entfernte ihn von der Straße.</p><p>Etwa zwei Stunden später stürzte ein weiterer Baum um und verfing sich in umliegenden Ästen. Der Baum hing im Seitenstreifen beziehungsweise im Bereich der Fahrbahnbegrenzung. Aufgrund der anhaltend hohen Windgeschwindigkeit und der Tatsache, dass keine akute Gefahr bestand, wurden keine weiteren Maßnahmen durch die Feuerwehr ergriffen.</p><p>Aufgrund weiterer Meldungen über umgestürzte Bäume kontrollierten die Einsatzkräfte die L266 in ihrem Verlauf bis zum Ortseingang Wahlschied; es konnten jedoch keine weiteren umgestürzten Bäume festgestellt werden.</p><p>Nach Abschluss der Maßnahmen konnten die Kameradinnen und Kameraden wieder einrücken und zu ihren Familien zurückkehren, um den Heiligabend im Kreise ihrer Angehörigen zu verbringen.</p><p><strong>Im Einsatz waren:</strong></p><ul><li>stellvertretender Wehrführer Feuerwehr Quierschied</li><li>Löschbezirk Quierschied</li></ul>',
                'timestamp' => '2025-12-24 21:28:00',
            ],
            [
                'title' => 'Einsatz 103/2025 - Technische Hilfeleistung - Baum auf Straße',
                'slug' => 'einsatz-103-2025-technische-hilfeleistung-baum-auf-strasse',
                'description' => 'Am Heiligabend stürzte aufgrund von Sturmböen ein Baum auf die Holzer Straße / L262 im Ortsteil Quierschied und blockierte die Fahrbahn.',
                'body' => '<p>Am heutigen Heiligabend stürzte aufgrund von Sturmböen ein Baum auf die Straße und blockierte die Fahrbahn. Die Feuerwehr zerkleinerte den umgestürzten Baum mit einer Kettensäge und entfernte ihn von der Straße. Anschließend wurde die Einsatzstelle an die Polizei übergeben.</p><p><strong>Im Einsatz waren:</strong></p><ul><li>stellvertretender Wehrführer Feuerwehr Quierschied</li><li>Löschbezirk Quierschied</li><li>Polizei</li></ul>',
                'timestamp' => '2025-12-24 19:44:00',
            ],
        ];

        foreach ($einsaetze as $einsatz) {
            Einsatz::create($einsatz);
        }
    }
}
