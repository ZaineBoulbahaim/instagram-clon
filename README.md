# 📸 Instagram Clone — Laravel 12

Projecte acadèmic desenvolupat amb Laravel 12 que replica les funcionalitats bàsiques d'Instagram: publicació d'imatges, comentaris, likes i gestió de perfil d'usuari.

---

## 🚀 Tecnologies utilitzades

- **Laravel 12** — Framework PHP backend
- **Laravel Breeze** — Autenticació (login, registre)
- **MySQL** — Base de dades relacional
- **Tailwind CSS** — Estils i disseny responsive
- **Vite** — Compilació d'assets (CSS/JS)
- **Blade** — Motor de plantilles Laravel

---

## ✅ Funcionalitats

- Registre i login d'usuaris
- Edició de perfil amb avatar
- Publicació, edició i eliminació d'imatges
- Sistema de likes reactiu (sense recarregar la pàgina)
- Comentaris en imatges pròpies i alienes
- Edició i eliminació de comentaris propis
- Llistat d'imatges paginat (5 per pàgina)
- Modal de confirmació reutilitzable per eliminar
- Protecció de rutes amb middleware d'autenticació

---

## 📋 Requisits previs

Assegura't de tenir instal·lat:

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL
- XAMPP (o qualsevol servidor MySQL)

---

## ⚙️ Instal·lació

### 1. Clonar el repositori
```bash
git clone https://github.com/el-teu-usuari/instagram-clone.git
cd instagram-clone
```

### 2. Instal·lar dependències PHP
```bash
composer install
```

### 3. Instal·lar dependències JavaScript
```bash
npm install
```

### 4. Configurar l'arxiu d'entorn
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurar la base de dades

Obre l'arxiu `.env` i modifica les credencials:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=instagram_clone
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Crear la base de dades

Obre phpMyAdmin o el teu client MySQL i executa:
```sql
CREATE DATABASE instagram_clone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7. Executar les migracions i els seeders
```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

---

## ▶️ Executar l'aplicació

Necessites **dues terminals** obertes simultàniament:

**Terminal 1 — Vite (assets):**
```bash
npm run dev
```

**Terminal 2 — Laravel:**
```bash
php artisan serve
```

Accedeix a l'aplicació a: **http://localhost:8000**

---

## 👤 Usuari de prova

Després d'executar els seeders pots fer login amb:

| Camp | Valor |
|------|-------|
| Email | test@example.com |
| Contrasenya | password |

---
---

## 🗄️ Estructura de la base de dades
users           images          comments        likes
─────────       ──────────      ────────────    ──────────
id              id              id              id
name            user_id (FK)    user_id (FK)    user_id (FK)
surname         image_path      image_id (FK)   image_id (FK)
nick            description     content         created_at
role            created_at      created_at      updated_at
image           updated_at      updated_at
email
password
phone_number
remember_token
created_at
updated_at

---

## 🔐 Seguretat

- Totes les rutes estan protegides amb middleware `auth`
- Tots els formularis inclouen token `@csrf`
- Comprovació de propietat abans d'editar/eliminar (`abort(403)`)
- Validació de tots els camps d'entrada als controladors

---

## 👨‍💻 Autor

Desenvolupat com a projecte acadèmic del cicle formatiu DAW.