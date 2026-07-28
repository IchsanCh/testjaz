<?php

namespace Database\Seeders;

use App\Models\HeroContent;
use Illuminate\Database\Seeder;

class HeroContentSeeder extends Seeder
{
    public function run(): void
    {
        HeroContent::updateOrCreate(
            ['id' => 1],
            [
                'headline' => 'Sarung Tenun Turun Temurun',
                'subheadline' => 'Ditenun perlahan, dijaga kualitasnya, dipakai sepanjang masa.',
            ]
        );
    }
}
