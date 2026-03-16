<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MoradaLodgeUserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur administrateur pour Morada Lodge
        User::updateOrCreate(
            ['email' => 'admin@moradalodge.com'],
            [
                'name' => 'Administrateur Morada Lodge',
                'password' => Hash::make('morada2024'),
                'role' => 'Super',
                'random_key' => Str::random(32),
            ]
        );

        // Créer un utilisateur réceptionniste
        User::updateOrCreate(
            ['email' => 'reception@moradalodge.com'],
            [
                'name' => 'Réception Morada Lodge',
                'password' => Hash::make('reception2024'),
                'role' => 'Receptionist',
                'random_key' => Str::random(32),
            ]
        );

        // Créer un utilisateur manager
        User::updateOrCreate(
            ['email' => 'manager@moradalodge.com'],
            [
                'name' => 'Manager Morada Lodge',
                'password' => Hash::make('manager2024'),
                'role' => 'Admin',
                'random_key' => Str::random(32),
            ]
        );
    }
}
