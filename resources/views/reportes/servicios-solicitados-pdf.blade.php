<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios Más Solicitados - {{ $fechaInicio }} al {{ $fechaFin }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 5px;
        }
        .report-title {
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
        }
        .report-date {
            font-size: 12px;
            color: #888;
        }
        .summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .summary-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .summary-stats {
            display: flex;
            justify-content: space-between;
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .position-cell {
            text-align: center;
            font-weight: bold;
        }
        .first-place {
            color: #fbbf24;
        }
        .second-place {
            color: #6b7280;
        }
        .third-place {
            color: #f97316;
        }
        .total-row {
            background-color: #e3f2fd !important;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .category-badge {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">GearsMotors Taller Mecánico</div>
        <div class="report-title">Reporte de Servicios Más Solicitados</div>
        <div class="report-date">Período: {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }} | Generado el: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    @if($serviciosSolicitados->count() > 0)
        <div class="summary">
            <div class="summary-title">Resumen Ejecutivo</div>
            <div class="summary-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $serviciosSolicitados->count() }}</div>
                    <div class="stat-label">Servicios Diferentes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $serviciosSolicitados->sum('total_solicitudes') }}</div>
                    <div class="stat-label">Total Solicitudes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">${{ number_format($serviciosSolicitados->sum('ingresos_totales'), 0) }}</div>
                    <div class="stat-label">Ingresos Totales</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">${{ number_format($serviciosSolicitados->avg('precio_base'), 0) }}</div>
                    <div class="stat-label">Precio Promedio</div>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Posición</th>
                    <th>Servicio</th>
                    <th>Categoría</th>
                    <th>Solicitudes</th>
                    <th>Precio Base</th>
                    <th>Ingresos Totales</th>
                    <th>% del Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalIngresos = $serviciosSolicitados->sum('ingresos_totales');
                @endphp
                @foreach($serviciosSolicitados as $index => $servicio)
                <tr>
                    <td class="position-cell {{ $index == 0 ? 'first-place' : ($index == 1 ? 'second-place' : ($index == 2 ? 'third-place' : '')) }}">
                        @if($index == 0)
                            🏆 1°
                        @elseif($index == 1)
                            🥈 2°
                        @elseif($index == 2)
                            🥉 3°
                        @else
                            {{ $index + 1 }}°
                        @endif
                    </td>
                    <td>{{ $servicio->nombre }}</td>
                    <td>
                        <span class="category-badge">{{ $servicio->categoria }}</span>
                    </td>
                    <td style="text-align: center; font-weight: bold; color: #059669;">
                        {{ $servicio->total_solicitudes }}
                    </td>
                    <td style="text-align: right;">
                        ${{ number_format($servicio->precio_base, 2) }}
                    </td>
                    <td style="text-align: right; font-weight: bold; color: #2563eb;">
                        ${{ number_format($servicio->ingresos_totales, 2) }}
                    </td>
                    <td style="text-align: center;">
                        {{ number_format(($servicio->ingresos_totales / $totalIngresos) * 100, 1) }}%
                    </td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3">TOTALES</td>
                    <td style="text-align: center;">{{ $serviciosSolicitados->sum('total_solicitudes') }}</td>
                    <td style="text-align: right;">${{ number_format($serviciosSolicitados->avg('precio_base'), 2) }}</td>
                    <td style="text-align: right;">${{ number_format($serviciosSolicitados->sum('ingresos_totales'), 2) }}</td>
                    <td style="text-align: center;">100.0%</td>
                </tr>
            </tbody>
        </table>

        @if($serviciosSolicitados->count() >= 3)
        <div style="margin-top: 30px; padding: 15px; background-color: #f0f9ff; border-radius: 5px;">
            <h3 style="color: #0369a1; margin-bottom: 10px;">🏆 Top 3 Servicios Más Solicitados</h3>
            <ol style="margin: 0; padding-left: 20px;">
                @foreach($serviciosSolicitados->take(3) as $servicio)
                <li style="margin-bottom: 5px;">
                    <strong>{{ $servicio->nombre }}</strong> - {{ $servicio->total_solicitudes }} solicitudes 
                    ({{ number_format(($servicio->ingresos_totales / $totalIngresos) * 100, 1) }}% de ingresos)
                </li>
                @endforeach
            </ol>
        </div>
        @endif

        @if($serviciosSolicitados->count() > 0)
        <div style="margin-top: 20px; padding: 15px; background-color: #f8fafc; border-radius: 5px;">
            <h3 style="color: #374151; margin-bottom: 10px;">📊 Análisis por Categorías</h3>
            @php
                $categorias = $serviciosSolicitados->groupBy('categoria');
            @endphp
            <table style="width: 100%; margin-top: 10px;">
                <thead>
                    <tr style="background-color: #e5e7eb;">
                        <th>Categoría</th>
                        <th>Servicios</th>
                        <th>Solicitudes</th>
                        <th>Ingresos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria => $servicios)
                    <tr>
                        <td><span class="category-badge">{{ $categoria }}</span></td>
                        <td style="text-align: center;">{{ $servicios->count() }}</td>
                        <td style="text-align: center;">{{ $servicios->sum('total_solicitudes') }}</td>
                        <td style="text-align: right;">${{ number_format($servicios->sum('ingresos_totales'), 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    @else
        <div style="text-align: center; padding: 50px;">
            <p>No se encontraron servicios solicitados en el período seleccionado.</p>
            <p style="color: #666; font-size: 14px;">Período: {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}</p>
        </div>
    @endif

    <div class="footer">
        <p>GearsMotors - Sistema de Gestión de Taller Mecánico</p>
        <p>Este reporte fue generado automáticamente el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i') }}</p>
    </div>
</body>
</html>
