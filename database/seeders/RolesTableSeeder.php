<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Ajoutez ici la logique de création des rôles
        DB::table('roles')->insert([
            'name' => 'Admin',

        ]);
        DB::table('roles')->insert([
            'name' => 'user',

        ]);

        // Vous pouvez également ajouter d'autres rôles ici si nécessaire
    }
}
