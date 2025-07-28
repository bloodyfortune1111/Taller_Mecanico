<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte - Ingresos por Tipo de Servicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
        }
        .info-section {
            margin-bottom: 25px;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .info-item {
            display: table-cell;
            width: 25%;
            padding: 15px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            text-align: center;
        }
        .info-item h3 {
            margin: 0 0 5px 0;
            font-size: 12px;
            color: #64748b;
        }
        .info-item .value {
            font-size: 16px;
            font-weight: bold;
            color: #059669;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f1f5f9;
            font-weight: bold;
            color: #374151;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .text-green { color: #059669; }
        .rentabilidad-alta { 
            background-color: #dcfce7; 
            color: #166534; 
            padding: 2px 6px; 
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .rentabilidad-media { 
            background-color: #fef3c7; 
            color: #92400e; 
            padding: 2px 6px; 
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .rentabilidad-baja { 
            background-color: #fee2e2; 
            color: #991b1b; 
            padding: 2px 6px; 
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Taller Mecánico</h1>
        <h2>Reporte de Ingresos por Tipo de Servicio</h2>
        <p>
            Período: 
            @if(request('mes'))
                {{ \Carbon\Carbon::create()->month(request('mes'))->translatedFormat('F') }} {{ request('year', date('Y')) }}
            @else
                {{ request('year', date('Y')) }}
            @endif
        </p>
        <p>Generado el: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info-section">
        <h3>Resumen Ejecutivo</h3>
        <div class="info-grid">
            <div class="info-item">
                <h3>Total Ingresos</h3>
                <div class="value">${{ number_format($ingresos->sum('total_ingresos'), 0, ',', '.') }}</div>
            </div>
            <div class="info-item">
                <h3>Tipos de Servicios</h3>
                <div class="value">{{ $ingresos->count() }}</div>
            </div>
            <div class="info-item">
                <h3>Más Rentable</h3>
                <div class="value" style="font-size: 12px;">
                    @if($ingresos->isNotEmpty())
                        {{ Str::limit($ingresos->sortByDesc('total_ingresos')->first()->tipo_servicio, 15) }}
                    @else
                        Sin datos
                    @endif
                </div>
            </div>
            <div class="info-item">
                <h3>Precio Promedio</h3>
                <div class="value">${{ number_format($ingresos->avg('precio_promedio'), 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <h3>Análisis Detallado por Tipo de Servicio</h3>
        
        @if($ingresos->isEmpty())
            <div class="no-data">
                <p>No hay datos de servicios disponibles para el período seleccionado</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Tipo de Servicio</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-right">Total Ingresos</th>
                        <th class="text-right">Precio Promedio</th>
                        <th class="text-center">% del Total</th>
                        <th class="text-center">Rentabilidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingresos->sortByDesc('total_ingresos') as $ingreso)
                        <tr>
                            <td class="font-bold">{{ $ingreso->tipo_servicio }}</td>
                            <td class="text-center">{{ $ingreso->cantidad }}</td>
                            <td class="text-right text-green font-bold">${{ number_format($ingreso->total_ingresos, 0, ',', '.') }}</td>
                            <td class="text-right">${{ number_format($ingreso->precio_promedio, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @php
                                    $porcentaje = $ingresos->sum('total_ingresos') > 0 ? ($ingreso->total_ingresos / $ingresos->sum('total_ingresos')) * 100 : 0;
                                @endphp
                                {{ number_format($porcentaje, 1) }}%
                            </td>
                            <td class="text-center">
                                @if($porcentaje >= 20)
                                    <span class="rentabilidad-alta">Alta</span>
                                @elseif($porcentaje >= 10)
                                    <span class="rentabilidad-media">Media</span>
                                @else
                                    <span class="rentabilidad-baja">Baja</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #e2e8f0; font-weight: bold;">
                        <td>TOTAL</td>
                        <td class="text-center">{{ $ingresos->sum('cantidad') }}</td>
                        <td class="text-right text-green">${{ number_format($ingresos->sum('total_ingresos'), 0, ',', '.') }}</td>
                        <td class="text-right">${{ number_format($ingresos->avg('precio_promedio'), 0, ',', '.') }}</td>
                        <td class="text-center">100%</td>
                        <td class="text-center">-</td>
                    </tr>
                </tfoot>
            </table>

            <div style="margin-top: 20px;">
                <h4>Análisis de Rentabilidad</h4>
                @php
                    $serviciosAlta = $ingresos->filter(function($item) use ($ingresos) {
                        $porcentaje = $ingresos->sum('total_ingresos') > 0 ? ($item->total_ingresos / $ingresos->sum('total_ingresos')) * 100 : 0;
                        return $porcentaje >= 20;
                    });
                    $serviciosMedia = $ingresos->filter(function($item) use ($ingresos) {
                        $porcentaje = $ingresos->sum('total_ingresos') > 0 ? ($item->total_ingresos / $ingresos->sum('total_ingresos')) * 100 : 0;
                        return $porcentaje >= 10 && $porcentaje < 20;
                    });
                    $serviciosBaja = $ingresos->filter(function($item) use ($ingresos) {
                        $porcentaje = $ingresos->sum('total_ingresos') > 0 ? ($item->total_ingresos / $ingresos->sum('total_ingresos')) * 100 : 0;
                        return $porcentaje < 10;
                    });
                @endphp
                
                <ul>
                    <li><strong>Servicios de alta rentabilidad (≥20%):</strong> {{ $serviciosAlta->count() }} tipos</li>
                    <li><strong>Servicios de rentabilidad media (10-19%):</strong> {{ $serviciosMedia->count() }} tipos</li>
                    <li><strong>Servicios de baja rentabilidad (＜10%):</strong> {{ $serviciosBaja->count() }} tipos</li>
                </ul>

                @if($ingresos->count() > 1)
                    @php
                        $masRentable = $ingresos->sortByDesc('total_ingresos')->first();
                        $menosRentable = $ingresos->sortBy('total_ingresos')->first();
                    @endphp
                    <ul>
                        <li><strong>Servicio más rentable:</strong> {{ $masRentable->tipo_servicio }} - ${{ number_format($masRentable->total_ingresos, 0, ',', '.') }}</li>
                        <li><strong>Servicio menos rentable:</strong> {{ $menosRentable->tipo_servicio }} - ${{ number_format($menosRentable->total_ingresos, 0, ',', '.') }}</li>
                        <li><strong>Diferencia de ingresos:</strong> ${{ number_format($masRentable->total_ingresos - $menosRentable->total_ingresos, 0, ',', '.') }}</li>
                    </ul>
                @endif
            </div>

            <div style="margin-top: 15px;">
                <h4>Recomendaciones</h4>
                <ul style="font-size: 11px;">
                    @if($serviciosAlta->count() > 0)
                        <li>Potenciar los servicios de alta rentabilidad mediante promociones y mejora en la calidad.</li>
                    @endif
                    @if($serviciosBaja->count() > 0)
                        <li>Revisar precios y procesos de los servicios de baja rentabilidad.</li>
                    @endif
                    <li>Analizar la demanda estacional para optimizar la oferta de servicios.</li>
                    <li>Considerar la capacitación del personal en los servicios más rentables.</li>
                </ul>
            </div>
        @endif
    </div>

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Gestión del Taller Mecánico</p>
        <p>{{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
