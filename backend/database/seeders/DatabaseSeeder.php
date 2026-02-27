<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user (skip if exists)
        if (!User::where('email', 'admin@edubridge.ai')->exists()) {
            User::create([
                'name' => 'Admin EduBridge',
                'email' => 'admin@edubridge.ai',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // Create test parent user (skip if exists)
        if (!User::where('email', 'parent@edubridge.ai')->exists()) {
            User::create([
                'name' => 'Orang Tua Test',
                'email' => 'parent@edubridge.ai',
                'password' => Hash::make('password'),
                'role' => 'parent',
            ]);
        }

        // Seed subjects and topics
        $this->call([
            SubjectSeeder::class,
            TopicSeeder::class,
        ]);
    }
}
