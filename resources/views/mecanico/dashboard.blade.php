@extends('mecanico.layout')

@section('title', 'Dashboard - Panel de Mecánicos')

@section('content')
<style>
    /* === ESTILOS ESPECÍFICOS PARA VISTA DEL MECÁNICO === */
    
    /* Contenedor principal del mecánico */
    .mecanico-dashboard {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 1.5rem;
    }
    
    /* Header del mecánico */
    .mecanico-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px -12px rgba(30, 64, 175, 0.3);
    }
    
    .mecanico-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .mecanico-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    /* Estadísticas mejoradas */
    .mecanico-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .mecanico-stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 1rem;
        border-left: 4px solid #3b82f6;
        transition: all 0.3s ease;
    }
    
    .mecanico-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px -12px rgba(30, 64, 175, 0.25);
    }
    
    .mecanico-stat-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }
    
    .mecanico-stat-icon.blue {
        background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
    }
    
    .mecanico-stat-icon.yellow {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    }
    
    .mecanico-stat-icon.orange {
        background: linear-gradient(135deg, #fb923c 0%, #ea580c 100%);
    }
    
    .mecanico-stat-icon.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    
    .mecanico-stat-info h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e40af;
        margin: 0;
    }
    
    .mecanico-stat-info p {
        color: #6b7280;
        margin: 0;
        font-size: 0.9rem;
    }
    
    /* Órdenes de trabajo mejoradas */
    .mecanico-orders-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 15px 30px -12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .mecanico-orders-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .mecanico-orders-title {
        font-size: 1.4rem;
        font-weight: 600;
        margin: 0;
    }
    
    .mecanico-orders-subtitle {
        opacity: 0.9;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }
    
    .mecanico-order-item {
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .mecanico-order-item:hover {
        background: #f8fafc;
    }
    
    .mecanico-order-item:last-child {
        border-bottom: none;
    }
    
    .mecanico-order-avatar {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .mecanico-order-info {
        flex: 1;
    }
    
    .mecanico-order-title {
        font-weight: 600;
        color: #111827;
        margin-bottom: 0.5rem;
    }
    
    .mecanico-order-details {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    .mecanico-order-time {
        color: #9ca3af;
        font-size: 0.8rem;
    }
    
    .mecanico-order-status {
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-right: 1rem;
    }
    
    .mecanico-status-recibido {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
    }
    
    .mecanico-status-en_proceso {
        background: linear-gradient(135deg, #fb923c 0%, #ea580c 100%);
        color: white;
    }
    
    .mecanico-status-finalizado {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    /* Botones del mecánico */
    .mecanico-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
    }
    
    .mecanico-btn-primary {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
    }
    
    .mecanico-btn-primary:hover {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px -8px rgba(30, 64, 175, 0.3);
    }
    
    /* Estado vacío mejorado */
    .mecanico-empty-state {
        text-align: center;
        padding: 3rem;
        color: #6b7280;
    }
    
    .mecanico-empty-icon {
        width: 4rem;
        height: 4rem;
        margin: 0 auto 1rem;
        color: #d1d5db;
    }
    
    .mecanico-empty-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    
    .mecanico-empty-subtitle {
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }
    
    /* Animaciones */
    @keyframes mecanicoFadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .mecanico-fade-in {
        animation: mecanicoFadeIn 0.8s ease-out;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .mecanico-dashboard {
            padding: 1rem;
        }
        
        .mecanico-stats-grid {
            grid-template-columns: 1fr;
        }
        
        .mecanico-order-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>

<div class="mecanico-dashboard">
    <!-- Header -->
    <div class="mecanico-header mecanico-fade-in">
        <h1 class="mecanico-title">Mi Panel de Trabajo</h1>
        <p class="mecanico-subtitle">
            Bienvenido, {{ Auth::user()->name }}. Aquí tienes tus órdenes de servicio asignadas.
        </p>
    </div>

    <!-- Estadísticas -->
    <div class="mecanico-stats-grid mecanico-fade-in">
        <div class="mecanico-stat-card">
            <div class="mecanico-stat-icon blue">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div class="mecanico-stat-info">
                <h3>{{ $estadisticas['total_asignadas'] }}</h3>
                <p>Total Asignadas</p>
            </div>
        </div>

        <div class="mecanico-stat-card">
            <div class="mecanico-stat-icon yellow">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="mecanico-stat-info">
                <h3>{{ $estadisticas['pendientes'] }}</h3>
                <p>Pendientes</p>
            </div>
        </div>

        <div class="mecanico-stat-card">
            <div class="mecanico-stat-icon orange">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <div class="mecanico-stat-info">
                <h3>{{ $estadisticas['en_proceso'] }}</h3>
                <p>En Proceso</p>
            </div>
        </div>

        <div class="mecanico-stat-card">
            <div class="mecanico-stat-icon green">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="mecanico-stat-info">
                <h3>{{ $estadisticas['finalizadas'] }}</h3>
                <p>Finalizadas</p>
            </div>
        </div>
    </div>

    <!-- Lista de órdenes -->
    <div class="mecanico-orders-container mecanico-fade-in">
        <div class="mecanico-orders-header">
            <h3 class="mecanico-orders-title">Mis Órdenes de Servicio</h3>
            <p class="mecanico-orders-subtitle">Órdenes asignadas a ti</p>
        </div>
        
        @if($ordenesAsignadas->count() > 0)
            @foreach($ordenesAsignadas as $orden)
                <div class="mecanico-order-item">
                    <div style="display: flex; align-items: center; flex: 1;">
                        <div class="mecanico-order-avatar">
                            {{ strtoupper(substr($orden->cliente->nombre, 0, 1)) }}{{ strtoupper(substr($orden->cliente->apellido, 0, 1)) }}
                        </div>
                        <div class="mecanico-order-info">
                            <div class="mecanico-order-title">
                                Orden #{{ $orden->id }} - {{ $orden->cliente->nombre }} {{ $orden->cliente->apellido }}
                            </div>
                            <div class="mecanico-order-details">
                                {{ $orden->vehiculo->marca }} {{ $orden->vehiculo->modelo }} ({{ $orden->vehiculo->matricula }})
                            </div>
                            <div class="mecanico-order-time">
                                Creada: {{ $orden->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <span class="mecanico-order-status mecanico-status-{{ $orden->estado }}">
                            {{ ucfirst(str_replace('_', ' ', $orden->estado)) }}
                        </span>
                        <a href="{{ route('mecanico.orden', $orden->id) }}" class="mecanico-btn mecanico-btn-primary">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="mecanico-empty-state">
                <svg class="mecanico-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="mecanico-empty-title">No hay órdenes asignadas</h3>
                <p class="mecanico-empty-subtitle">Actualmente no tienes órdenes de servicio asignadas.</p>
            </div>
        @endif
    </div>
</div>
@endsection
