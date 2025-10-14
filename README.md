# `iyata-assessment-backend/README.md`

# IYATA Evaluación - Backend (Laravel API)

API RESTful desarrollada con **Laravel 11** que gestiona la **autenticación de usuarios mediante tokens Sanctum**  
y permite la **gestión completa de usuarios (CRUD)**.  
Forma parte del ecosistema de evaluación **IYATA Assessment**, junto con el frontend en Vue.js.

---

## Instalación

```bash
# Clonar el repositorio
git clone https://github.com/FourscodeIN/iyata-assessment-backend.git
cd iyata-assessment-backend

# Instalar dependencias
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Configura la base de datos MySQL en el archivo .env.

# Ejecutar migraciones
php artisan migrate

# Iniciar el servidor
php artisan serve
```

La API estará disponible en http://127.0.0.1:8000.

# Autenticación

El sistema utiliza Laravel Sanctum para el manejo de tokens Bearer, garantizando la validación 
constante entre backend y frontend.

## Flujo de autenticación:

POST /api/register → Registra un nuevo usuario.

POST /api/login → Valida credenciales y genera token.

GET /api/validar-token → Verifica si el token sigue siendo válido.

POST /api/logout → Cierra sesión y elimina el token.

# Stack Tecnológico

Framework: Laravel 11 (PHP 8.2+)

Base de datos: MySQL

ORM: Eloquent

Autenticación: Laravel Sanctum

Control de versiones: Git / GitHub

Arquitectura: API RESTful modular con controladores y middleware

# Ejemplo de flujo API (con Axios o Postman)

Login
```
POST /api/login
{
  "email": "brayan@example.com",
  "password": "123456"
}
```
Respuesta: 
```
{
  "usuario": {
    "id": 1,
    "nombre": "Brayan Mesa",
    "email": "brayan@example.com"
  },
  "token": "2|1qN5...",
  "token_type": "Bearer"
}
```
Listar usuarios

GET /api/usuarios
Header: Authorization: Bearer <token>

# Estructura del proyecto

app/
 ├── Http/
 │    ├── Controllers/
 │    │     ├── AuthController.php
 │    │     └── UsuarioController.php
 │    └── Middleware/
 ├── Models/
 │    └── Usuario.php
database/
 ├── migrations/
 └── seeders/
routes/
 └── api.php
 
# Notas Técnicas

Todos los tokens son renovables y revocables desde el backend.
Las contraseñas se cifran usando Hash::make().
Los tokens antiguos se eliminan automáticamente al iniciar una nueva sesión ($usuario->tokens()->delete()).
Se puede integrar con frontend Vue.js mediante Axios sin withCredentials.
