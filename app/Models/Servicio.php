<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_base',
        'categoria',
        'tiempo_estimado',
        'activo'
    ];

    protected $casts = [
        'precio_base' => 'decimal:2',
        'activo' => 'boolean',
        'tiempo_estimado' => 'integer'
    ];

    // Scope para obtener únicamente los servicios activos
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    // Relación muchos a muchos con órdenes de servicio
    public function ordenesServicio()
    {
        return $this->belongsToMany(OrdenServicio::class, 'orden_servicio_servicios')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }
}
