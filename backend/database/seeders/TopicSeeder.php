<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        $topicsBySubject = [
            'matematika' => [
                1 => [
                    ['name' => 'Bilangan 1-20', 'description' => 'Mengenal dan menghitung angka 1 sampai 20', 'difficulty_level' => 'easy'],
                    ['name' => 'Penjumlahan Dasar', 'description' => 'Menjumlahkan bilangan sederhana', 'difficulty_level' => 'easy'],
                    ['name' => 'Pengurangan Dasar', 'description' => 'Mengurangkan bilangan sederhana', 'difficulty_level' => 'easy'],
                    ['name' => 'Mengenal Bangun Datar', 'description' => 'Mengenal bentuk lingkaran, segitiga, persegi', 'difficulty_level' => 'easy'],
                ],
                2 => [
                    ['name' => 'Bilangan 1-100', 'description' => 'Mengenal bilangan sampai 100', 'difficulty_level' => 'easy'],
                    ['name' => 'Penjumlahan & Pengurangan', 'description' => 'Operasi hitung bilangan dua angka', 'difficulty_level' => 'medium'],
                    ['name' => 'Perkalian Dasar', 'description' => 'Konsep perkalian sebagai penjumlahan berulang', 'difficulty_level' => 'medium'],
                    ['name' => 'Pengukuran Sederhana', 'description' => 'Mengukur panjang dan berat', 'difficulty_level' => 'easy'],
                ],
                3 => [
                    ['name' => 'Bilangan 1-1000', 'description' => 'Mengenal bilangan sampai 1000', 'difficulty_level' => 'easy'],
                    ['name' => 'Perkalian & Pembagian', 'description' => 'Operasi perkalian dan pembagian', 'difficulty_level' => 'medium'],
                    ['name' => 'Pecahan Sederhana', 'description' => 'Mengenal pecahan ½, ⅓, ¼', 'difficulty_level' => 'medium'],
                    ['name' => 'Bangun Datar', 'description' => 'Keliling dan luas bangun datar sederhana', 'difficulty_level' => 'medium'],
                ],
                4 => [
                    ['name' => 'Bilangan Besar', 'description' => 'Operasi hitung bilangan ribuan', 'difficulty_level' => 'medium'],
                    ['name' => 'KPK dan FPB', 'description' => 'Kelipatan persekutuan dan faktor persekutuan', 'difficulty_level' => 'hard'],
                    ['name' => 'Pecahan', 'description' => 'Operasi hitung pecahan', 'difficulty_level' => 'medium'],
                    ['name' => 'Bangun Ruang', 'description' => 'Mengenal kubus, balok, dan tabung', 'difficulty_level' => 'medium'],
                ],
                5 => [
                    ['name' => 'Operasi Bilangan Bulat', 'description' => 'Bilangan positif dan negatif', 'difficulty_level' => 'medium'],
                    ['name' => 'Pecahan & Desimal', 'description' => 'Hubungan pecahan, desimal, dan persen', 'difficulty_level' => 'hard'],
                    ['name' => 'Volume Bangun Ruang', 'description' => 'Menghitung volume kubus dan balok', 'difficulty_level' => 'hard'],
                    ['name' => 'Statistika Dasar', 'description' => 'Rata-rata, modus, dan median', 'difficulty_level' => 'medium'],
                ],
                6 => [
                    ['name' => 'Bilangan Bulat & Pecahan', 'description' => 'Operasi campuran bilangan', 'difficulty_level' => 'hard'],
                    ['name' => 'Geometri', 'description' => 'Luas dan keliling bangun gabungan', 'difficulty_level' => 'hard'],
                    ['name' => 'Pengolahan Data', 'description' => 'Diagram, tabel, dan grafik', 'difficulty_level' => 'medium'],
                    ['name' => 'Debit', 'description' => 'Menghitung debit air', 'difficulty_level' => 'hard'],
                ],
            ],
            'bahasa-indonesia' => [
                1 => [
                    ['name' => 'Mengenal Huruf', 'description' => 'Mengenal huruf alfabet A-Z', 'difficulty_level' => 'easy'],
                    ['name' => 'Membaca Suku Kata', 'description' => 'Membaca suku kata sederhana', 'difficulty_level' => 'easy'],
                    ['name' => 'Menulis Huruf', 'description' => 'Menulis huruf dengan benar', 'difficulty_level' => 'easy'],
                ],
                2 => [
                    ['name' => 'Membaca Cerita Pendek', 'description' => 'Membaca dan memahami cerita sederhana', 'difficulty_level' => 'easy'],
                    ['name' => 'Menulis Kalimat', 'description' => 'Menyusun kalimat sederhana', 'difficulty_level' => 'medium'],
                    ['name' => 'Kosakata Baru', 'description' => 'Menambah perbendaharaan kata', 'difficulty_level' => 'easy'],
                ],
                3 => [
                    ['name' => 'Paragraf', 'description' => 'Memahami dan menyusun paragraf', 'difficulty_level' => 'medium'],
                    ['name' => 'Dongeng & Cerita', 'description' => 'Memahami dan menceritakan kembali dongeng', 'difficulty_level' => 'medium'],
                    ['name' => 'Puisi Anak', 'description' => 'Mengenal dan membuat puisi sederhana', 'difficulty_level' => 'easy'],
                ],
                4 => [
                    ['name' => 'Karangan', 'description' => 'Menulis karangan narasi dan deskripsi', 'difficulty_level' => 'medium'],
                    ['name' => 'Surat Pribadi', 'description' => 'Menulis surat untuk teman', 'difficulty_level' => 'easy'],
                    ['name' => 'Teks Laporan', 'description' => 'Membaca dan menulis teks laporan', 'difficulty_level' => 'medium'],
                ],
                5 => [
                    ['name' => 'Teks Narasi', 'description' => 'Menulis cerita pengalaman pribadi', 'difficulty_level' => 'medium'],
                    ['name' => 'Drama', 'description' => 'Mengenal dan memahami teks drama', 'difficulty_level' => 'medium'],
                    ['name' => 'Pantun & Syair', 'description' => 'Memahami dan membuat pantun', 'difficulty_level' => 'hard'],
                ],
                6 => [
                    ['name' => 'Teks Persuasi', 'description' => 'Menulis teks ajakan dan persuasi', 'difficulty_level' => 'hard'],
                    ['name' => 'Pidato', 'description' => 'Menyusun dan menyampaikan pidato', 'difficulty_level' => 'hard'],
                    ['name' => 'Ringkasan', 'description' => 'Meringkas dan menyimpulkan bacaan', 'difficulty_level' => 'medium'],
                ],
            ],
            'ipa' => [
                1 => [
                    ['name' => 'Tubuh Manusia', 'description' => 'Mengenal anggota tubuh manusia', 'difficulty_level' => 'easy'],
                    ['name' => 'Hewan di Sekitar', 'description' => 'Mengenal jenis-jenis hewan', 'difficulty_level' => 'easy'],
                    ['name' => 'Tumbuhan di Sekitar', 'description' => 'Mengenal bagian tumbuhan', 'difficulty_level' => 'easy'],
                ],
                2 => [
                    ['name' => 'Sumber Energi', 'description' => 'Mengenal sumber energi di kehidupan sehari-hari', 'difficulty_level' => 'easy'],
                    ['name' => 'Perubahan Cuaca', 'description' => 'Mengenal cuaca dan perubahannya', 'difficulty_level' => 'easy'],
                    ['name' => 'Benda & Sifatnya', 'description' => 'Mengenal sifat benda padat, cair, gas', 'difficulty_level' => 'medium'],
                ],
                3 => [
                    ['name' => 'Makhluk Hidup', 'description' => 'Ciri-ciri dan kebutuhan makhluk hidup', 'difficulty_level' => 'medium'],
                    ['name' => 'Lingkungan Sehat', 'description' => 'Menjaga lingkungan dan kesehatan', 'difficulty_level' => 'easy'],
                    ['name' => 'Gerak & Gaya', 'description' => 'Mengenal konsep gerak dan gaya', 'difficulty_level' => 'medium'],
                ],
                4 => [
                    ['name' => 'Rangka Manusia', 'description' => 'Mengenal rangka dan fungsinya', 'difficulty_level' => 'medium'],
                    ['name' => 'Daur Hidup Hewan', 'description' => 'Metamorfosis dan daur hidup', 'difficulty_level' => 'medium'],
                    ['name' => 'Gaya & Gerak', 'description' => 'Pengaruh gaya terhadap gerak benda', 'difficulty_level' => 'medium'],
                ],
                5 => [
                    ['name' => 'Organ Tubuh', 'description' => 'Sistem organ pencernaan dan pernapasan', 'difficulty_level' => 'hard'],
                    ['name' => 'Ekosistem', 'description' => 'Rantai makanan dan ekosistem', 'difficulty_level' => 'medium'],
                    ['name' => 'Cahaya & Sifatnya', 'description' => 'Sifat-sifat cahaya dan pemanfaatannya', 'difficulty_level' => 'medium'],
                ],
                6 => [
                    ['name' => 'Tata Surya', 'description' => 'Planet dan benda langit', 'difficulty_level' => 'medium'],
                    ['name' => 'Campuran & Larutan', 'description' => 'Perbedaan campuran dan larutan', 'difficulty_level' => 'hard'],
                    ['name' => 'Listrik & Magnet', 'description' => 'Rangkaian listrik sederhana', 'difficulty_level' => 'hard'],
                ],
            ],
            'ips' => [
                1 => [
                    ['name' => 'Keluargaku', 'description' => 'Mengenal anggota keluarga dan perannya', 'difficulty_level' => 'easy'],
                    ['name' => 'Lingkungan Rumah', 'description' => 'Mengenal lingkungan tempat tinggal', 'difficulty_level' => 'easy'],
                ],
                2 => [
                    ['name' => 'Lingkungan Sekolah', 'description' => 'Mengenal lingkungan sekolah', 'difficulty_level' => 'easy'],
                    ['name' => 'Dokumen Pribadi', 'description' => 'Mengenal dokumen diri dan keluarga', 'difficulty_level' => 'easy'],
                ],
                3 => [
                    ['name' => 'Denah & Peta', 'description' => 'Membaca denah dan peta sederhana', 'difficulty_level' => 'medium'],
                    ['name' => 'Kerjasama', 'description' => 'Bentuk kerjasama di lingkungan', 'difficulty_level' => 'easy'],
                ],
                4 => [
                    ['name' => 'Sumber Daya Alam', 'description' => 'Mengenal SDA dan pemanfaatannya', 'difficulty_level' => 'medium'],
                    ['name' => 'Keragaman Budaya', 'description' => 'Mengenal keragaman budaya Indonesia', 'difficulty_level' => 'medium'],
                ],
                5 => [
                    ['name' => 'Kerajaan Hindu-Buddha', 'description' => 'Sejarah kerajaan Hindu-Buddha di Indonesia', 'difficulty_level' => 'medium'],
                    ['name' => 'Kerajaan Islam', 'description' => 'Sejarah kerajaan Islam di Indonesia', 'difficulty_level' => 'medium'],
                ],
                6 => [
                    ['name' => 'Globalisasi', 'description' => 'Dampak globalisasi di Indonesia', 'difficulty_level' => 'hard'],
                    ['name' => 'ASEAN', 'description' => 'Mengenal negara-negara ASEAN', 'difficulty_level' => 'medium'],
                ],
            ],
            'pkn' => [
                1 => [
                    ['name' => 'Aturan di Rumah', 'description' => 'Mengenal aturan di lingkungan rumah', 'difficulty_level' => 'easy'],
                    ['name' => 'Hidup Rukun', 'description' => 'Pentingnya hidup rukun', 'difficulty_level' => 'easy'],
                ],
                3 => [
                    ['name' => 'Sila Pancasila', 'description' => 'Memahami nilai-nilai Pancasila', 'difficulty_level' => 'medium'],
                    ['name' => 'Hak & Kewajiban', 'description' => 'Hak dan kewajiban anak di rumah dan sekolah', 'difficulty_level' => 'medium'],
                ],
                5 => [
                    ['name' => 'NKRI', 'description' => 'Menjaga keutuhan NKRI', 'difficulty_level' => 'medium'],
                    ['name' => 'Musyawarah', 'description' => 'Nilai musyawarah dalam kehidupan', 'difficulty_level' => 'medium'],
                ],
            ],
            'bahasa-inggris' => [
                1 => [
                    ['name' => 'Greetings', 'description' => 'Hello, goodbye, thank you', 'difficulty_level' => 'easy'],
                    ['name' => 'Numbers 1-10', 'description' => 'Counting from one to ten', 'difficulty_level' => 'easy'],
                    ['name' => 'Colors', 'description' => 'Learning basic colors in English', 'difficulty_level' => 'easy'],
                ],
                2 => [
                    ['name' => 'Animals', 'description' => 'Names of common animals', 'difficulty_level' => 'easy'],
                    ['name' => 'My Body', 'description' => 'Parts of the body in English', 'difficulty_level' => 'easy'],
                    ['name' => 'Family Members', 'description' => 'Father, mother, brother, sister', 'difficulty_level' => 'easy'],
                ],
                3 => [
                    ['name' => 'Days & Months', 'description' => 'Days of the week and months', 'difficulty_level' => 'medium'],
                    ['name' => 'Food & Drinks', 'description' => 'Common food and drink vocabulary', 'difficulty_level' => 'easy'],
                ],
                4 => [
                    ['name' => 'Simple Sentences', 'description' => 'Making simple English sentences', 'difficulty_level' => 'medium'],
                    ['name' => 'Telling Time', 'description' => 'How to tell time in English', 'difficulty_level' => 'medium'],
                ],
                5 => [
                    ['name' => 'Daily Activities', 'description' => 'Describing daily routines', 'difficulty_level' => 'medium'],
                    ['name' => 'Simple Present Tense', 'description' => 'Using simple present tense', 'difficulty_level' => 'hard'],
                ],
                6 => [
                    ['name' => 'Simple Past Tense', 'description' => 'Telling stories in the past', 'difficulty_level' => 'hard'],
                    ['name' => 'Reading Comprehension', 'description' => 'Understanding short English texts', 'difficulty_level' => 'hard'],
                ],
            ],
        ];

        foreach ($topicsBySubject as $subjectSlug => $grades) {
            $subject = Subject::where('slug', $subjectSlug)->first();

            if (!$subject) {
                continue;
            }

            foreach ($grades as $gradeLevel => $topics) {
                foreach ($topics as $index => $topicData) {
                    Topic::updateOrCreate(
                        [
                            'subject_id' => $subject->id,
                            'slug' => Str::slug($topicData['name']),
                            'grade_level' => $gradeLevel,
                        ],
                        [
                            'name' => $topicData['name'],
                            'description' => $topicData['description'],
                            'difficulty_level' => $topicData['difficulty_level'],
                            'order_index' => $index + 1,
                            'is_active' => true,
                        ]
                    );
                }
            }
        }
    }
}
