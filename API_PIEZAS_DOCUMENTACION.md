# API de Piezas - Documentación

## Descripción
API REST para gestionar el catálogo de piezas del taller mecánico. Permite listar, buscar, filtrar y obtener estadísticas de las piezas disponibles.

## Endpoints Disponibles

### 1. Listar Todas las Piezas
- **URL**: `/api/piezas-taller/`
- **Método**: `GET`
- **Descripción**: Obtiene todas las piezas disponibles
- **Respuesta**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nombre": "Pastillas de Freno Delanteras",
      "numero_parte": "BRK-001",
      "descripcion": "Pastillas de freno delanteras cerámicas de alta calidad",
      "marca": "Bosch",
      "precio": "85.00",
      "stock": 25,
      "categoria": "Frenos",
      "vehiculo_compatible": "Universal",
      "proveedor": "Bosch México",
      "disponibilidad": "disponible",
      "activo": true
    }
  ],
  "total": 50
}
```

### 2. Buscar Piezas por Texto
- **URL**: `/api/piezas-taller/buscar`
- **Método**: `GET`
- **Parámetros**:
  - `q` (string): Término de búsqueda
- **Ejemplo**: `/api/piezas-taller/buscar?q=filtro`
- **Descripción**: Busca piezas por nombre, descripción o número de parte

### 3. Filtrar por Categoría
- **URL**: `/api/piezas-taller/categoria`
- **Método**: `GET`
- **Parámetros**:
  - `categoria` (string): Categoría a filtrar
- **Ejemplo**: `/api/piezas-taller/categoria?categoria=Motor`
- **Descripción**: Filtra piezas por categoría específica

### 4. Filtrar por Marca
- **URL**: `/api/piezas-taller/marca`
- **Método**: `GET`
- **Parámetros**:
  - `marca` (string): Marca a filtrar
- **Ejemplo**: `/api/piezas-taller/marca?marca=Bosch`
- **Descripción**: Filtra piezas por marca específica

### 5. Obtener Categorías
- **URL**: `/api/piezas-taller/categorias`
- **Método**: `GET`
- **Descripción**: Obtiene todas las categorías disponibles
- **Respuesta**:
```json
{
  "success": true,
  "data": [
    "Motor",
    "Frenos",
    "Suspensión",
    "Transmisión",
    "Eléctrico",
    "Carrocería",
    "Filtros",
    "Lubricantes"
  ]
}
```

### 6. Obtener Marcas
- **URL**: `/api/piezas-taller/marcas`
- **Método**: `GET`
- **Descripción**: Obtiene todas las marcas disponibles
- **Respuesta**:
```json
{
  "success": true,
  "data": [
    "Bosch",
    "Brembo",
    "Valvoline",
    "Monroe",
    "Gates",
    "NGK",
    "Denso"
  ]
}
```

### 7. Obtener Estadísticas
- **URL**: `/api/piezas-taller/estadisticas`
- **Método**: `GET`
- **Descripción**: Obtiene estadísticas del inventario
- **Respuesta**:
```json
{
  "success": true,
  "data": {
    "total_piezas": 50,
    "piezas_disponibles": 42,
    "piezas_agotadas": 8,
    "valor_total_inventario": 12500.00,
    "categorias_count": 8,
    "marcas_count": 7,
    "por_categoria": {
      "Motor": 12,
      "Frenos": 8,
      "Suspensión": 6,
      "Transmisión": 4,
      "Eléctrico": 10,
      "Carrocería": 3,
      "Filtros": 4,
      "Lubricantes": 3
    },
    "por_marca": {
      "Bosch": 15,
      "Brembo": 8,
      "Valvoline": 6,
      "Monroe": 5,
      "Gates": 4,
      "NGK": 7,
      "Denso": 5
    }
  }
}
```

## Integración en el Formulario

### JavaScript para Cargar Piezas
```javascript
// Cargar todas las piezas
async function cargarPiezas() {
    try {
        const response = await fetch('/api/piezas-taller/');
        const data = await response.json();
        
        if (data.success) {
            piezasDisponibles = data.data;
            mostrarPiezas(piezasDisponibles);
        }
    } catch (error) {
        console.error('Error al cargar piezas:', error);
    }
}

