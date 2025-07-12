<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el usuario administrador único
        User::updateOrCreate(
            ['email' => 'AdminAlex@taller.com'],
            [
                'name' => 'AdminAlex',
                'email' => 'AdminAlex@taller.com',
                'password' => Hash::make('admin123'), // Puedes cambiar esta contraseña
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        echo "Usuario administrador creado:\n";
        echo "Email: AdminAlex@taller.com\n";
        echo "Contraseña: admin123\n";
    }
}
