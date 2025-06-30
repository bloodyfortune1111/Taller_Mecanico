<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory; // Importante para usar factories y crear datos de prueba

    // Define los atributos que se pueden asignar masivamente (mass assignable)
    // Esto es CRUCIAL por seguridad y funcionalidad. Sin esto, Laravel no permitirá
    // que asignes valores a estas columnas directamente al crear o actualizar un modelo
    // usando Cliente::create($request->all()) o $cliente->update($request->all()).
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'direccion',
    ];

    /**
     * Define la relación con los vehículos.
     * Un cliente puede tener muchos vehículos.
     */
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }
}
