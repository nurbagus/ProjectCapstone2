# Sistem Manajemen Inventaris Laboratorium

## Teknologi

### Frontend

* Laravel 12
* Blade
* Bootstrap / AdminLTE

### Backend

* Node.js
* Express.js
* JWT Authentication

### Database

* MySQL

---

# Cara Menjalankan Project

## 1. Clone Repository

```bash
git clone <URL_REPOSITORY>
cd <NAMA_PROJECT>
```

---

## 2. Setup Database

Buat database MySQL:

```sql
CREATE DATABASE lab_inventory;
```

Import file database yang tersedia.

---

## 3. Menjalankan Backend (Node.js)

Masuk ke folder backend:

```bash
cd backend
```

Install dependency:

```bash
npm install
```

Buat file `.env`:

```env
PORT=5000

DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=lab_inventory
DB_USER=root
DB_PASSWORD=

JWT_SECRET=your-secret-key
```

Jalankan backend:

```bash
npm start
```

atau

```bash
npm run dev
```

Backend berjalan di:

```text
http://localhost:5000
```

---

## 4. Menjalankan Frontend (Laravel)

Masuk ke folder frontend:

```bash
cd frontend
```

Install dependency:

```bash
composer install
npm install
```

Copy file environment:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Atur konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lab_inventory
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
```

Bersihkan cache:

```bash
php artisan optimize:clear
```

Build asset:

```bash
npm run build
```

Jalankan Laravel:

```bash
php artisan serve
```

Frontend berjalan di:

```text
http://localhost:8000
```

---

# Urutan Menjalankan Aplikasi

### Terminal 1

```bash
cd backend
npm install
npm run dev
```

### Terminal 2

```bash
cd frontend
composer install
php artisan serve
```

---

# Fitur Utama

## Authentication

* Login
* Logout
* JWT Authentication
* Session Login

## User Management

* Tambah User
* Edit User
* Hapus User
* List User

## Room Management

* Tambah Ruangan
* Edit Ruangan
* Hapus Ruangan
* List Ruangan

## Draft Pengadaan

* Membuat Draft
* Menambah Item Pengadaan
* Submit Draft

## Review Kaprodi

* Approve Item
* Reject Item
* Finalisasi Draft

## Inventaris

* Tambah Inventaris
* Detail Inventaris
* Upload Foto Inventaris

## Barang Habis Pakai (BHP)

* Tambah BHP
* Stok Masuk
* Stok Keluar
* Low Stock Monitoring

## Maintenance

* Tambah Maintenance
* Log Maintenance
* Pengurangan Stok BHP Otomatis

---

# Akun Demo

| Role          | Email                                             | Password |
| ------------- | ------------------------------------------------- | -------- |
| Administrator | [admin@gmail.com](mailto:admin@gmail.com)         | 123456   |
| Kepala Lab    | [kepalalab@gmail.com](mailto:kepalalab@gmail.com) | 123456   |
| Kaprodi       | [kaprodi@gmail.com](mailto:kaprodi@gmail.com)     | 123456   |
| Staf Admin    | [stafadmin@gmail.com](mailto:stafadmin@gmail.com) | 123456   |
| Staf Lab      | [staflab@gmail.com](mailto:staflab@gmail.com)     | 123456   |
