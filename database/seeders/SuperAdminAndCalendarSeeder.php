<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminAndCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'super_admin', 'guard_name' => 'web']
        );
        $superAdminRole->syncPermissions(Permission::all());

        $user = User::updateOrCreate(
            ['email' => 'tom@tom.tom'],
            [
                'name' => 'Tom',
                'password' => Hash::make('tom'),
                'email_verified_at' => now(),
            ]
        );
        $user->syncRoles([$superAdminRole]);

        $februaryEvents = [
            [
                'title' => 'Übung Löschangriff',
                'start' => '2026-02-05 19:00:00',
                'end' => '2026-02-05 21:00:00',
                'description' => 'Regelmäßige Übung zum Löschangriff',
                'all_day' => false,
                'color' => '#FB2C36',
            ],
            [
                'title' => 'Geräteprüfung',
                'start' => '2026-02-15 09:00:00',
                'end' => '2026-02-15 12:00:00',
                'description' => 'Jährliche Prüfung der Feuerlöscher und Geräte',
                'all_day' => false,
                'color' => '#3B82F6',
            ],
            [
                'title' => 'Jahreshauptversammlung',
                'start' => '2026-02-22 19:30:00',
                'end' => '2026-02-22 22:00:00',
                'description' => 'Jährliche Hauptversammlung der Feuerwehr',
                'all_day' => false,
                'color' => '#10B981',
            ],
        ];

        foreach ($februaryEvents as $eventData) {
            Event::firstOrCreate(
                [
                    'title' => $eventData['title'],
                    'start' => $eventData['start'],
                ],
                $eventData
            );
        }
    }
}
