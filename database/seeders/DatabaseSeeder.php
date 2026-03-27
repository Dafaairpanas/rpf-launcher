<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            TagSeeder::class,
        ]);

        // Get superadmin role
        $superAdminRole = Role::where('name', 'Super Admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@rpf.com'],
            [
                'name' => 'Admin RPF',
                'password' => bcrypt('password'),
                'role_id' => $superAdminRole?->id,
            ]
        );

        $this->call([
            ApplicationSeeder::class,
        ]);
    }
}

