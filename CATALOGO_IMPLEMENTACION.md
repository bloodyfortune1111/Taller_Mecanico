# 🔧 Sistema de Catálogo de Servicios y Piezas - Taller Mecánico

## 📋 Resumen de Implementación

Este proyecto implementa un sistema completo de catálogo de servicios y piezas mecánicas para un taller automotriz, con integración a la API de PartsTech para piezas externas.

---

## 🚀 Características Implementadas

### ✅ **1. Catálogo de Servicios**
- **CRUD completo** para servicios del taller
- **Categorización** por tipo de servicio
- **Precios base** configurables
- **Tiempo estimado** de ejecución
- **Sistema de activación/desactivación**
- **Relación muchos-a-muchos** con órdenes de servicio

### ✅ **2. Catálogo de Piezas**
- **CRUD completo** para piezas mecánicas
- **Integración con API PartsTech** para catálogo externo
- **Sistema de disponibilidad** (disponible/agotado/descontinuado)
- **Especificaciones técnicas** en formato JSON
- **Compatibilidad con vehículos**
- **Gestión de proveedores**
- **Importación automática** desde PartsTech

### ✅ **3. Integración API PartsTech**
- **Servicio dedicado** para manejo de API
- **Búsqueda por vehículo** (año, marca, modelo)
- **Búsqueda por categoría**
- **Cache inteligente** para mejorar rendimiento
- **Importación de piezas** al catálogo local
- **Verificación de conectividad**

### ✅ **4. Sistema de Órdenes Mejorado**
- **Cálculo automático** del costo total
- **Integración con servicios y piezas**
- **Tablas pivote** para relaciones muchos-a-muchos
- **Funcionalidad de eliminación** corregida

---

## 🗃️ Estructura de Base de Datos

### Tablas Principales

#### `servicios`
```sql
- id (PK)
- nombre (VARCHAR)
- descripcion (TEXT)
- precio_base (DECIMAL)
- categoria (VARCHAR)
- tiempo_estimado (INT) // minutos
- activo (BOOLEAN)
- timestamps
```

#### `piezas`
```sql
- id (PK)
- numero_parte (VARCHAR) // UNIQUE
- nombre (VARCHAR)
- descripcion (TEXT)
- marca (VARCHAR)
- precio (DECIMAL)
- stock (INT)
- categoria (VARCHAR)
- disponibilidad (ENUM: disponible/agotado/descontinuado)
- vehiculo_compatible (TEXT)
- proveedor (VARCHAR)
- external_id (VARCHAR) // ID de PartsTech
- imagen_url (VARCHAR)
- especificaciones (JSON)
- api_id (VARCHAR)
- api_data (JSON)
- activo (BOOLEAN)
- timestamps
```

### Tablas Pivote

#### `orden_servicio_servicios`
```sql
- id (PK)
- orden_servicio_id (FK)
- servicio_id (FK)
- cantidad (INT)
- precio_unitario (DECIMAL)
- subtotal (DECIMAL)
- timestamps
```

#### `orden_servicio_piezas`
```sql
- id (PK)
- orden_servicio_id (FK)
- pieza_id (FK)
- cantidad (INT)
- precio_unitario (DECIMAL)
- subtotal (DECIMAL)
- timestamps
```

---

## 🛠️ Archivos Creados/Modificados

### **Modelos**
- ✅ `app/Models/Servicio.php` - Modelo de servicios
- ✅ `app/Models/Pieza.php` - Modelo de piezas con integración API
- ✅ `app/Models/OrdenServicio.php` - Método `calcularCostoTotal()`

### **Controladores**
- ✅ `app/Http/Controllers/ServicioController.php` - CRUD completo + API
- ✅ `app/Http/Controllers/PiezaController.php` - CRUD + integración PartsTech
- ✅ `app/Http/Controllers/OrdenServicioController.php` - Corregido método destroy

### **Servicios**
- ✅ `app/Services/PartsTechService.php` - Servicio para API externa

### **Migraciones**
- ✅ `2025_07_01_233942_create_servicios_table.php`
- ✅ `2025_07_01_234023_create_orden_servicio_servicios_table.php`
- ✅ `2025_07_01_234048_create_piezas_table.php`
- ✅ `2025_07_01_234125_create_orden_servicio_piezas_table.php`
- ✅ `2025_07_02_000315_add_partstech_fields_to_piezas_table.php`

### **Seeders**
- ✅ `database/seeders/ServicioSeeder.php` - 10 servicios de ejemplo
- ✅ `database/seeders/PiezaSeeder.php` - 10 piezas de ejemplo

### **Vistas**
- ✅ `resources/views/servicios/index.blade.php` - Lista de servicios
- ✅ `resources/views/servicios/create.blade.php` - Crear servicio
- ✅ `resources/views/piezas/index.blade.php` - Lista de piezas + búsqueda PartsTech
- ✅ `resources/views/piezas/create.blade.php` - Crear pieza

