# Furniture API

## Descripción

Esta API REST permite la gestión completa de muebles, categorías, etiquetas y stock. Proporciona endpoints para **crear, leer, actualizar y eliminar** (CRUD) recursos, con soporte para autenticación mediante **JWT (Bearer Token)**.

La API sigue buenas prácticas de seguridad, validación y estructuración, siguiendo recomendaciones internacionales como **OWASP** y principios de diseño limpio (Clean Architecture) y patrones de diseño comunes en APIs RESTful.

---

## Funcionalidades

* **Autenticación**

  * Registro de usuarios.
  * Inicio de sesión y obtención de JWT.
  * Logout seguro.
* **Gestión de Muebles**

  * Listar todos los muebles con sus categorías y etiquetas.
  * Crear, actualizar y eliminar muebles.
  * Asociar muebles a categorías y etiquetas.
* **Gestión de Categorías**

  * CRUD completo de categorías.
  * Validaciones de nombre único y longitud.
* **Gestión de Etiquetas**

  * CRUD completo de etiquetas.
  * Asociar etiquetas a muebles para filtrado y clasificación.

---

## Tecnologías utilizadas

* **Backend:** PHP 8 / Laravel 11
* **Autenticación:** JWT (JSON Web Token)
* **Documentación API:** Swagger / L5-Swagger
* **Base de datos:** MySQL
* **Gestión de dependencias:** Composer
* **Control de versiones:** Git / GitHub
* **Docker:** Docker y Docker Compose para desarrollo y despliegue

---

## Buenas prácticas y seguridad

* **Validaciones estrictas:**
  Todos los endpoints validan los datos de entrada usando `FormRequest` de Laravel.

* **Seguridad recomendada por OWASP:**

  * Autenticación mediante JWT.
  * Protección de rutas con middleware `auth:api`.
  * Manejo seguro de errores y logging.

* **Documentación estándar OpenAPI 3.0:**

  * Toda la API está documentada usando L5-Swagger.
  * Los endpoints, parámetros y respuestas están claramente definidos.

---

## Patrones de diseño y arquitectura

* **Repositorio (Repository Pattern):**
  Separación de la lógica de acceso a datos (`CategoryRepository`, `FurnitureRepository`, etc.) del controlador.

* **Controller/Service Layer:**
  Los controladores delegan la lógica al repositorio, manteniendo el controlador limpio y enfocado en la respuesta HTTP.

* **Request Validation:**
  Uso de `StoreCategoryRequest` y `UpdateCategoryRequest` para validar entradas y mantener coherencia.

* **RESTful API:**

  * Endpoints diseñados siguiendo convenciones REST:

    * `GET /furniture` → Listar muebles
    * `POST /furniture` → Crear mueble
    * `PUT /furniture/{id}` → Actualizar mueble
    * `DELETE /furniture/{id}` → Eliminar mueble
  * Uso consistente de códigos HTTP: 200, 201, 404, 500.

---

## Estructura de rutas

* `/api/register` → Registro de usuario
* `/api/login` → Login y obtención de JWT
* `/api/logout` → Cerrar sesión
* `/api/furniture` → CRUD de muebles
* `/api/categories` → CRUD de categorías
* `/api/tags` → CRUD de etiquetas

---

## Documentación

* La API está documentada en formato **OpenAPI 3.0** usando **L5-Swagger**.
* La documentación YAML se encuentra en: `docs/api-docs.yaml`
* La interfaz Swagger UI se puede acceder en: `/api/documentation`

---

## Ejecución del proyecto (Dockerizado)

### Levantar el proyecto

1. Asegúrate de tener **Docker** y **Docker Compose** instalados.
2. Desde la carpeta raíz del proyecto (`api-laravel-muebles`), ejecuta:

   ```bash
   docker compose up -d --build
   ```
3. Esto levantará:

   * **Nginx** para servir la aplicación.
   * **PHP-FPM / Laravel** para el backend.
   * **MySQL** como base de datos.

### Acceder a la API

* La API estará disponible en: `http://localhost:8080/api`
* La documentación Swagger UI estará disponible en: `http://localhost:8080/api/documentation`

### Comandos útiles de Docker

* Ver contenedores activos:

  ```bash
  docker ps
  ```
* Reiniciar contenedores:

  ```bash
  docker compose restart
  ```
* Detener contenedores:

  ```bash
  docker compose down
  ```

---

## Ejecución de tests

### Qué hacen los tests

* La API incluye **tests unitarios y funcionales** usando **PHPUnit**, que verifican:

  * Creación, lectura, actualización y eliminación de muebles, categorías y etiquetas.
  * Validaciones de entrada (`FormRequest`) para cada endpoint.
  * Seguridad y manejo de rutas protegidas por JWT.

### Cómo ejecutar los tests

1. Ingresa al contenedor de la aplicación Laravel:

   ```bash
   docker compose exec app bash
   ```
2. Ejecuta los tests con PHPUnit:

   ```bash
   php artisan test
   ```

   o directamente:

   ```bash
   ./vendor/bin/phpunit
   ```
3. Deberías ver un reporte con todos los tests pasados o fallidos.

---

## Consideraciones finales

* Toda la API está construida siguiendo principios de **Clean Architecture** y **SOLID**, manteniendo el código limpio, modular y fácil de mantener.
* Los endpoints y validaciones siguen los lineamientos de **RESTful APIs** y recomendaciones de **OWASP**.
* La documentación Swagger y los tests automatizados aseguran confiabilidad y trazabilidad del desarrollo.

---
