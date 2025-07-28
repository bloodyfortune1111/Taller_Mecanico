<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos Atendidos por Mes - {{ $año }}</title>
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
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">GearsMotors Taller Mecánico</div>
        <div class="report-title">Reporte de Vehículos Atendidos por Mes</div>
        <div class="report-date">Año: {{ $año }} | Generado el: {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    @if($vehiculosPorMes->count() > 0)
        <div class="summary">
            <div class="summary-title">Resumen Ejecutivo</div>
            <div class="summary-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $vehiculosPorMes->sum('total_vehiculos') }}</div>
                    <div class="stat-label">Total Vehículos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $vehiculosPorMes->sum('total_ordenes') }}</div>
                    <div class="stat-label">Total Órdenes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ number_format($vehiculosPorMes->avg('total_vehiculos'), 1) }}</div>
                    <div class="stat-label">Promedio Mensual</div>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Vehículos Únicos</th>
                    <th>Total Órdenes</th>
                    <th>Promedio Órdenes/Vehículo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehiculosPorMes as $dato)
                <tr>
                    <td>{{ ucfirst($dato->nombre_mes) }}</td>
                    <td>{{ $dato->total_vehiculos }}</td>
                    <td>{{ $dato->total_ordenes }}</td>
                    <td>{{ number_format($dato->total_ordenes / $dato->total_vehiculos, 2) }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td>TOTAL AÑO</td>
                    <td>{{ $vehiculosPorMes->sum('total_vehiculos') }}</td>
                    <td>{{ $vehiculosPorMes->sum('total_ordenes') }}</td>
                    <td>{{ number_format($vehiculosPorMes->sum('total_ordenes') / $vehiculosPorMes->sum('total_vehiculos'), 2) }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 50px;">
            <p>No se encontraron datos para el año {{ $año }}</p>
        </div>
    @endif

    <div class="footer">
        <p>GearsMotors - Sistema de Gestión de Taller Mecánico</p>
        <p>Este reporte fue generado automáticamente el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i') }}</p>
    </div>
</body>
</html>
