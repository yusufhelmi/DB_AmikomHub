<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use Faker\Factory as Faker;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Generate minimal 5 baris data 
        for ($i = 1; $i <= 5; $i++) {
            Partner::create([
                'name' => $faker->company,
                'logo_url' => 'https://placehold.co/200x200' // Contoh URL 
            ]);
        }
    }
}