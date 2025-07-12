<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuarios de prueba que NO podrán acceder al sistema
        $testUsers = [
            [
                'name' => 'Juan Pérez',
                'email' => 'juan@taller.com',
                'password' => Hash::make('123456'),
                'role' => 'empleado',
            ],
            [
                'name' => 'María García',
                'email' => 'maria@taller.com',
                'password' => Hash::make('123456'),
                'role' => 'empleado',
            ],
            [
                'name' => 'Carlos López',
                'email' => 'carlos@taller.com',
                'password' => Hash::make('123456'),
                'role' => 'mecanico',
            ],
        ];

        foreach ($testUsers as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        echo "Usuarios de prueba creados. Estos usuarios NO podrán acceder al sistema:\n";
        echo "- juan@taller.com (contraseña: 123456)\n";
        echo "- maria@taller.com (contraseña: 123456)\n";
        echo "- carlos@taller.com (contraseña: 123456)\n\n";
        echo "Solo AdminAlex@taller.com puede acceder al sistema.\n";
    }
}
