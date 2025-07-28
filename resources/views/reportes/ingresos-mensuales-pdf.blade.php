<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte - Ingresos Mensuales {{ request('year', date('Y')) }}</title>
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
            width: 33.33%;
            padding: 15px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            text-align: center;
        }
        .info-item h3 {
            margin: 0 0 5px 0;
            font-size: 14px;
            color: #64748b;
        }
        .info-item .value {
            font-size: 18px;
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
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .text-green { color: #059669; }
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
        <h2>Reporte de Ingresos Mensuales</h2>
        <p>Año: {{ request('year', date('Y')) }}</p>
        <p>Generado el: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info-section">
        <h3>Resumen Ejecutivo</h3>
        <div class="info-grid">
            <div class="info-item">
                <h3>Total Anual</h3>
                <div class="value">${{ number_format($ingresos->sum('total'), 0, ',', '.') }}</div>
            </div>
            <div class="info-item">
                <h3>Promedio Mensual</h3>
                <div class="value">${{ number_format($ingresos->avg('total'), 0, ',', '.') }}</div>
            </div>
            <div class="info-item">
                <h3>Mejor Mes</h3>
                <div class="value">
                    @if($ingresos->isNotEmpty())
                        {{ $ingresos->sortByDesc('total')->first()->mes_nombre }}
                    @else
                        Sin datos
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="table-container">
        <h3>Detalle de Ingresos por Mes</h3>
        
        @if($ingresos->isEmpty())
            <div class="no-data">
                <p>No hay datos de ingresos disponibles para el año {{ request('year', date('Y')) }}</p>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th class="text-center">Órdenes Completadas</th>
                        <th class="text-right">Total Ingresos</th>
                        <th class="text-right">Promedio por Orden</th>
                        <th class="text-center">% del Total Anual</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingresos as $ingreso)
                        <tr>
                            <td class="font-bold">{{ $ingreso->mes_nombre }}</td>
                            <td class="text-center">{{ $ingreso->ordenes_completadas }}</td>
                            <td class="text-right text-green font-bold">${{ number_format($ingreso->total, 0, ',', '.') }}</td>
                            <td class="text-right">${{ number_format($ingreso->promedio_por_orden, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @php
                                    $porcentaje = $ingresos->sum('total') > 0 ? ($ingreso->total / $ingresos->sum('total')) * 100 : 0;
                                @endphp
                                {{ number_format($porcentaje, 1) }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #e2e8f0; font-weight: bold;">
                        <td>TOTAL</td>
                        <td class="text-center">{{ $ingresos->sum('ordenes_completadas') }}</td>
                        <td class="text-right text-green">${{ number_format($ingresos->sum('total'), 0, ',', '.') }}</td>
                        <td class="text-right">${{ number_format($ingresos->avg('promedio_por_orden'), 0, ',', '.') }}</td>
                        <td class="text-center">100%</td>
                    </tr>
                </tfoot>
            </table>

            <div style="margin-top: 20px;">
                <h4>Análisis de Tendencias</h4>
                <ul>
                    @if($ingresos->count() > 1)
                        @php
                            $mejorMes = $ingresos->sortByDesc('total')->first();
                            $peorMes = $ingresos->sortBy('total')->first();
                        @endphp
                        <li><strong>Mes con mayores ingresos:</strong> {{ $mejorMes->mes_nombre }} con ${{ number_format($mejorMes->total, 0, ',', '.') }}</li>
                        <li><strong>Mes con menores ingresos:</strong> {{ $peorMes->mes_nombre }} con ${{ number_format($peorMes->total, 0, ',', '.') }}</li>
                        <li><strong>Diferencia entre mejor y peor mes:</strong> ${{ number_format($mejorMes->total - $peorMes->total, 0, ',', '.') }}</li>
                    @endif
                    <li><strong>Total de órdenes completadas en el año:</strong> {{ $ingresos->sum('ordenes_completadas') }}</li>
                    <li><strong>Valor promedio por orden:</strong> ${{ number_format($ingresos->avg('promedio_por_orden'), 0, ',', '.') }}</li>
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
