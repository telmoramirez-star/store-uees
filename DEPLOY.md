# 🚀 DEPLOY.MD: Despliegue de la Aplicación Laravel (Shopping Car)

Este documento contiene las instrucciones sencillas y directas para levantar la aplicación completamente funcional en tu máquina local usando Docker Compose.

**No necesitas descargar el código fuente de la aplicación, solo este archivo de configuración.**

---

## 📋 Requisitos Previos

Asegúrate de tener instalados los siguientes programas en tu sistema:

1.  **Docker Desktop** (o Docker Engine y Docker Compose).
2.  **Un terminal** (CMD, PowerShell, Bash, etc.).



---

## ⚙️ 1. Preparación y Descarga

1.  **Crea una carpeta vacía** en tu sistema donde desees alojar la aplicación (ej: `mi-proyecto/`).
2.  **Guarda el archivo `docker-compose.yml`** que te proporcionamos dentro de la carpeta **`/deploy/docker-compose.yml`**.

---

## 🐳 2. Despliegue Inicial

Nuestra configuración de Docker Compose se encargará de:
* Descargar la imagen de la Base de Datos (MySQL 8.0).
* Descargar la imagen de la Aplicación Laravel Shopping-Car-UEES (PHP-FPM).
* Descargar la imagen del Servidor Web (NGINX con configuración interna).
* Conectar los tres servicios.
* Ejecutar las migraciones y la siembra de datos (`migrate` y `db:seed`) en la base de datos limpia y efímera.

### Ejecución

Abre tu terminal, navega a la carpeta donde guardaste el archivo (`cd mi-proyecto/`), y ejecuta el siguiente comando:

```bash
docker compose up -d