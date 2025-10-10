# `iyata-assessment-backend/README.md`

```markdown

## IYATA Evaluación - Backend (Laravel API)

API RESTful desarrollada con **Laravel** que gestiona la autenticación de usuarios mediante tokens así como también 
la gestión completa con CRUD de los usuarios Forma parte del ecosistema de evaluación **IYATA Assessment**, en conjunto 
con el frontend en Vue.js.

---

##  Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/<FourscodeIN>/iyata-assessment-backend.git
cd iyata-assessment-backend

### 2. Instalar dependencias
composer install

### 3. Configurar entorno

cp .env.example .env
php artisan key:generate

Configura tu base de datos MySQL o PostgreSQL en el archivo .env.

### 4. Ejecutar migraciones
php artisan migrate

### 5. Iniciar el servidor
php artisan serve

La API estará disponible en http://127.0.0.1:8000.

Autenticación

El sistema utiliza Laravel Sanctum para el manejo de tokens de autenticación con validación constante del backend y frontend.

Flujo básico:

POST /api/login → Retorna un token si las credenciales son correctas.

GET /api/usuarios → Devuelve la lista de usuarios autenticados (requiere token Bearer).

 Stack Tecnológico

Backend: Laravel 11 (PHP 8+)

Base de datos: MySQL

Autenticación: Laravel Sanctum

ORM: Eloquent

Control de versiones: Git/GitHub

Endpoints principales

Método		     Endpoint				    Descripción				        Autenticación

POST		    /api/login		        Iniciar sesión y obtener token		    ❌
GET			    /api/usuarios		    Listar usuarios registrados			    ✅
