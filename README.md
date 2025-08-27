<p align="center">
  <img src="https://res.cloudinary.com/dgy9djne0/image/upload/v1756300082/logo-cropped_vjmkfm.svg" alt="Writehub Logo" />
</p>

<p align="center">
  <a href="https://github.com/holasoymas/writehub/actions/workflows/deploy.yaml">
    <img src="https://github.com/holasoymas/writehub/actions/workflows/deploy.yaml/badge.svg" alt="CI" />
  </a>
  <a href="https://www.php.net/">
    <img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP" />
  </a>
  <a href="https://laravel.com/">
    <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel" />
  </a>
  <a href="https://github.com/holasoymas/writehub/blob/main/LICENSE">
    <img src="https://img.shields.io/badge/License-MIT-green" alt="License" />
  </a>
</p>

## 📖 Project Overview
**WriteHub** is a Medium-like blogging platform built with Laravel. Users can create blogs, like and comment on posts, and interact with other bloggers. Admins can manage content and users.  

---

## 🛠 Features

- User authentication (login/register)  
- Create, edit, delete blogs  
- Like and comment on posts  
- Responsive design  

## 💻 Getting Started (Local Development)

### 1. Clone the repository
```bash
git clone https://github.com/holasoymas/writehub.git
cd writehub
```

### 2. Install Dependencies
```bash
composer install
npm install      # or pnpm install / yarn install
```

### 3. Environment setup

- copy `.env.example` to `.env` 

```bash
cp .env.exmaple .env
```
- Update database credentials and other config in `.env`

### 4. Generate app key
```bash
php artisan key:generate
```

### 5. Run migration and seeders
```bash
php artisan migrate --seed
```

### 6. Compile assets
```bash
npm run dev      # or pnpm/yarn run dev
```

### 7. Serve the application
```bash
php artisan serve
```
- Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser




