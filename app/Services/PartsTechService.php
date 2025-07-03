<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class PartsTechService
{
    private $baseUrl;
    private $apiKey;
    private $timeout;

    public function __construct()
    {
        // Configuración de la API de PartsTech
        $this->baseUrl = config('services.partstech.base_url', 'https://api.partstech.com/v1');
        $this->apiKey = config('services.partstech.api_key');
        $this->timeout = config('services.partstech.timeout', 30);
    }

    /**
     * Buscar piezas por vehículo específico (año, marca, modelo y motor)
     */
    public function searchPartsByVehicle($year, $make, $model, $engine = null)
    {
        try {
            $cacheKey = "parts_search_{$year}_{$make}_{$model}" . ($engine ? "_{$engine}" : '');
            
            // Buscar en caché primero (cachear por 1 hora para mejorar rendimiento)
            return Cache::remember($cacheKey, 3600, function () use ($year, $make, $model, $engine) {
                $params = [
                    'year' => $year,
                    'make' => $make,
                    'model' => $model,
                ];

                // Agregar motor si está disponible para búsqueda más específica
                if ($engine) {
                    $params['engine'] = $engine;
                }

                $response = Http::timeout($this->timeout)
                    ->withHeaders([
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ])
                    ->get($this->baseUrl . '/parts/search', $params);

                if ($response->successful()) {
                    return $this->formatPartsResponse($response->json());
                }

                // Registrar error en logs para depuración
                Log::error('Error en API de PartsTech', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'params' => $params
                ]);

                return [];
            });

        } catch (\Exception $e) {
            Log::error('Excepción en Servicio PartsTech', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [];
        }
    }

    /**
     * Buscar piezas por categoría específica (opcionalmente filtrado por vehículo)
     */
    public function searchPartsByCategory($category, $year = null, $make = null, $model = null)
    {
        try {
            $cacheKey = "parts_category_{$category}" . ($year ? "_{$year}_{$make}_{$model}" : '');
            
            // Cachear resultados de categoría por 1 hora
            return Cache::remember($cacheKey, 3600, function () use ($category, $year, $make, $model) {
                $params = ['category' => $category];

                // Agregar filtros de vehículo si están disponibles
                if ($year && $make && $model) {
                    $params['year'] = $year;
                    $params['make'] = $make;
                    $params['model'] = $model;
                }

                $response = Http::timeout($this->timeout)
                    ->withHeaders([
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Accept' => 'application/json'
                    ])
                    ->get($this->baseUrl . '/parts/category', $params);

                if ($response->successful()) {
                    return $this->formatPartsResponse($response->json());
                }

                // Registrar errores específicos de búsqueda por categoría
                Log::error('Error en API de PartsTech - Búsqueda por Categoría', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'params' => $params
                ]);

                return [];
            });

        } catch (\Exception $e) {
            Log::error('Excepción en Servicio PartsTech - Búsqueda por Categoría', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [];
        }
    }

    /**
     * Obtener detalles completos de una pieza específica por número de parte
     */
    public function getPartDetails($partNumber)
    {
        try {
            $cacheKey = "part_details_{$partNumber}";
            
            // Cachear detalles de pieza por 2 horas (información más estable)
            return Cache::remember($cacheKey, 7200, function () use ($partNumber) {
                $response = Http::timeout($this->timeout)
                    ->withHeaders([
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Accept' => 'application/json'
                    ])
                    ->get($this->baseUrl . "/parts/{$partNumber}");

                if ($response->successful()) {
                    return $this->formatPartDetailsResponse($response->json());
                }

                // Registrar errores de obtención de detalles
                Log::error('Error en API de PartsTech - Detalles de Pieza', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'part_number' => $partNumber
                ]);

                return null;
            });

        } catch (\Exception $e) {
            Log::error('Excepción en Detalles de Pieza PartsTech', [
                'message' => $e->getMessage(),
                'part_number' => $partNumber
            ]);

            return null;
        }
    }

    /**
     * Obtener precios actuales y disponibilidad de una pieza específica
     */
    public function getPriceAndAvailability($partNumber, $quantity = 1)
    {
        try {
            $response = Http::timeout($this->timeout)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json'
                ])
                ->get($this->baseUrl . "/parts/{$partNumber}/pricing", [
                    'quantity' => $quantity
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            // Registrar errores de consulta de precios
            Log::error('Error en API de PartsTech - Consulta de Precios', [
                'status' => $response->status(),
                'response' => $response->body(),
                'part_number' => $partNumber
            ]);

            return null;

        } catch (\Exception $e) {
            Log::error('Excepción en Consulta de Precios PartsTech', [
                'message' => $e->getMessage(),
                'part_number' => $partNumber
            ]);

            return null;
        }
    }

    /**
     * Formatear la respuesta de búsqueda de piezas para uso interno
     */
    private function formatPartsResponse($apiResponse)
    {
        // Verificar que la respuesta tenga la estructura esperada
        if (!isset($apiResponse['data']) || !is_array($apiResponse['data'])) {
            return [];
        }

        // Transformar cada pieza al formato interno del sistema
        return array_map(function ($part) {
            return [
                'part_number' => $part['part_number'] ?? '',
                'name' => $part['name'] ?? '',
                'description' => $part['description'] ?? '',
                'category' => $part['category'] ?? '',
                'brand' => $part['brand'] ?? '',
                'price' => $part['price'] ?? 0,
                'currency' => $part['currency'] ?? 'USD',
                'availability' => $part['availability'] ?? 'unknown',
                'image_url' => $part['image_url'] ?? null,
                'specifications' => $part['specifications'] ?? [],
                'compatibility' => $part['compatibility'] ?? [],
                'external_id' => $part['id'] ?? null,
                'supplier' => 'PartsTech'
            ];
        }, $apiResponse['data']);
    }

    /**
     * Formatear la respuesta de detalles de pieza específica
     */
    private function formatPartDetailsResponse($apiResponse)
    {
        // Verificar que la respuesta contenga datos
        if (!isset($apiResponse['data'])) {
            return null;
        }

        $part = $apiResponse['data'];
        
        // Crear objeto con información completa de la pieza
        return [
            'part_number' => $part['part_number'] ?? '',
            'name' => $part['name'] ?? '',
            'description' => $part['description'] ?? '',
            'category' => $part['category'] ?? '',
            'brand' => $part['brand'] ?? '',
            'price' => $part['price'] ?? 0,
            'currency' => $part['currency'] ?? 'USD',
            'availability' => $part['availability'] ?? 'unknown',
            'image_url' => $part['image_url'] ?? null,
            'specifications' => $part['specifications'] ?? [],
            'compatibility' => $part['compatibility'] ?? [],
            'external_id' => $part['id'] ?? null,
            'supplier' => 'PartsTech',
            'weight' => $part['weight'] ?? null,
            'dimensions' => $part['dimensions'] ?? null,
            'warranty' => $part['warranty'] ?? null,
            'installation_notes' => $part['installation_notes'] ?? null
        ];
    }

    /**
     * Verificar la conectividad con la API de PartsTech
     */
    public function testConnection()
    {
        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json'
                ])
                ->get($this->baseUrl . '/health');

            return $response->successful();

        } catch (\Exception $e) {
            Log::error('Prueba de Conexión PartsTech Falló', [
                'message' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Obtener lista de categorías disponibles en español
     */
    public function getAvailableCategories()
    {
        return [
            'engine' => 'Motor',
            'transmission' => 'Transmisión',
            'brakes' => 'Frenos',
            'suspension' => 'Suspensión',
            'electrical' => 'Eléctrico',
            'cooling' => 'Refrigeración',
            'exhaust' => 'Escape',
            'fuel' => 'Combustible',
            'interior' => 'Interior',
            'exterior' => 'Exterior',
            'filters' => 'Filtros',
            'oils' => 'Aceites y Fluidos',
            'tires' => 'Llantas',
            'body' => 'Carrocería'
        ];
    }
}
