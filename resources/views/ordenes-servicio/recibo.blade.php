<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo - Orden #{{ $orden_servicio->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .header h1 {
            margin: 0;
            color: #2563eb;
            font-size: 24px;
        }
        
        .header h2 {
            margin: 5px 0 0 0;
            font-size: 18px;
            color: #666;
        }
        
        .company-info {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .recibo-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .recibo-info > div {
            width: 48%;
        }
        
        .info-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #2563eb;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        
        .info-row {
            margin-bottom: 8px;
        }
        
        .info-row strong {
            display: inline-block;
            width: 120px;
            color: #555;
        }
        
        .servicios-table, .piezas-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .servicios-table th, .servicios-table td,
        .piezas-table th, .piezas-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        
        .servicios-table th, .piezas-table th {
            background-color: #f1f5f9;
            font-weight: bold;
            color: #374151;
        }
        
        .servicios-table tr:nth-child(even),
        .piezas-table tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        .text-right {
            text-align: right;
        }
        
        .total-section {
            background-color: #f1f5f9;
            padding: 20px;
            border-radius: 5px;
            margin-top: 30px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .total-row.final {
            border-top: 2px solid #333;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #059669;
        }
        
        .estado-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .estado-pagado {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .signature-section {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            width: 45%;
            text-align: center;
        }
        
        .signature-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 5px;
            font-size: 12px;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h1>TALLER MECÁNICO</h1>
            <h2>RECIBO DE SERVICIO</h2>
        </div>
    </div>

    <div class="recibo-info">
        <div>
            <div class="info-box">
                <h3>Datos del Cliente</h3>
                <div class="info-row">
                    <strong>Nombre:</strong> {{ $orden_servicio->cliente->nombre ?? 'N/A' }} {{ $orden_servicio->cliente->apellido ?? '' }}
                </div>
                <div class="info-row">
                    <strong>Email:</strong> {{ $orden_servicio->cliente->email ?? 'N/A' }}
                </div>
                <div class="info-row">
                    <strong>Teléfono:</strong> {{ $orden_servicio->cliente->telefono ?? 'N/A' }}
                </div>
            </div>
            
            <div class="info-box">
                <h3>Datos del Vehículo</h3>
                <div class="info-row">
                    <strong>Marca/Modelo:</strong> {{ $orden_servicio->vehiculo->marca ?? 'N/A' }} {{ $orden_servicio->vehiculo->modelo ?? '' }}
                </div>
                <div class="info-row">
                    <strong>Matrícula:</strong> {{ $orden_servicio->vehiculo->matricula ?? 'N/A' }}
                </div>
                <div class="info-row">
                    <strong>Año:</strong> {{ $orden_servicio->vehiculo->año ?? 'N/A' }}
                </div>
            </div>
        </div>
        
        <div>
            <div class="info-box">
                <h3>Información de la Orden</h3>
                <div class="info-row">
                    <strong>Orden N°:</strong> {{ $orden_servicio->id }}
                </div>
                <div class="info-row">
                    <strong>Fecha:</strong> {{ $orden_servicio->created_at->format('d/m/Y H:i') }}
                </div>
                <div class="info-row">
                    <strong>Estado:</strong> <span class="estado-badge estado-pagado">{{ ucfirst(str_replace('_', ' ', $orden_servicio->estado)) }}</span>
                </div>
                <div class="info-row">
                    <strong>Mecánico:</strong> {{ $orden_servicio->mecanico->name ?? 'Sin asignar' }}
                </div>
                <div class="info-row">
                    <strong>Pago:</strong> <span class="estado-badge estado-pagado">PAGADO</span>
                </div>
            </div>
        </div>
    </div>

    @if($orden_servicio->diagnostico)
    <div class="info-box">
        <h3>Diagnóstico</h3>
        <p>{{ $orden_servicio->diagnostico }}</p>
    </div>
    @endif

    @if($orden_servicio->servicios && $orden_servicio->servicios->count() > 0)
    <div>
        <h3 style="color: #2563eb; margin-bottom: 15px;">Servicios Realizados</h3>
        <table class="servicios-table">
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Descripción</th>
                    <th class="text-right">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orden_servicio->servicios as $servicio)
                <tr>
                    <td>{{ $servicio->nombre }}</td>
                    <td>{{ $servicio->descripcion ?? '-' }}</td>
                    <td class="text-right">${{ number_format($servicio->precio_base, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #e5f3ff;">
                    <td colspan="2"><strong>Subtotal Servicios</strong></td>
                    <td class="text-right"><strong>${{ number_format($totalServicios, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endif

    @if($orden_servicio->piezas && $orden_servicio->piezas->count() > 0)
    <div>
        <h3 style="color: #2563eb; margin-bottom: 15px;">Piezas y Repuestos</h3>
        <table class="piezas-table">
            <thead>
                <tr>
                    <th>Pieza</th>
                    <th>Cantidad</th>
                    <th class="text-right">Precio Unitario</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orden_servicio->piezas as $pieza)
                <tr>
                    <td>{{ $pieza->nombre }}</td>
                    <td>{{ $pieza->pivot->cantidad }}</td>
                    <td class="text-right">${{ number_format($pieza->precio, 2) }}</td>
                    <td class="text-right">${{ number_format($pieza->precio * $pieza->pivot->cantidad, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #e5f3ff;">
                    <td colspan="3"><strong>Subtotal Piezas</strong></td>
                    <td class="text-right"><strong>${{ number_format($totalPiezas, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endif

    <div class="total-section">
        @if($totalServicios > 0)
        <div class="total-row">
            <span>Subtotal Servicios:</span>
            <span>${{ number_format($totalServicios, 2) }}</span>
        </div>
        @endif
        
        @if($totalPiezas > 0)
        <div class="total-row">
            <span>Subtotal Piezas:</span>
            <span>${{ number_format($totalPiezas, 2) }}</span>
        </div>
        @endif
        
        <div class="total-row final">
            <span>TOTAL PAGADO:</span>
            <span>${{ number_format($orden_servicio->costo_total, 2) }}</span>
        </div>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line">
                Firma del Cliente
            </div>
        </div>
        <div class="signature-box">
            <div class="signature-line">
                Firma del Taller
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Gracias por confiar en nuestros servicios</p>
        <p>Recibo generado el {{ date('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
