<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@arima.test'],
            [
                'name' => 'ARIMA Admin',
                'password' => Hash::make('password'),
                'address' => 'Surabaya',
                'phone_number' => '+62 811-3000-655',
            ],
        );

        DB::table('information')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'ARIMA Indonesia',
                'slogan' => 'Green pest control sejak 1998',
                'description' => 'ARIMA Indonesia menyediakan pest management, disinfection, fumigation, termite baiting, dan cleaning service.',
                'description_eng' => 'ARIMA Indonesia provides pest management, disinfection, fumigation, termite baiting, and cleaning services.',
                'address' => 'Jl. Raya Wiyung Indah No.7 Surabaya 60228',
                'email' => 'info@arimaindonesia.com',
                'phone_1' => '+62 31 766 1422',
                'phone_2' => '+62 31 766 4086',
                'phone_sms' => '+62 811-3000-655',
                'phone_wa' => '628113000655',
                'order_wa' => 'Halo ARIMA, saya ingin konsultasi layanan.',
                'link_wa' => 'https://wa.me/628113000655',
                'website_link' => 'https://www.arimaindonesia.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        foreach (['commercial', 'residential', 'factory', 'disinfection', 'cleaning'] as $service) {
            DB::table("service_{$service}")->updateOrInsert(
                ['id' => 1],
                [
                    'title' => str($service)->replace('_', ' ')->headline()->toString(),
                    'description' => 'Konten awal untuk layanan ARIMA.',
                    'description_eng' => 'Initial content for ARIMA service.',
                    'list_type' => 'Assessment, Treatment, Monitoring',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }

        foreach (['general_pest', 'termite_baiting', 'fumigation'] as $method) {
            DB::table("method_{$method}")->updateOrInsert(
                ['id' => 1],
                [
                    'title' => str($method)->replace('_', ' ')->headline()->toString(),
                    'description' => 'Konten awal untuk metode ARIMA.',
                    'description_eng' => 'Initial content for ARIMA method.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }

        DB::table('pest')->updateOrInsert(
            ['id' => 1],
            [
                'title' => 'Pest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        DB::table('home_contents')->updateOrInsert(
            ['id' => 1],
            [
                'hero_video' => 'assets/arima/arima-revisi-fix_bq4UvNOh.mp4',
                'hero_poster_url' => 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_49_nkonei.png',
                'hero_eyebrow' => 'Green Pest Control Since 1998',
                'hero_eyebrow_eng' => 'Green Pest Control Since 1998',
                'hero_title' => 'ARIMA Indonesia',
                'hero_title_eng' => 'ARIMA Indonesia',
                'hero_description' => 'ARIMA Indonesia berdiri sejak tahun 1998 adalah perusahaan jasa di bidang utama pest control yaitu pengendalian hama dengan konsep green pest control.',
                'hero_description_eng' => 'ARIMA Indonesia has provided green pest control, pest management, disinfection, fumigation, termite baiting, and cleaning services since 1998.',
                'hero_primary_cta' => 'Konsultasi WhatsApp',
                'hero_primary_cta_eng' => 'Request Consultation',
                'hero_secondary_cta' => 'Service Solution',
                'hero_secondary_cta_eng' => 'Service Solution',
                'client_kicker' => 'Client & Partner',
                'client_kicker_eng' => 'Clients & Partners',
                'client_title' => 'Klien dan Mitra Kami',
                'client_title_eng' => 'Our Clients and Partners',
                'client_description' => 'Logo klien dibuat bergerak menyamping dengan animasi halus, tetap modern, dan berhenti saat kursor diarahkan ke area logo.',
                'client_description_eng' => 'Trusted by institutions, businesses, and operational facilities across sectors.',
                'seo_title' => 'ARIMA Indonesia | Green Pest Control sejak 1998',
                'seo_title_eng' => 'ARIMA Indonesia | Green Pest Control Since 1998',
                'seo_description' => 'ARIMA Indonesia menyediakan pest management, disinfection, fumigation, termite baiting, dan cleaning service sejak 1998.',
                'seo_description_eng' => 'ARIMA Indonesia provides pest management, disinfection, fumigation, termite baiting, and cleaning services since 1998.',
                'seo_keywords' => 'pest control surabaya, green pest control, fumigation, termite baiting, disinfection, cleaning service',
                'seo_keywords_eng' => 'pest control surabaya, green pest control, fumigation, termite baiting, disinfection, cleaning service',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );

        foreach ([
            ['BKD', 'Jatim', 'East Java'],
            ['DISHUB', 'Surabaya', 'Surabaya'],
            ['Sidoarjo', 'Pesona Delta', 'Pesona Delta'],
            ['DJP', 'Direktorat Jenderal Pajak', 'Directorate General of Taxes'],
            ['DISHUB', 'Kota Probolinggo', 'Probolinggo City'],
            ['BKN', 'Badan Kepegawaian Negara', 'National Civil Service Agency'],
            ['BKN II', 'Surabaya', 'Surabaya'],
            ['Aston', 'Madiun', 'Madiun'],
            ['Dompet', 'Dhuafa', 'Dhuafa'],
            ['Klinik Mata', 'Utama', 'Utama'],
            ['Gangsar', 'Legend Since 1931', 'Legend Since 1931'],
            ['Dinkes', 'Kesehatan', 'Health Office'],
        ] as $index => [$name, $subtitle, $subtitleEng]) {
            DB::table('home_clients')->updateOrInsert(
                ['name' => $name, 'subtitle' => $subtitle],
                [
                    'subtitle_eng' => $subtitleEng,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }
    }
}
