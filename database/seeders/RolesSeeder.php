<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web']
        );
        $adminRole->syncPermissions(Permission::all());

        $moderatorRole = Role::firstOrCreate(
            ['name' => 'moderator', 'guard_name' => 'web']
        );
        $moderatorRole->syncPermissions(
            Permission::whereIn('name', [
                'ViewAny:Aktuelles',
                'View:Aktuelles',
                'ViewAny:Einsatz',
                'View:Einsatz',
                'ViewAny:Role',
                'View:Role',
                'View:ManageWelcomeIntro',
            ])->get()
        );
    }
}
