<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nom' => 'Gestionnaire Globale', 'description' => 'Gestionnaire de l\'ensemble des opérations'],
            ['nom' => 'Gestionnaire Hotel', 'description' => 'Gestionnaire des opérations hôtelières'],
            ['nom' => 'Gestionnaire Entité', 'description' => 'Gestionnaire des opérations d\'entité dans l\'hôtel'],
            // ... jusqu'à des milliers d'entrées
        ];
            
        

        DB::table('roles')->insert($data);
        //
    }
}
