Sistem Manajemen Inventaris Laboratorium
Aplikasi Sistem Manajemen Inventaris Laboratorium berbasis:
•	Frontend: Laravel 12 + Blade + AdminLTE
•	Backend: Node.js + Express.js
•	Database: MySQL
________________________________________
Persyaratan Sistem
Pastikan software berikut sudah terinstall:
Backend
•	Node.js v18 atau lebih baru
•	npm
Frontend
•	PHP 8.2 atau lebih baru
•	Composer
Database
•	MySQL 8.x
•	phpMyAdmin (opsional)
Tools
•	Git
•	Visual Studio Code
________________________________________
Clone Repository
Clone repository:
git clone <URL_REPOSITORY>
Masuk ke folder project:
cd nama-project
________________________________________
Struktur Project
Contoh struktur:
project-root
│
├── backend
│   ├── controllers
│   ├── routes
│   ├── middleware
│   ├── models
│   ├── app.js
│   └── package.json
│
├── frontend
│   ├── app
│   ├── routes
│   ├── resources
│   ├── public
│   ├── composer.json
│   └── package.json
│
└── database
    └── database.sql
________________________________________
Setup Database
Buat database baru di MySQL:
CREATE DATABASE lab_inventory;
Import file database:
mysql -u root -p lab_inventory < database/database.sql
Atau import menggunakan phpMyAdmin.
________________________________________
Setup Backend (Node.js)
Masuk ke folder backend:
cd backend
Install dependency:
npm install
Buat file:
.env
Contoh isi:
PORT=5000

DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=lab_inventory
DB_USER=root
DB_PASSWORD=

JWT_SECRET=mysecretkey
Jalankan backend:
npm start
atau:
node app.js
Jika menggunakan nodemon:
npm run dev
Backend berjalan pada:
http://localhost:5000
________________________________________
Setup Frontend (Laravel)
Masuk ke folder frontend:
cd frontend
Install dependency Laravel:
composer install
Install dependency frontend:
npm install
Copy file environment:
cp .env.example .env
Generate application key:
php artisan key:generate
Edit file:
.env
Contoh konfigurasi database:
APP_NAME="SIM Laboratorium"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lab_inventory
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
Generate cache konfigurasi:
php artisan config:clear
php artisan cache:clear
Compile asset:
npm run build
Atau selama development:
npm run dev
Jalankan Laravel:
php artisan serve
Frontend berjalan pada:
http://localhost:8000
________________________________________
Urutan Menjalankan Aplikasi
Terminal 1
Jalankan backend:
cd backend
npm install
npm start
Pastikan muncul:
Server running on port 5000
________________________________________
Terminal 2
Jalankan frontend:
cd frontend
composer install
php artisan serve
Pastikan muncul:
Server running on http://127.0.0.1:8000
________________________________________
Login Aplikasi
Contoh akun:
Administrator
Email    : admin@gmail.com
Password : 123456
Kepala Laboratorium
Email    : kepalalab@gmail.com
Password : 123456
Kaprodi
Email    : kaprodi@gmail.com
Password : 123456
Staf Administrasi
Email    : stafadmin@gmail.com
Password : 123456
Staf Laboratorium
Email    : staflab@gmail.com
Password : 123456
________________________________________
Troubleshooting
Error: Vite Manifest Not Found
Jalankan:
npm install
npm run build
atau:
npm run dev
________________________________________
Error: SQLSTATE Database Not Found
Pastikan:
DB_DATABASE=lab_inventory
dan database sudah dibuat.
________________________________________
Error: JWT Invalid Token
Pastikan:
JWT_SECRET=mysecretkey
sama dengan konfigurasi backend.
________________________________________
Error: Session Tidak Tersimpan
Pastikan:
SESSION_DRIVER=file
Kemudian jalankan:
php artisan optimize:clear
________________________________________
Error: API Connection Failed
Pastikan backend berjalan:
http://localhost:5000
Cek endpoint:
http://localhost:5000/api/login
________________________________________
Fitur Sistem
Administrator
•	Kelola User
•	Kelola Ruangan
Kepala Laboratorium
•	Draft Pengadaan
•	Submit Draft
Kaprodi
•	Review Draft
•	Approve / Reject
•	Finalisasi Draft
Staf Administrasi
•	Kelola Inventaris
•	Upload Foto Inventaris
Staf Laboratorium
•	Kelola BHP
•	Maintenance Inventaris

