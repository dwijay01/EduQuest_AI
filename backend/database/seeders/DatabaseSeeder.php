<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin EduBridge',
            'email' => 'admin@edubridge.ai',
            'role' => 'admin',
        ]);

        // Create test parent user
        User::factory()->create([
            'name' => 'Orang Tua Test',
            'email' => 'parent@edubridge.ai',
            'role' => 'parent',
        ]);

        // Seed subjects and topics
        $this->call([
            SubjectSeeder::class,
            TopicSeeder::class,
        ]);
    }
}
