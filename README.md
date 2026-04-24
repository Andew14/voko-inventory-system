# VOKO - Sistema de Gestión de Inventarios 📦

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-%2338B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![SQLite Database](https://img.shields.io/badge/Database-SQLite-4479A1?style=for-the-badge&logo=sqlite&logoColor=white)

VOKO es un sistema avanzado de control de inventarios desarrollado para la empresa "KINETARIS". Permite el flujo completo de productos, la gestión del control de stocks mediante validación concurrente, perfiles de seguridad, panel de estadísticas en tiempo real y registro histórico de movimientos de bodegas (Entradas y Salidas).

## 🚀 Requisitos Previos

Asegúrate de tener instalados los siguientes programas en tu entorno:
- **PHP** >= 8.2 (Verifica ejecutando `php -v`)
- **Composer** (Para descargar las librerías de PHP)
- **Git** (Para descargar el repositorio)

---

## 🛠️ Instalación y Configuración para Desarrollo

Sigue estos 6 pasos cuidadosamente para descargar, instalar y ejecutar el repositorio en tu propia PC.

### 1. Clonar el repositorio
Abre tu terminal en la carpeta donde guardas tus proyectos (por ejemplo `htdocs` si usas Xampp) y escribe:
```bash
git clone https://github.com/Andew14/voko-inventory-system.git
cd voko-inventory-system
```

### 2. Instalar dependencias del Backend (Vendor)
Laravel necesita descargar los paquetes base que lo hacen funcionar. Digita:
```bash
composer install
```

### 3. Configurar tu entorno local (.env)
Tenemos un archivo de ejemplo (plantilla) con la estructura segura. Deben hacer una copia para su uso personal y llamarlo `.env`:
- En Windows: `copy .env.example .env`
- En Mac/Linux: `cp .env.example .env`

A continuación, abre ese nuevo archivo `.env` que acabas de crear con tu editor de texto. Por conveniencia, **utilizaremos SQLite** para no tener que configurar MySQL. Asegúrate de modificar la conexión a bases de datos y borrar los demás valores de conexión que venían por default para que quede de la siguiente forma:

```env
DB_CONNECTION=sqlite
# Las siguientes líneas deben quedar completamente vacías, o borrarlas temporalmente:
# DB_HOST=
# DB_PORT=
# DB_DATABASE=
# DB_USERNAME=
# DB_PASSWORD=
```

### 4. Generar la Llave Criptográfica Maestra
Para que los inicios de sesión de los usuarios estén protegidos y encriptados, genera la llave individual de la aplicación corriendo:
```bash
php artisan key:generate
```

### 5. Generar Base de Datos e inyectar Datos de Prueba
Es momento de crear las tablas vacías e inyectaremos tres productos ficticios para poder interactuar junto a dos cuentas listas para logeo:
```bash
php artisan migrate --seed
```
*(Si te pregunta si deseas crear la base de datos sqlite físicamente, pulsa `Y` "Sí")*

### 6. Levantar Sistema
¡Todo listo! Para correr tu servidor web de pruebas, solo digite finalmente:
```bash
php artisan serve
```
El sistema estará en vivo en tu navegador en: `http://127.0.0.1:8000`

---

## 🔒 Credenciales de Acceso Temporales
Si corriste la directriz `--seed` exitosamente en el paso 5, usa estas cuentas automáticas para testear nuestro sistema:

| Rol de Usuario | Email | Contraseña |
| --- | --- | --- |
| **Administrador general** | `admin@voko.com` | `password` |
| **Operador de Bodega** | `operador@voko.com` | `password` |

*(Recuerda que el Administrativo tiene vistas completas y permisos de Borrado al inventario crudo, y el Operativo de Bodega es puramente enfocado al registro transaccional visualizando sus propias adiciones).*

## 🧪 Pruebas Unitarias Aisladas (TDD)
Este repositorio fue refactorizado usando **Metodologías en Base a Pruebas (TDD)** y consta actualmente con ~27 pruebas automatizadas de Calidad en base a la lógica de succión (Race Condition Prevention), Transacciones Atomizadas (`DB::transaction`) y cruce de datos sobre el servicio nativo (`InventoryMovementService`).

Para corroborar a título propio que la red matemática y de negocio funciona impecablemente (y obtener nuestro chequeo de aprobación del QA Engineer), digita en terminal:
```bash
php artisan test
```

---
*Desarrollado con ❤️ por @Andew14 para la Comunidad Académica Laravel.*
