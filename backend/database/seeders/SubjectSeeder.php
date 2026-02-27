<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Matematika',
                'slug' => 'matematika',
                'description' => 'Belajar berhitung, geometri, dan logika matematika dengan cara yang menyenangkan!',
                'icon' => '🔢',
                'order_index' => 1,
            ],
            [
                'name' => 'Bahasa Indonesia',
                'slug' => 'bahasa-indonesia',
                'description' => 'Membaca, menulis, dan berbahasa Indonesia dengan baik dan benar.',
                'icon' => '📖',
                'order_index' => 2,
            ],
            [
                'name' => 'Ilmu Pengetahuan Alam',
                'slug' => 'ipa',
                'description' => 'Menjelajahi alam semesta dan fenomena sains di sekitar kita!',
                'icon' => '🔬',
                'order_index' => 3,
            ],
            [
                'name' => 'Ilmu Pengetahuan Sosial',
                'slug' => 'ips',
                'description' => 'Mengenal masyarakat, budaya, dan sejarah Indonesia.',
                'icon' => '🌍',
                'order_index' => 4,
            ],
            [
                'name' => 'Pendidikan Kewarganegaraan',
                'slug' => 'pkn',
                'description' => 'Belajar tentang Pancasila, hak dan kewajiban warga negara.',
                'icon' => '🇮🇩',
                'order_index' => 5,
            ],
            [
                'name' => 'Bahasa Inggris',
                'slug' => 'bahasa-inggris',
                'description' => 'Let\'s learn English! Belajar bahasa Inggris dengan seru.',
                'icon' => '🌐',
                'order_index' => 6,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(
                ['slug' => $subject['slug']],
                $subject
            );
        }
    }
}
