# API de Servicios del Taller Mecánico

## Descripción
Esta API propia permite gestionar y consultar los servicios que ofrece el taller mecánico. Está integrada en el formulario de creación de órdenes de servicio para mostrar dinámicamente los servicios disponibles.

## Endpoints Disponibles

### 1. Obtener Todos los Servicios
- **URL**: `/api/servicios-taller/`
- **Método**: GET
- **Descripción**: Obtiene todos los servicios activos disponibles

**Respuesta de ejemplo:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nombre": "Cambio de Aceite",
      "descripcion": "Cambio de aceite del motor con filtro incluido",
      "precio": "45.00",
      "duracion_estimada": 30,
      "categoria": "Mantenimiento Preventivo"
    }
  ],
  "message": "Servicios obtenidos exitosamente"
}
```

### 2. Filtrar por Categoría
- **URL**: `/api/servicios-taller/categoria?categoria=NOMBRE_CATEGORIA`
- **Método**: GET
- **Parámetros**:
  - `categoria`: Nombre de la categoría (opcional)

**Categorías disponibles:**
- Mantenimiento Preventivo
- Mantenimiento Mayor
- Reparación
- Diagnóstico

### 3. Buscar Servicios
- **URL**: `/api/servicios-taller/buscar?q=TERMINO_BUSQUEDA`
- **Método**: GET
- **Parámetros**:
  - `q`: Término de búsqueda (requerido)

**Ejemplo:**
```
/api/servicios-taller/buscar?q=aceite
```

### 4. Servicios Recomendados
- **URL**: `/api/servicios-taller/recomendados?tipo_vehiculo=TIPO&kilometraje=KM`
- **Método**: GET
- **Parámetros**:
  - `tipo_vehiculo`: Tipo de vehículo (opcional)
  - `kilometraje`: Kilometraje del vehículo (opcional)

**Lógica de recomendación:**
- Más de 100,000 km: Mantenimiento Mayor y Reparación
- Entre 50,000-100,000 km: Mantenimiento Preventivo y Mayor
- Menos de 50,000 km: Mantenimiento Preventivo

### 5. Obtener Servicio Específico
- **URL**: `/api/servicios-taller/{id}`
- **Método**: GET
- **Parámetros**:
  - `id`: ID del servicio

### 6. Estadísticas
- **URL**: `/api/servicios-taller/estadisticas`
- **Método**: GET
- **Descripción**: Obtiene estadísticas generales de los servicios

## Integración en el Formulario

### Características Implementadas

1. **Carga Automática**: Los servicios se cargan automáticamente al abrir el formulario
2. **Búsqueda en Tiempo Real**: El usuario puede buscar servicios mientras escribe
3. **Filtrado por Categoría**: Dropdown para filtrar por categoría de servicio
4. **Servicios Recomendados**: Botón para cargar servicios recomendados basados en el vehículo
5. **Información Detallada**: Muestra nombre, precio y categoría de cada servicio

### Funciones JavaScript

- `cargarServicios()`: Carga todos los servicios disponibles
- `buscarServicios()`: Busca servicios por término de búsqueda
- `filtrarPorCategoria()`: Filtra servicios por categoría
- `cargarRecomendados()`: Carga servicios recomendados
- `mostrarServicios()`: Actualiza el select con los servicios
- `agregarServicio()`: Agrega un servicio a la orden

## Datos de Ejemplo

La API incluye 16 servicios de ejemplo distribuidos en 4 categorías:

### Mantenimiento Preventivo
- Cambio de Aceite ($45.00)
- Rotación de Llantas ($25.00)
- Revisión General ($65.00)
- Cambio de Filtro de Aire ($20.00)
- Alineación y Balanceo ($55.00)
- Cambio de Bujías ($35.00)

### Mantenimiento Mayor
- Cambio de Timing Belt ($450.00)
- Cambio de Embrague ($650.00)
- Overhaul de Motor ($2,500.00)

### Reparación
- Reparación de Frenos ($180.00)
- Reparación de Suspensión ($320.00)
- Reparación de Transmisión ($850.00)
- Reparación de Aire Acondicionado ($125.00)

### Diagnóstico
- Diagnóstico Computarizado ($75.00)
- Diagnóstico de Motor ($95.00)
- Diagnóstico Eléctrico ($85.00)

## Pruebas

Para probar la API, puedes usar:

1. **Archivo de prueba**: `http://localhost:8001/test-api.html`
2. **Formulario de orden**: `http://localhost:8001/ordenes-servicio/create`
3. **Herramientas como Postman** para llamadas directas a los endpoints

## Estructura de Archivos

```
app/
├── Http/Controllers/Api/
│   └── ServicioApiController.php
├── Models/
│   └── Servicio.php
database/
├── migrations/
│   └── 2025_07_12_193459_create_servicios_table.php
├── seeders/
│   └── ServiciosSeeder.php
routes/
└── web.php (contiene las rutas de la API)
resources/views/ordenes-servicio/
└── create.blade.php (formulario integrado)
```

## Próximos Pasos

1. **Validación Visual**: Verificar que los servicios se muestren correctamente
2. **Mejoras UX**: Agregar indicadores de carga y mejor manejo de errores
3. **Optimización**: Implementar cache para mejorar performance
4. **Expansion**: Agregar más campos como imágenes de servicios, descripciones extendidas, etc.
