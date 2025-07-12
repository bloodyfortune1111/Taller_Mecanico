<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Importante para usar factories
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    // Define los atributos que se pueden asignar masivamente (mass assignable)
    // Esto es CRUCIAL por seguridad y funcionalidad. Sin esto, Laravel no permitirá
    // que asignes valores a estas columnas directamente al crear o actualizar un modelo
    // usando Vehiculo::create($request->all()) o $vehiculo->update($request->all()).
    protected $fillable = [
        'cliente_id', // Para la relación con el cliente
        'marca',
        'modelo',
        'año',
        'matricula',
        'color',
        'combustible',
        'kilometraje',
    ];

    /**
     * Define la relación con el cliente.
     * Un vehículo pertenece a un solo cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function ordenesServicio()
{
    return $this->hasMany(OrdenServicio::class);
}
}