### **Configuración**
- ✅ `config/services.php` - Configuración PartsTech API
- ✅ `.env` - Variables de entorno para API
- ✅ `routes/web.php` - Rutas para catálogos y API

---

## 🔧 Configuración API PartsTech

### Variables de Entorno (.env)
```env
# PartsTech API Configuration
PARTSTECH_BASE_URL=https://api.partstech.com/v1
PARTSTECH_API_KEY=your_partstech_api_key_here
PARTSTECH_TIMEOUT=30
```

### Funcionalidades API
- **Búsqueda por vehículo**: Año, marca, modelo, motor
- **Búsqueda por categoría**: Motor, frenos, suspensión, etc.
- **Importación de piezas**: Agregar al catálogo local
- **Cache inteligente**: 1 hora para búsquedas, 2 horas para detalles
- **Manejo de errores**: Logs detallados y fallbacks

---

## 🎯 Categorías de Piezas Soportadas

```php
'engine' => 'Motor',
'transmission' => 'Transmisión',
'brakes' => 'Frenos',
'suspension' => 'Suspensión',
'electrical' => 'Eléctrico',
'cooling' => 'Refrigeración',
'exhaust' => 'Escape',
'fuel' => 'Combustible',
'interior' => 'Interior',
'exterior' => 'Exterior',
'filters' => 'Filtros',
'oils' => 'Aceites y Fluidos',
'tires' => 'Llantas',
'body' => 'Carrocería'
```

---

## 🚀 Rutas Implementadas

### **Servicios**
```php
GET    /servicios           - Lista de servicios
GET    /servicios/create    - Formulario crear servicio
POST   /servicios           - Guardar servicio
GET    /servicios/{id}      - Ver servicio
GET    /servicios/{id}/edit - Editar servicio
PUT    /servicios/{id}      - Actualizar servicio
DELETE /servicios/{id}      - Eliminar servicio
GET    /api/servicios       - API JSON para AJAX
```

### **Piezas**
```php
GET    /piezas                        - Lista de piezas
GET    /piezas/create                 - Formulario crear pieza
POST   /piezas                        - Guardar pieza
GET    /piezas/{id}                   - Ver pieza
GET    /piezas/{id}/edit              - Editar pieza
PUT    /piezas/{id}                   - Actualizar pieza
DELETE /piezas/{id}                   - Eliminar pieza
GET    /api/piezas                    - API JSON para AJAX
POST   /piezas/search-partstech       - Buscar en PartsTech
POST   /piezas/import-partstech       - Importar de PartsTech
GET    /piezas/test-connection        - Probar conexión API
```

---

## 📊 Datos de Ejemplo

### Servicios Incluidos
- Cambio de aceite (Motor)
- Revisión de frenos (Frenos)
- Alineación y balanceo (Suspensión)
- Cambio de filtros (Mantenimiento)
- Diagnóstico computarizado (Eléctrico)
- Y 5 servicios más...

### Piezas Incluidas
- Pastillas de freno Brembo
- Filtro de aceite Mann-Filter
- Bujías NGK
- Amortiguador Monroe
- Batería Optima
- Y 5 piezas más...

---

## 🔄 Próximos Pasos Pendientes

### **Integración en Órdenes de Servicio**
- [ ] Modificar formulario de órdenes para agregar servicios/piezas
- [ ] Actualización dinámica del costo total
- [ ] Interfaz AJAX para selección de servicios/piezas

### **Mejoras UI/UX**
- [ ] Crear vistas edit/show faltantes para servicios y piezas
- [ ] Mejorar diseño responsivo
- [ ] Agregar filtros avanzados

### **Funcionalidades Avanzadas**
- [ ] Gestión de inventario automática
- [ ] Alertas de stock bajo
- [ ] Historial de precios
- [ ] Reportes de ventas por servicio/pieza

---

## ⚡ Comandos Ejecutados

```bash
# Migraciones
php artisan migrate

# Seeders
php artisan db:seed --class=ServicioSeeder
php artisan db:seed --class=PiezaSeeder

# Cache
php artisan route:clear
php artisan config:clear

# Servidor
php artisan serve
```

---

## 🎉 Estado del Proyecto

✅ **Completado**: Sistema base de catálogos y API PartsTech
✅ **Funcionando**: Eliminación de órdenes de servicio
✅ **Listo**: Para integración en formularios de órdenes

El sistema está listo para usar y puede expandirse según las necesidades del taller. La integración con PartsTech permite acceso a un catálogo extenso de piezas mecánicas, mientras que el sistema local proporciona control total sobre servicios y piezas propias.

---

## 👤 Desarrollado con ❤️ 

Sistema desarrollado para optimizar la gestión de talleres mecánicos con tecnología moderna y APIs externas para un mejor servicio al cliente.
