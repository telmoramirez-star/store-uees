<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Requisitos
```
php: 8.3
node: 22
```
## Comandos
Para arrancar la aplicación
```
composer run dev
```

Para correr las migraciones
```bash
php artisan migrate
```

## Estructura de proyecto

```
app
    |_Modules
        |_Users
            |_Controllers
            |_Repositories
            |_Requests
            |_Services
```
En la carpeta **Moudules** se encuentran todo los modules que se realizan.

Cada modulo tendra por estructuras las carpetas **Controller**, **Repositories**, **Requests** y **Services**.

Considerar:

- Los nombres de los archivos van en CamelCase
- Siempre tienen que mencionar al modulo: UserController, UserRepository, etc

## Importante

En esta ruta se deben registrar los Services y Repository

```
app
    |_Providers
        |_AppServiceProvider.php
```
Ejemplo:

```php
<?php

namespace App\Providers;

use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aqui registramos los servicios y repositorios
        $this->app->singleton(UserRepository::class);
        $this->app->singleton(UserService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

```
## Recursos

### Diseño de componentes
- https://www.hyperui.dev/components/application/toasts
