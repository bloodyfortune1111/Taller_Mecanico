<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura {{ $numeroFactura }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        
        .header {
            background-color: #2563eb;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 14px;
            margin: 2px 0;
        }
        
        .factura-info {
            background-color: #f8fafc;
            padding: 15px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
        }
        
        .factura-info h2 {
            color: #2563eb;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-cell {
            display: table-cell;
            padding: 5px 0;
            width: 50%;
        }
        
        .info-label {
            font-weight: bold;
            color: #4a5568;
        }
        
        .cliente-vehiculo {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .cliente-section, .vehiculo-section {
            display: table-cell;
            width: 50%;
            padding: 15px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        
        .cliente-section {
            margin-right: 10px;
        }
        
        .vehiculo-section {
            margin-left: 10px;
        }
        
        .section-title {
            color: #2563eb;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 5px;
        }
        
        .servicios-table, .piezas-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .servicios-table th, .piezas-table th {
            background-color: #2563eb;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        
        .servicios-table td, .piezas-table td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .servicios-table tr:nth-child(even), .piezas-table tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .totales {
            background-color: #f8fafc;
            border: 2px solid #2563eb;
            padding: 15px;
            margin-top: 20px;
            width: 50%;
            margin-left: auto;
        }
        
        .totales table {
            width: 100%;
        }
        
        .totales td {
            padding: 5px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .totales .total-final {
            font-size: 16px;
            font-weight: bold;
            color: #2563eb;
            border-top: 2px solid #2563eb;
            padding-top: 10px;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #2563eb;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
        }
        
        .money {
            color: #059669;
            font-weight: bold;
        }
        
        @page {
            margin: 20mm;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>TALLER MECÁNICO PROFESIONAL</h1>
        <p>Servicio Automotriz de Calidad</p>
        <p>Av. Principal #123, San Francisco de Campeche | 55-1234-5678 | info@tallermx.com</p>
        <p>RFC: TMX123456789 | Régimen Fiscal: Persona Física con Actividades Empresariales</p>
    </div>

    <!-- Información de la Factura -->
    <div class="factura-info">
        <h2>FACTURA {{ $numeroFactura }}</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-cell">
                    <span class="info-label">Fecha de Emisión:</span> {{ $fechaGeneracion ? $fechaGeneracion->format('d/m/Y H:i') : 'N/A' }}
                </div>
                <div class="info-cell">
                    <span class="info-label">Orden de Servicio:</span> #{{ str_pad($orden->id, 4, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            <div class="info-row">
                <div class="info-cell">
                    <span class="info-label">Fecha de Servicio:</span> {{ $orden->created_at ? $orden->created_at->format('d/m/Y') : 'N/A' }}
                </div>
                <div class="info-cell">
                    <span class="info-label">Fecha de Finalización:</span> {{ $orden->updated_at ? $orden->updated_at->format('d/m/Y') : 'N/A' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Cliente y Vehículo -->
    <div class="cliente-vehiculo">
        <div class="cliente-section">
            <div class="section-title">👤 DATOS DEL CLIENTE</div>
            <p><strong>Nombre:</strong> {{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}</p>
            <p><strong>Email:</strong> {{ $orden->cliente->email }}</p>
            <p><strong>Teléfono:</strong> {{ $orden->cliente->telefono ?? 'No proporcionado' }}</p>
            <p><strong>Dirección:</strong> {{ $orden->cliente->direccion ?? 'No proporcionada' }}</p>
        </div>
        
        <div class="vehiculo-section">
            <div class="section-title">🚗 DATOS DEL VEHÍCULO</div>
            <p><strong>Marca:</strong> {{ $orden->vehiculo->marca }}</p>
            <p><strong>Modelo:</strong> {{ $orden->vehiculo->modelo }}</p>
            <p><strong>Año:</strong> {{ $orden->vehiculo->anio }}</p>
            <p><strong>Placas:</strong> {{ $orden->vehiculo->matricula }}</p>
            <p><strong>Color:</strong> {{ $orden->vehiculo->color ?? 'No especificado' }}</p>
        </div>
    </div>

    <!-- Servicios -->
    @if($orden->servicios->count() > 0)
    <div class="section-title">🔧 SERVICIOS REALIZADOS</div>
    <table class="servicios-table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Categoría</th>
                <th class="text-center">Cantidad</th>
                <th class="text-right">Precio Unitario</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orden->servicios as $servicio)
            <tr>
                <td>
                    <strong>{{ $servicio->nombre }}</strong><br>
                    <small>{{ $servicio->descripcion }}</small>
                </td>
                <td>{{ $servicio->categoria }}</td>
                <td class="text-center">{{ $servicio->pivot->cantidad }}</td>
                <td class="text-right money">${{ number_format($servicio->pivot->precio_unitario, 2) }}</td>
                <td class="text-right money">${{ number_format($servicio->pivot->precio_unitario * $servicio->pivot->cantidad, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Piezas -->
    @if($orden->piezas->count() > 0)
    <div class="section-title">🔩 PIEZAS Y REFACCIONES</div>
    <table class="piezas-table">
        <thead>
            <tr>
                <th>Pieza</th>
                <th>Marca</th>
                <th>No. Parte</th>
                <th class="text-center">Cantidad</th>
                <th class="text-right">Precio Unitario</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orden->piezas as $pieza)
            <tr>
                <td>
                    <strong>{{ $pieza->nombre }}</strong><br>
                    <small>{{ $pieza->descripcion }}</small>
                </td>
                <td>{{ $pieza->marca }}</td>
                <td>{{ $pieza->numero_parte }}</td>
                <td class="text-center">{{ $pieza->pivot->cantidad }}</td>
                <td class="text-right money">${{ number_format($pieza->pivot->precio_unitario, 2) }}</td>
                <td class="text-right money">${{ number_format($pieza->pivot->precio_unitario * $pieza->pivot->cantidad, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Totales -->
    <div class="totales">
        <table>
            @if($subtotalServicios > 0)
            <tr>
                <td>Subtotal Servicios:</td>
                <td class="text-right money">${{ number_format($subtotalServicios, 2) }}</td>
            </tr>
            @endif
            @if($subtotalPiezas > 0)
            <tr>
                <td>Subtotal Piezas:</td>
                <td class="text-right money">${{ number_format($subtotalPiezas, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td>Subtotal:</td>
                <td class="text-right money">${{ number_format($subtotal, 2) }}</td>
            </tr>
            <tr>
                <td>IVA (16%):</td>
                <td class="text-right money">${{ number_format($iva, 2) }}</td>
            </tr>
            <tr class="total-final">
                <td>TOTAL:</td>
                <td class="text-right">${{ number_format($total, 2) }} MXN</td>
            </tr>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>¡Gracias por confiar en nuestro servicio!</strong></p>
        <p>Esta factura fue generada electrónicamente el {{ $fechaGeneracion ? $fechaGeneracion->format('d/m/Y H:i:s') : 'N/A' }}</p>
        <p>Para cualquier aclaración o garantía, contacte con nosotros.</p>
        <p style="margin-top: 10px; font-style: italic;">
            "Su satisfacción es nuestra prioridad - Taller Mecánico Profesional"
        </p>
    </div>
</body>
</html>
