<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::create([
            'nom' => 'Hotel Soleil',
            'description' => 'Un hôtel confortable au centre-ville',
            'location' => 'Conakry',
        ]);

        Hotel::create([
            'nom' => 'Hotel Lune',
            'description' => 'Hôtel de luxe avec piscine',
            'location' => 'Kaloum',
        ]);

        Hotel::create([
            'nom' => 'Hotel Etoile',
            'description' => 'Hôtel familial et accueillant',
            'location' => 'Ratoma',
        ]);

        Hotel::create([
            'nom' => 'Hotel Horizon',
            'description' => 'Chambres modernes avec vue sur la mer',
            'location' => 'Dixinn',
        ]);

        Hotel::create([
            'nom' => 'Hotel Oasis',
            'description' => 'Hôtel économique et pratique',
            'location' => 'Matoto',
        ]);
    }
}
