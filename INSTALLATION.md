# Guía de Instalación y Despliegue

Este documento detalla los requisitos técnicos y los pasos necesarios para levantar el sistema en un entorno local o de producción.

## Requisitos del Sistema

Para ejecutar correctamente la aplicación, asegúrese de que su servidor cumpla con los siguientes requisitos:

- **PHP**: Versión 8.2 o superior (Recomendado 8.3).
- **Composer**: Gestor de dependencias de PHP.
- **Node.js**: Versión 22 o superior (para compilación de assets).
- **Base de Datos**: MySQL, MariaDB, PostgreSQL o SQLite.

### Extensiones de PHP Requeridas
El framework Laravel y el módulo de Excel requieren las siguientes extensiones habilitadas en `php.ini`:

- `bcmath`
- `ctype`
- `fileinfo`
- `json`
- `mbstring`
- `openssl`
- `pdo`
- `tokenizer`
- `xml`
- `gd` o `imagick` (para manipulación de imágenes si fuera necesario)
- `zip` (fundamental para Laravel Excel)

---

## Proceso de Instalación Paso a Paso

### 1. Clonar el Repositorio
Obtenga el código fuente del proyecto:
```bash
git clone https://github.com/telmoramirez-star/store-uees.git
cd store-uees
```

### 2. Instalar Dependencias de PHP
Ejecute el siguiente comando para instalar las librerías del backend:
```bash
composer install
```
> **Nota**: Si está en producción, añada la bandera `--no-dev` para optimizar.

### 3. Configurar el Entorno (.env)
Copie el archivo de ejemplo y configure sus variables de entorno:
```bash
cp .env.example .env
```
Abra el archivo `.env` y configure la conexión a la base de datos:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

### 4. Generar la Clave de Aplicación
```bash
php artisan key:generate
```

### 5. Instalar Dependencias de Frontend
Instale las librerías de JavaScript y compile los estilos/scripts:
```bash
npm install
npm run build
```
> Para desarrollo activo (hot reload), use `npm run dev` en una terminal separada.

### 6. Migraciones y Seeders
Ejecute las migraciones para crear la estructura de la base de datos e insertar los datos de prueba (incluyendo usuarios admin y clientes):
```bash
php artisan migrate --seed
```

---

## Comandos Útiles

| Acción | Comando |
| :--- | :--- |
| **Limpiar Caché** | `php artisan optimize:clear` |
| **Crear Enlace Simbólico (Storage)** | `php artisan storage:link` |
| **Correr Tests** | `php artisan test` |
| **Servidor de Desarrollo** | `php artisan serve` |

## Solución de Problemas Comunes

- **Error 500 o Pantalla Blanca**: Verifique los permisos de las carpetas `storage` y `bootstrap/cache`. Deben tener permisos de escritura.
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```
- **Error "File not found" al subir Excel**: Asegúrese de que la carpeta temporal de subida de PHP esté configurada correctamente o aumente `upload_max_filesize` en `php.ini` si el archivo es muy grande.
