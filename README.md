# `iyata-assessment-backend/README.md`

# IYATA Evaluación - Backend (Laravel API)

API RESTful desarrollada con **Laravel 11** que gestiona la **autenticación de usuarios mediante tokens Sanctum**  
y permite la **gestión completa de usuarios (CRUD)**.  
Forma parte del ecosistema de evaluación **IYATA Assessment**, junto con el frontend en Vue.js.

---

# Instalación

```bash
# Clonar el repositorio
git clone https://github.com/FourscodeIN/iyata-assessment-backend.git
cd iyata-assessment-backend

# Instalar dependencias
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Configura la base de datos MySQL en el archivo .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_usuarios
DB_USERNAME=iyata_user
DB_PASSWORD=iyataPruebaTecnica

# Ejecutar migraciones
php artisan migrate

# Si deseas cargar datos iniciales (usuarios, roles, etc.).
php artisan db:seed

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

# Gestión de Usuarios y Tareas

El backend incluye controladores para manejar tanto usuarios como tareas asociadas a cada usuario.

## Endpoints principales
```markdown
Método	        Endpoint	            Descripción	                        Autenticación
GET	            /api/usuarios	        Listar usuarios con sus tareas	        ✅
POST	        /api/usuarios	        Crear nuevo usuario	                    ✅
PUT	            /api/usuarios/{id}	    Editar usuario existente	            ✅
DELETE	        /api/usuarios/{id}	    Eliminar usuario	                    ✅
GET	            /api/tareas            	Listar tareas con su usuario asociado	✅
POST	        /api/tareas            	Crear nueva tarea	                    ✅
PUT	            /api/tareas/{id}	    Editar tarea	                        ✅
DELETE	        /api/tareas/{id}	    Eliminar tarea	                        ✅
```
## Stack Tecnológico

Framework: Laravel 11 (PHP 8.2+)

Base de datos: MySQL

ORM: Eloquent

Autenticación: Laravel Sanctum

Control de versiones: Git / GitHub

Arquitectura: API RESTful modular con controladores y middleware

## Ejemplo de flujo API (con Axios o Postman)

### Login
```
POST /api/login
{
  "email": "brayan@example.com",
  "password": "123456"
}
```
### Respuesta: 
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
### Listar usuarios
```
GET /api/usuarios
Header: Authorization: Bearer <token>
```
### Listar tareas
```
GET /api/tareas
Authorization: Bearer <token>
```
### Respuesta:
```
[
  {
    "id": 1,
    "titulo": "Revisar reporte",
    "descripcion": "Verificar datos antes del envío",
    "usuario": {
      "id": 2,
      "nombre": "Laura Gómez"
    }
  }
]
```

## Estructura del proyecto
```markdown
app/
 ├── Http/
 │    ├── Controllers/
 │    │     ├── AuthController.php      # Login, logout, registro, validación de token
 │    │     ├── UsuarioController.php   # CRUD de usuarios
 │    │     └── TareaController.php     # CRUD de tareas (asociadas a usuarios)
 │    └── Middleware/
 ├── Models/
 │    ├── Usuario.php                   # Relación hasMany con Tarea
 │    └── Tarea.php                     # Relación belongsTo con Usuario
database/
 ├── migrations/                        # Tablas usuarios y tareas
 └── seeders/
routes/
 └── api.php                            # Rutas principales de la API
```
## Notas Técnicas

> Todos los tokens son renovables y revocables desde el backend.
> Las contraseñas se cifran usando Hash::make().
> Los tokens antiguos se eliminan automáticamente al iniciar una nueva sesión ($usuario->tokens()->delete()).
> Se puede integrar con frontend Vue.js mediante Axios sin withCredentials.
> Relaciones Eloquent optimizadas (with('tareas')).
> Controladores separados y limpios.
> Validaciones de entrada en controladores antes de crear/editar registros.
