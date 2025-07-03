<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pieza;

class PiezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $piezas = [
            // Frenos
            [
                'numero_parte' => 'FR001',
                'nombre' => 'Pastillas de freno delanteras',
                'descripcion' => 'Pastillas de freno cerámicas para frenos delanteros, alta durabilidad',
                'categoria' => 'brakes',
                'marca' => 'Brembo',
                'precio' => 89.99,
                'stock' => 25,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Distribuidora Central',
                'vehiculo_compatible' => 'Toyota Camry 2015-2020, Honda Accord 2016-2021',
                'activo' => true,
                'especificaciones' => json_encode([
                    'material' => 'Cerámico',
                    'peso' => '2.5kg',
                    'garantia' => '12 meses',
                    'temperatura_trabajo' => '-40°C a 650°C'
                ])
            ],
            [
                'numero_parte' => 'FR002',
                'nombre' => 'Discos de freno traseros',
                'descripcion' => 'Discos de freno ventilados, acero de alta calidad',
                'categoria' => 'brakes',
                'marca' => 'ATE',
                'precio' => 156.50,
                'stock' => 15,
                'disponibilidad' => 'disponible',
                'proveedor' => 'AutoPartes Pro',
                'vehiculo_compatible' => 'Ford Focus 2012-2018, Volkswagen Golf 2013-2019',
                'activo' => true,
                'especificaciones' => json_encode([
                    'diametro' => '280mm',
                    'espesor' => '12mm',
                    'material' => 'Hierro fundido',
                    'ventilado' => true
                ])
            ],

            // Motor
            [
                'numero_parte' => 'ENG001',
                'nombre' => 'Filtro de aceite',
                'descripcion' => 'Filtro de aceite de motor, alta eficiencia de filtración',
                'categoria' => 'engine',
                'marca' => 'Mann-Filter',
                'precio' => 18.75,
                'stock' => 50,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Filtros Industriales',
                'vehiculo_compatible' => 'Universal para motores 1.6L-2.0L',
                'activo' => true,
                'especificaciones' => json_encode([
                    'rosca' => 'M20x1.5',
                    'diametro_exterior' => '76mm',
                    'altura' => '85mm',
                    'eficiencia' => '99.5%'
                ])
            ],
            [
                'numero_parte' => 'ENG002',
                'nombre' => 'Bujías de encendido',
                'descripcion' => 'Bujías de iridio, larga duración y mejor rendimiento',
                'categoria' => 'engine',
                'marca' => 'NGK',
                'precio' => 12.99,
                'stock' => 80,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Eléctricos Automotriz',
                'vehiculo_compatible' => 'Nissan Sentra 2013-2019, Mazda 3 2014-2020',
                'activo' => true,
                'especificaciones' => json_encode([
                    'material_electrodo' => 'Iridio',
                    'abertura' => '0.8mm',
                    'resistencia' => '5kΩ',
                    'vida_util' => '100,000 km'
                ])
            ],

            // Suspensión
            [
                'numero_parte' => 'SUS001',
                'nombre' => 'Amortiguador delantero',
                'descripcion' => 'Amortiguador hidráulico con tecnología twin-tube',
                'categoria' => 'suspension',
                'marca' => 'Monroe',
                'precio' => 145.00,
                'stock' => 12,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Suspensiones Premium',
                'vehiculo_compatible' => 'Chevrolet Cruze 2011-2016, Hyundai Elantra 2011-2017',
                'activo' => true,
                'especificaciones' => json_encode([
                    'tipo' => 'Hidráulico twin-tube',
                    'longitud_extendido' => '520mm',
                    'longitud_comprimido' => '320mm',
                    'peso' => '3.2kg'
                ])
            ],

            // Eléctrico
            [
                'numero_parte' => 'ELE001',
                'nombre' => 'Batería automotriz',
                'descripcion' => 'Batería de 12V 60Ah, libre de mantenimiento',
                'categoria' => 'electrical',
                'marca' => 'Optima',
                'precio' => 189.99,
                'stock' => 8,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Baterías y Energía',
                'vehiculo_compatible' => 'Vehículos compactos y medianos',
                'activo' => true,
                'especificaciones' => json_encode([
                    'voltaje' => '12V',
                    'capacidad' => '60Ah',
                    'corriente_arranque' => '540A',
                    'dimensiones' => '242x175x190mm',
                    'peso' => '15.8kg'
                ])
            ],

            // Transmisión
            [
                'numero_parte' => 'TRA001',
                'nombre' => 'Kit de embrague',
                'descripcion' => 'Kit completo de embrague con disco, plato y collarín',
                'categoria' => 'transmission',
                'marca' => 'LuK',
                'precio' => 285.50,
                'stock' => 6,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Transmisiones Especializadas',
                'vehiculo_compatible' => 'Volkswagen Jetta 2011-2018, Seat León 2012-2019',
                'activo' => true,
                'especificaciones' => json_encode([
                    'diametro_disco' => '228mm',
                    'numero_dientes' => '23',
                    'incluye' => ['Disco', 'Plato de presión', 'Collarín'],
                    'torque_max' => '200Nm'
                ])
            ],

            // Combustible
            [
                'numero_parte' => 'FUE001',
                'nombre' => 'Bomba de combustible',
                'descripcion' => 'Bomba eléctrica de combustible en tanque',
                'categoria' => 'fuel',
                'marca' => 'Bosch',
                'precio' => 125.75,
                'stock' => 10,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Sistemas de Combustible',
                'vehiculo_compatible' => 'Kia Rio 2012-2017, Hyundai Accent 2012-2017',
                'activo' => true,
                'especificaciones' => json_encode([
                    'presion' => '3.5 bar',
                    'caudal' => '120 L/h',
                    'voltaje' => '12V',
                    'tipo' => 'Eléctrica sumergible'
                ])
            ],

            // Filtros
            [
                'numero_parte' => 'FIL001',
                'nombre' => 'Filtro de aire',
                'descripcion' => 'Filtro de aire del motor, alta eficiencia',
                'categoria' => 'filters',
                'marca' => 'K&N',
                'precio' => 32.99,
                'stock' => 35,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Filtros Premium',
                'vehiculo_compatible' => 'Toyota Corolla 2014-2019, Honda Civic 2016-2021',
                'activo' => true,
                'especificaciones' => json_encode([
                    'material' => 'Algodón oiled',
                    'dimensiones' => '213x159x51mm',
                    'lavable' => true,
                    'vida_util' => '80,000 km'
                ])
            ],

            // Aceites
            [
                'numero_parte' => 'OIL001',
                'nombre' => 'Aceite motor sintético 5W-30',
                'descripcion' => 'Aceite sintético premium para motor, 4 litros',
                'categoria' => 'oils',
                'marca' => 'Mobil 1',
                'precio' => 78.99,
                'stock' => 20,
                'disponibilidad' => 'disponible',
                'proveedor' => 'Lubricantes Premium',
                'vehiculo_compatible' => 'Motores gasolina modernos',
                'activo' => true,
                'especificaciones' => json_encode([
                    'viscosidad' => '5W-30',
                    'tipo' => 'Sintético',
                    'contenido' => '4 litros',
                    'especificaciones' => ['API SN', 'ACEA A3/B4'],
                    'cambio_recomendado' => '10,000 km'
                ])
            ]
        ];

        foreach ($piezas as $pieza) {
            Pieza::create($pieza);
        }
    }
}
