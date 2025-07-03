<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'vehiculo_id',
        'mecanico_id',
        'diagnostico',
        'servicios_realizar',
        'repuestos_necesarios',
        'costo_total',
        'estado',
        'pagado',
    ];

    protected $casts = [
        'costo_total' => 'decimal:2',
        'pagado' => 'boolean',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function mecanico()
    {
        return $this->belongsTo(User::class, 'mecanico_id');
    }

    // Relación con servicios del catálogo
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'orden_servicio_servicios')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }

    // Relación con piezas del catálogo
    public function piezas()
    {
        return $this->belongsToMany(Pieza::class, 'orden_servicio_piezas')
                    ->withPivot('cantidad', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }

    // Calcular costo total automáticamente
    public function calcularCostoTotal()
    {
        $totalServicios = $this->servicios->sum('pivot.subtotal');
        $totalPiezas = $this->piezas->sum('pivot.subtotal');
        
        $this->costo_total = $totalServicios + $totalPiezas;
        $this->save();
        
        return $this->costo_total;
    }
}
