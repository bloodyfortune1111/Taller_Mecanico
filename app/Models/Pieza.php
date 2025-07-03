<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    protected $fillable = [
        'nombre',
        'numero_parte',
        'descripcion',
        'marca',
        'precio',
        'stock',
        'categoria',
        'vehiculo_compatible',
        'proveedor',
        'api_id',
        'api_data',
        'activo',
        'disponibilidad',
        'external_id',
        'imagen_url',
        'especificaciones'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'activo' => 'boolean',
        'api_data' => 'array',
        'especificaciones' => 'array'
    ];

    // Scope para obtener únicamente las piezas activas
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    // Scope para obtener piezas que tienen stock disponible
    public function scopeEnStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Relación muchos a muchos con órdenes de servicio
    public function ordenesServicio()
    {
        return $this->belongsToMany(OrdenServicio::class, 'orden_servicio_piezas')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }

    // Verificar si hay stock suficiente para la cantidad solicitada
    public function tieneStock($cantidad = 1)
    {
        return $this->stock >= $cantidad;
    }

    // Reducir el stock de la pieza
    public function reducirStock($cantidad)
    {
        if ($this->tieneStock($cantidad)) {
            $this->decrement('stock', $cantidad);
            return true;
        }
        return false;
    }
}
