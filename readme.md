----------

# Getting started

## Installation

Consulte la guía de instalación oficial de laravel para conocer los requisitos del servidor antes de comenzar. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clonar el repositorio

    git clone https://github.com/kdam97/pruebaNexura

Ingresar a la carpeta del proyecto

    cd pruebaNexura

Instalar las dependencias usando composer

    composer install

Copiar el archivo .env.example  a un nuevo archivo llamado .env

    cp .env.example .env

Ejecutar las migracioens de la base de datos (**Configurar la conexion de la base de datos en el archivo .env antes de las migraciones**)

    php artisan migrate

Ejecutar los seeds de la base de datos (**Estos contienen los registros bases para el funcionamiento como lo son las areas y roles**)

    php artisan db:seed
    
Iniciar el servidor de desarrollo local

    php artisan serve

Ya puedes acceder al servidor local con la siguiente url http://localhost:8000

**TL;DR command list**

    git clone https://github.com/kdam97/pruebaNexura
    cd pruebaNexura
    composer install
    cp .env.example .env
    
**Asegúrese de configurar la información de conexión de la base de datos correcta antes de ejecutar las migraciones** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan db:seed
    php artisan serve

----------

# Code overview

## Folders

- `app` - Contiene todos los modelos de  Eloquent
- `app/Http/Controllers/Api` - Contiene todos los api controllers
- `database/migrations` - Contiene todas las migraciones de la base de datos
- `database/seeds` - Contiene los seeder de la base de datos
- `routes` - Contiene todas las rutas del proyecto

## Environment variables

- `.env` - Las variables de entorno se pueden establecer en este archivo

***Note*** : Puede configurar rápidamente la información de la base de datos y otras variables en este archivo y hacer que la aplicación funcione completamente.

