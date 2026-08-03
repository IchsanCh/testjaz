<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'app_name' => 'AL HIJAZ',
                'whatsapp_number' => '6281234567890', // ganti ke nomor asli klien
                'email' => 'info@alhijaz.test',
                'address' => 'Pekalongan, Jawa Tengah',
                'latitude' => -6.889876,
                'longitude' => 109.675432,
                'default_meta_title' => 'AL HIJAZ — Sarung Tenun Premium',
                'default_meta_description' => 'Sarung tenun premium turun-temurun, ditenun dengan filosofi warisan Timur Tengah.',
                'owner_name' => 'Owner AL HIJAZ',
                'owner_quote' => 'Setiap helai adalah warisan yang kami jaga turun-temurun.',
            ]
        );
    }
}