// Filtrar por categoría
async function filtrarPiezasPorCategoria() {
    const categoria = document.getElementById('categoria_pieza_filter').value;
    
    try {
        const url = categoria ? 
            `/api/piezas-taller/categoria?categoria=${encodeURIComponent(categoria)}` : 
            '/api/piezas-taller/';
        
        const response = await fetch(url);
        const data = await response.json();
        
        if (data.success) {
            piezasDisponibles = data.data;
            mostrarPiezas(piezasDisponibles);
        }
    } catch (error) {
        console.error('Error al filtrar piezas:', error);
    }
}

// Mostrar piezas en el select
function mostrarPiezas(piezas) {
    const select = document.getElementById('pieza_select');
    select.innerHTML = '<option value="">Seleccione una pieza</option>';
    
    piezas.forEach(pieza => {
        const option = document.createElement('option');
        option.value = pieza.id;
        option.setAttribute('data-precio', pieza.precio);
        option.setAttribute('data-stock', pieza.stock);
        
        const stockText = pieza.stock > 0 ? `(${pieza.stock} disponible)` : '(Sin stock)';
        option.textContent = `${pieza.nombre} - ${pieza.marca} - $${parseFloat(pieza.precio).toFixed(2)} ${stockText}`;
        
        // Deshabilitar si no hay stock
        if (pieza.stock <= 0 || pieza.disponibilidad !== 'disponible') {
            option.disabled = true;
        }
        
        select.appendChild(option);
    });
}
```

### Validaciones Implementadas
- **Control de Stock**: Verifica que haya suficiente stock antes de agregar
- **Disponibilidad**: Solo permite seleccionar piezas disponibles
- **Cantidad**: Valida que no se exceda el stock disponible
- **Duplicados**: Controla que no se agregue la misma pieza múltiples veces

## Características Especiales

### 1. Filtrado Dinámico
- Las piezas se filtran automáticamente por categoría
- El select se actualiza en tiempo real
- Mantiene el estado de la selección

### 2. Información Enriquecida
- Muestra stock disponible en cada opción
- Indica marca y precio
- Deshabilita opciones sin stock

### 3. Validación de Stock
- Verifica stock antes de agregar al carrito
- Controla cantidades máximas
- Actualiza información en tiempo real

### 4. Integración con Órdenes de Servicio
- Se integra completamente con el formulario de órdenes
- Calcula totales automáticamente
- Genera inputs ocultos para envío del formulario

## Archivos Modificados

### Backend
- `app/Http/Controllers/Api/PiezaApiController.php` - Controlador de la API
- `app/Models/Pieza.php` - Modelo de la pieza
- `database/seeders/PiezasSeeder.php` - Datos de ejemplo
- `routes/web.php` - Rutas de la API

### Frontend
- `resources/views/ordenes-servicio/create.blade.php` - Formulario integrado
- `public/test-integracion-piezas.html` - Archivo de pruebas

## Uso en Producción

1. **Inicializar en el formulario**:
```javascript
document.addEventListener('DOMContentLoaded', function() {
    cargarPiezas();
    document.getElementById('categoria_pieza_filter').addEventListener('change', filtrarPiezasPorCategoria);
});
```

2. **Agregar pieza al carrito**:
```javascript
function agregarPieza() {
    const piezaId = document.getElementById('pieza_select').value;
    const cantidad = parseInt(document.getElementById('cantidad_pieza').value);
    
    // Validaciones y lógica de agregado
    // ...
}
```

3. **Envío del formulario**:
```php
// El formulario envía automáticamente los arrays:
// piezas[0][id], piezas[0][cantidad]
// piezas[1][id], piezas[1][cantidad]
// etc.
```

## Próximos Pasos

1. **Integración con PartsTech**: Conectar con API externa para búsqueda ampliada
2. **Historial de Precios**: Implementar seguimiento de cambios de precios
3. **Alertas de Stock**: Notificaciones automáticas cuando el stock es bajo
4. **Imágenes de Piezas**: Añadir soporte para imágenes de las piezas
5. **Compatibilidad Avanzada**: Mejorar el sistema de compatibilidad con vehículos
