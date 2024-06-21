# Proyecto GDA - API's

Este proyecto implementa tres servicios RESTful en Laravel para gestionar clientes (Customers), incluyendo autenticación, registro, consulta y eliminación.

## Requisitos

- PHP >= 7.4
- Composer
- MySQL
- Laravel (última versión)

## Instalación

1. Clona el repositorio:

   git clone https://github.com/tu_usuario/gda_lab.git
   
   cd gda_lab
   
3. Instalar Dependencias:

    composer update
    npm update

4. Configurar Variables de Entorno:

    Crear un archivo .env con las variables de entorno necesarias (localhost y base de datos)

## Uso
1. Autenticación
   
   Login

    Endpoint: POST /login

    Parámetros:
   
       {
        "email": "usuario@example.com",
        "password": "contraseña"
       }

   Respuesta:
   
       {
        "success": true,
        "token": "token_generado"
       }

3. Gestión de Customers

   Registrar Customer

   Endpoint: POST / ustomer
    
   Parámetros:

       {
        "dni": "",
        "email": "",
        "name": "",
        "last_name": "",
        "address": "",
        "region_id": "",
        "commune_id": '"
       }

   Encabezado de Autenticación:

       Authorization: Bearer "token_generado"

   Respuesta:

       {
        "success": true,
        "customer": {
            "id": 1,
            "name": "Nombre",
            "last_name": "Apellido",
            "dni": "12345678",
            "email": "correo@example.com",
            "address": "Dirección opcional",
            "commune": "Comuna",
            "region": "Región",
            "status": "A",
            "created_at": "fecha",
            "updated_at": "fecha"
            }
        }

   Consultar Customer
   
   Endpoint: GET /customer

   Parámetros:

        {
        "dni": "12345678",
        "email": "correo@example.com"
        }

   Encabezado de Autenticación:

       Authorization: Bearer "token_generado"

   Respuesta:

       {
        "success": true,
        "customer": {
            "id": 1,
            "name": "Nombre",
            "last_name": "Apellido",
            "dni": "12345678",
            "email": "correo@example.com",
            "address": "Dirección opcional",
            "commune": "Comuna",
            "region": "Región",
            "status": "A",
            "created_at": "fecha",
            "updated_at": "fecha"
            }
        }

    Eliminar Customer

    Endpoint: DELETE /customer
    
    Parámetros:

       {
       "dni": 1
       }

   Encabezado de Autenticación:

       Authorization: Bearer "token_generado"

   Respuesta:

       {
       "success": true,
       "message": "Customer eliminado"
        }


Middleware

    AuthTokenMiddleware: Middleware para validar el token de autenticación en cada solicitud.
    LogMiddleware: Middleware para registrar logs de entrada y salida de información, configurable mediante la variable de entorno APP_ENV.
    
Logs

    El proyecto registra logs de entrada y salida de información. Si el parámetro APP_ENV en el archivo .env se establece en production, solo se registrarán los logs de entrada.

Seguridad

    Protección contra inyección SQL utilizando Eloquent ORM y validaciones.
    Token de autenticación generado con SHA1 y validación de expiración.

