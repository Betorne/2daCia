# 🚒 Sistema de Despacho de Emergencias de Bomberos

Este proyecto es una aplicación web desarrollada en Laravel para la gestión y despacho de emergencias de una compañía de bomberos. Permite registrar emergencias, asignar unidades, visualizar compañías, voluntarios y generar reportes, todo desde una interfaz moderna con Tailwind CSS y gráficos.

---

## ⚙️ Requisitos

- PHP 8.1 o superior  
- Composer  
- Node.js y npm  
- MySQL o MariaDB  
- Laravel 10+

---

## 🚀 Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/TU_USUARIO/2daCia.git
cd 2daCia
```

2. **Instalar dependencias**
```bash
composer install
npm install && npm run build
```

3. **Configurar el entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar base de datos**

Edita `.env` y completa con tus datos:

```
DB_DATABASE=nombre_base
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```

5. **Ejecutar migraciones y seeders**
```bash
php artisan migrate --seed
```

6. **Levantar el servidor**
```bash
php artisan serve
```

Abre en tu navegador: `http://localhost:8000`

---

## 👤 Usuario por defecto (opcional)

Si el seeder incluye un usuario:

```
Email: test@example.com
Contraseña: password
```

---

## 📁 Estructura destacada

- `/app/Models` → modelos como `Emergency`, `Dispatch`, `Unit`
- `/resources/views` → vistas con Tailwind
- `/app/Http/Controllers` → lógica de control
- `/public/storage` → fotos de voluntarios
- `/routes/web.php` → rutas principales

---

## 📊 Librerías destacadas

- Tailwind CSS para diseño
- Chart.js para gráficas
- Preline UI para componentes dinámicos
- Livewire (opcional, si se usa)

---

## 📦 Producción

No olvides configurar:

- `APP_ENV=production`
- Ejecutar `php artisan config:cache`
- Configurar correctamente permisos en `/storage` y `/bootstrap/cache`

---

## 🧑‍🚒 Licencia

Proyecto libre para fines académicos y de servicio comunitario 🚒