<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'precio_base',
        'categoria',
        'tiempo_estimado',
        'duracion_estimada',
        'activo'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'precio_base' => 'decimal:2',
        'activo' => 'boolean',
        'tiempo_estimado' => 'integer',
        'duracion_estimada' => 'integer'
    ];

    // Accessor para compatibilidad con la API
    public function getPrecioAttribute($value)
    {
        return $value ?? $this->precio_base;
    }

    public function getDuracionEstimadaAttribute($value)
    {
        return $value ?? $this->tiempo_estimado;
    }

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
