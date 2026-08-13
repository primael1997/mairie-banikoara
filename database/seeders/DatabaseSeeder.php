<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::firstOrNew(['email' => 'admin@admin.com'])
            ->forceFill([
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'isAdmin' => 1,
                'email_verified_at' => now(),
            ])
            ->save();
    }
}
