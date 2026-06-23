# Task Manager

---

Task Manager is a web application that allows users to register and log in to their personal workspace, where they can **create**, **view**, **edit**, and **delete** tasks. Users can also manage their profile by updating their **profile picture** and **password**.

---

## Table of Contents

- [Prerequisites](#prerequisites)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
- [Development](#development)
- [Deployment](#deployment)
- [Resources](#resources)

---

## Prerequisites

Before getting started, make sure you have the following installed:

- **PHP** @8.5 and up
- **MySQL** @8.4 and up
- **Node** @24 and up
- **npm** @11 and up
- **Composer** @2 and up

---

## Tech Stack

- [Laravel](https://laravel.com/) - Back-end framework
- [Blade](https://laravel.com/docs/blade) - Laravel's built-in templating engine
- [Vite](https://vitejs.dev/) - Frontend build tool for bundling JS/CSS assets
- [MySQL](https://www.mysql.com/) - Relational database

---

## Getting Started

Follow these steps carefully to get the project running locally.

**1. Clone the repository:**

```sh
git clone https://github.com/RedberryInternship/giorgi-beshkenadze-task-manager.git
```

**2. Navigate into the project directory:**

```sh
cd giorgi-beshkenadze-task-manager
```

**3. Install PHP dependencies:**

```sh
composer install
```

**4. Install JavaScript dependencies:**

```sh
npm install
```

**5. Create environment file:**

```sh
cp .env.example .env
```

**6. Open `.env` and fill in your database credentials:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=*****
DB_USERNAME=*****
DB_PASSWORD=*****
```

**7. Generate application key:**

```sh
php artisan key:generate
```

**8. Run database migrations:**

```sh
php artisan migrate
```

**9. Create the symbolic link for storage:**

```sh
php artisan storage:link
```

This is required for profile pictures to be publicly accessible.

**10. Build frontend assets:**

```sh
npm run build
```

**11. Start the local development server:**

```sh
php artisan serve
```

You should now be able to open the app in your browser at [http://localhost:8000](http://localhost:8000)

---

## Development

To work on the project locally, you need **two terminal windows** running simultaneously:

**Terminal 1 — Laravel server:**

```sh
php artisan serve
```

**Terminal 2 — Vite dev server (hot reload):**

```sh
npm run dev
```

Vite will watch your JS/CSS files and automatically rebuild them on every change, so you don't need to refresh manually.

---

## Deployment

---

## Resources

- [Figma Design](https://www.figma.com/file/HkL8NHL7914PBgdYb6D3zN/Laravel-Dev?type=design&node-id=0-1&mode=design&t=PcfFZjW8iAKz044P-0) - UI/UX design for the project
- [Database Diagram](https://drawsql.app/teams/giorgi-6/diagrams/task-manager) - Database structure and relationships
- [Laravel Docs](https://laravel.com/docs) - Official Laravel documentation
- [Blade Templates](https://laravel.com/docs/blade) - Laravel Blade templating docs
