# FreshHub

Mini‑supermercado online creado con Laravel y Bootstrap, ejecutado en local (XAMPP + MySQL).

## Requisitos  
- PHP ≥ 8.1, Composer  
- MySQL  
- XAMPP (o similar)  
- Node.js & npm (opcional para assets)

## Instalación rápida  
1. Clona el repositorio y entra en la carpeta  
2. `composer install`  
3. Duplica `.env.example` → `.env` y ajusta tu conexión MySQL  
4. `php artisan key:generate`  
5. `php artisan migrate --seed`  
6. `php artisan storage:link`  
7. `npm install && npm run dev` (opcional)  

## Uso  
Levanta XAMPP y accede en tu navegador a `http://127.0.0.1:8000`.

---

© 2025 FreshHub · Licencia MIT  