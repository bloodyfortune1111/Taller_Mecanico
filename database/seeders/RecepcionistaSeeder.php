<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RecepcionistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario recepcionista
        User::create([
            'name' => 'María Recepcionista',
            'email' => 'recepcion@taller.com',
            'password' => Hash::make('recepcion123'),
            'role' => 'recepcionista',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Usuario recepcionista creado exitosamente:');
        $this->command->info('Email: recepcion@taller.com');
        $this->command->info('Password: recepcion123');
    }
}
