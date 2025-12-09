<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Guía de Uso del Sistema

### Roles y Credenciales de Prueba
El sistema cuenta con dos roles principales definidos en los seeders (`DatabaseSeeder`). Las contraseñas por defecto son `password`.

| Rol | Email | Contraseña | Descripción |
| :--- | :--- | :--- | :--- |
| **Administrador** | `admin@store.com` | `password` | Acceso total al sistema. |
| **Cliente** | `client1@store.com` | `password` | Acceso a compras y catálogo. |

### Funcionalidades por Rol

#### 1. Administrador
El usuario administrador tiene control sobre la gestión de la tienda:
*   **Gestión de Usuarios**: Puede ver la lista de usuarios, crear nuevos (incluyendo administradores) y cambiar el estado (Activo/Inactivo) para restringir el acceso.
*   **Gestión de Productos**:
    *   **Crear/Editar**: Puede añadir productos manualmente con nombre, precio, stock y categoría.
    *   **Importación Masiva**: Dispone de una funcionalidad para importar productos desde archivos Excel/CSV. El sistema acepta encabezados tanto en español (`nombre`, `precio`, `categoria`) como en inglés (`name`, `price`, `category`).
*   **Logs del Sistema**: Visualización de actividades críticas, como acciones del carrito o administración.

#### 2. Cliente
El usuario cliente utiliza la plataforma para realizar compras:
*   **Catálogo**: Visualización de productos disponibles con su precio y stock.
*   **Carrito de Compras**:
    *   Agregar productos al carrito.
    *   Ver el resumen de compra con total calculado.
    *   Eliminar productos del carrito.
    *   Contador de ítems en tiempo real en la barra de navegación.

---

## Requisitos Técnicos
```
php: 8.3
node: 22
```

## Instalación y Comandos

1. **Arrancar entorno de desarrollo**:
```bash
composer run dev
```

2. **Ejecutar migraciones y seeders** (para crear las tablas y usuarios por defecto):
```bash
php artisan migrate --seed
```

## Estructura de Proyecto

```
app
    |_Modules
        |_Users
        |_Products
        |_Carts
        |_Logs
```
El proyecto sigue una arquitectura modular. Cada módulo (ej. Users, Products) es autocontenido y posee sus propios:
- **Controllers**
- **Repositories**
- **Services**
- **Requests**
- **Models**

### Convenciones
- **Provider**: `AppServiceProvider` registra los servicios y repositorios de cada módulo para la inyección de dependencias.
- **Nombres**: CamelCase para clases (ej. `ProductService`).

## Recursos Adicionales
- Componentes UI: [HyperUI Toasts](https://www.hyperui.dev/components/application/toasts)
