<?php

namespace Database\Seeders;

use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Utilisateur::query()->updateOrCreate(
            ['email' => 'admin@maBoutique.com'],
            [
                'nom' => 'Admin',
                'prenom' => 'Principal',
                'mot_de_passe' => Hash::make('Admin@123!'),
                'role' => 'admin',
                'date_de_naissance' => null,
                'sexe' => null,
                'photo' => null,
            ]
        );
    }
}