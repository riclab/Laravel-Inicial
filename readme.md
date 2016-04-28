#Laravel Inicial

Base para iniciar un proyecto con Laravel 5.1 LTS

## Características

- Control de acceso basado en roles (RBAC) :- Permite asignar distintos tipos de accesos a grupos de usuarios.
- Administración de usuarios.
- Registro, ingreso, salida y recuperación de contraseñas.
- Logs de autentificación.
- Integración con ajax de Datatables.
- Multi-idioma.


## Temas
- Integración de Bootstrap y los temas gratuitos de [Bootswatch](http://bootswatch.com/)


## Instalación

1. `git clone https://github.com/riclab/Laravel-Inicial.git`
2. `cd Laravel-Inicial` 
3. `composer install`
4.  Crear base de datos
5. `php artisan app:install`
6. `php artisan migrate --seed`
7. `php artisan serve`

Usuario y contraseña por defecto: admin@example.com / admin


## Personalización (Manejo de assets)

- Instalar nodejs [link](https://github.com/nodesource/distributions#installation-instructions)
- Instalar módulos de nodejs `npm install` 
- Editar el archivo gulpfile.js y cambiar al tema de Bootswatch de su elección [link](http://bootswatch.com/)
- Ejecutar el comando `gulp`
