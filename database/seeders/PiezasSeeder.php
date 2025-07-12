<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pieza;

class PiezasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $piezas = [
            // Frenos
            [
                'nombre' => 'Pastillas de Freno Delanteras',
                'numero_parte' => 'BRK-001',
                'descripcion' => 'Pastillas de freno delanteras cerámicas de alta calidad',
                'marca' => 'Bosch',
                'precio' => 85.00,
                'stock' => 25,
                'categoria' => 'Frenos',
                'vehiculo_compatible' => 'Universal',
                'proveedor' => 'Bosch México',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Discos de Freno Traseros',
                'numero_parte' => 'BRK-002',
                'descripcion' => 'Discos de freno traseros ventilados',
                'marca' => 'Brembo',
                'precio' => 120.00,
                'stock' => 15,
                'categoria' => 'Frenos',
                'vehiculo_compatible' => 'Sedán/Hatchback',
                'proveedor' => 'Brembo International',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Líquido de Frenos DOT 4',
                'numero_parte' => 'BRK-003',
                'descripcion' => 'Líquido de frenos DOT 4 500ml',
                'marca' => 'Valvoline',
                'precio' => 25.00,
                'stock' => 50,
                'categoria' => 'Frenos',
                'vehiculo_compatible' => 'Universal',
                'proveedor' => 'Valvoline',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            
            // Motor
            [
                'nombre' => 'Filtro de Aceite',
                'numero_parte' => 'ENG-001',
                'descripcion' => 'Filtro de aceite para motor de gasolina',
                'marca' => 'Mann',
                'precio' => 35.00,
                'stock' => 40,
                'categoria' => 'Motor',
                'vehiculo_compatible' => 'Universal',
                'proveedor' => 'Mann Filter',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Bujías de Encendido',
                'numero_parte' => 'ENG-002',
                'descripcion' => 'Bujías de encendido iridium (Set de 4)',
                'marca' => 'NGK',
                'precio' => 65.00,
                'stock' => 20,
                'categoria' => 'Motor',
                'vehiculo_compatible' => '4 cilindros',
                'proveedor' => 'NGK Spark Plugs',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Correa de Distribución',
                'numero_parte' => 'ENG-003',
                'descripcion' => 'Correa de distribución reforzada',
                'marca' => 'Gates',
                'precio' => 180.00,
                'stock' => 10,
                'categoria' => 'Motor',
                'vehiculo_compatible' => 'Motor 1.6L-2.0L',
                'proveedor' => 'Gates Corporation',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Termostato',
                'numero_parte' => 'ENG-004',
                'descripcion' => 'Termostato del sistema de refrigeración',
                'marca' => 'Wahler',
                'precio' => 45.00,
                'stock' => 30,
                'categoria' => 'Motor',
                'vehiculo_compatible' => 'Universal',
                'proveedor' => 'Wahler',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            
            // Transmisión
            [
                'nombre' => 'Aceite de Transmisión ATF',
                'numero_parte' => 'TRA-001',
                'descripcion' => 'Aceite para transmisión automática 4L',
                'marca' => 'Castrol',
                'precio' => 95.00,
                'stock' => 18,
                'categoria' => 'Transmisión',
                'vehiculo_compatible' => 'Transmisión automática',
                'proveedor' => 'Castrol',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Kit de Embrague',
                'numero_parte' => 'TRA-002',
                'descripcion' => 'Kit completo de embrague (disco, plato, cojinete)',
                'marca' => 'Sachs',
                'precio' => 450.00,
                'stock' => 8,
                'categoria' => 'Transmisión',
                'vehiculo_compatible' => 'Transmisión manual',
                'proveedor' => 'Sachs',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            
            // Suspensión
            [
                'nombre' => 'Amortiguadores Delanteros',
                'numero_parte' => 'SUS-001',
                'descripcion' => 'Par de amortiguadores delanteros de gas',
                'marca' => 'Monroe',
                'precio' => 320.00,
                'stock' => 12,
                'categoria' => 'Suspensión',
                'vehiculo_compatible' => 'Sedán/Hatchback',
                'proveedor' => 'Monroe',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Resortes Traseros',
                'numero_parte' => 'SUS-002',
                'descripcion' => 'Par de resortes traseros',
                'marca' => 'Eibach',
                'precio' => 280.00,
                'stock' => 8,
                'categoria' => 'Suspensión',
                'vehiculo_compatible' => 'Sedán',
                'proveedor' => 'Eibach',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            
            // Eléctrico
            [
                'nombre' => 'Batería 12V',
                'numero_parte' => 'ELE-001',
                'descripcion' => 'Batería de 12V 60Ah libre de mantenimiento',
                'marca' => 'Optima',
                'precio' => 380.00,
                'stock' => 15,
                'categoria' => 'Eléctrico',
                'vehiculo_compatible' => 'Universal',
                'proveedor' => 'Optima Batteries',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Alternador',
                'numero_parte' => 'ELE-002',
                'descripcion' => 'Alternador 12V 90A reconstruido',
                'marca' => 'Bosch',
                'precio' => 650.00,
                'stock' => 5,
                'categoria' => 'Eléctrico',
                'vehiculo_compatible' => 'Motor 1.6L-2.0L',
                'proveedor' => 'Bosch',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            
            // Carrocería
            [
                'nombre' => 'Espejo Retrovisor Derecho',
                'numero_parte' => 'BOD-001',
                'descripcion' => 'Espejo retrovisor derecho con calefacción',
                'marca' => 'OEM',
                'precio' => 180.00,
                'stock' => 6,
                'categoria' => 'Carrocería',
                'vehiculo_compatible' => 'Sedán',
                'proveedor' => 'OEM Parts',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ],
            [
                'nombre' => 'Parachoques Delantero',
                'numero_parte' => 'BOD-002',
                'descripcion' => 'Parachoques delantero pintado',
                'marca' => 'OEM',
                'precio' => 850.00,
                'stock' => 3,
                'categoria' => 'Carrocería',
                'vehiculo_compatible' => 'Sedán 2018-2023',
                'proveedor' => 'OEM Parts',
                'activo' => true,
                'disponibilidad' => 'agotado'
            ],
            
            // Neumáticos
            [
                'nombre' => 'Neumático 205/55R16',
                'numero_parte' => 'TIR-001',
                'descripcion' => 'Neumático radial 205/55R16 91V',
                'marca' => 'Michelin',
                'precio' => 220.00,
                'stock' => 20,
                'categoria' => 'Neumáticos',
                'vehiculo_compatible' => 'Rin 16',
                'proveedor' => 'Michelin',
                'activo' => true,
                'disponibilidad' => 'disponible'
            ]
        ];

        foreach ($piezas as $pieza) {
            Pieza::create($pieza);
        }
    }
}
