<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Désactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Tronquer la table users
        DB::table('role_user')->truncate();
        DB::table('users')->truncate();

        // Réactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insérer les données de seed
        DB::table('users')->insert([
            'name' => 'Donat',
            'email' => 'donat@gmail.com',
            'password' => bcrypt('password'),
        ]);

        // Attacher l'utilisateur au rôle 'User' (ajustez l'ID du rôle en conséquence)
        $user = DB::table('users')->where('email', 'donat@gmail.com')->first();
        $roleId = DB::table('roles')->where('name', 'Admin')->value('id');

        DB::table('role_user')->insert([
            'user_id' => $user->id,
            'role_id' => $roleId,
        ]);
    }
}
