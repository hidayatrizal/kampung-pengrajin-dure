# 🛠️ Panduan Setup Project — Website Desa Pengrajin Genteng Dure

> Dokumen ini berisi langkah-langkah lengkap yang diperlukan untuk menjalankan project ini di komputer/laptop baru.

---

## Prasyarat Software yang Harus Diinstal

| Software | Versi Minimum | Fungsi |
|----------|---------------|--------|
| **PHP** | ≥ 8.0.2 | Runtime backend Laravel |
| **Composer** | ≥ 2.x | Package manager PHP |
| **Node.js** | ≥ 16.x | Runtime untuk Vite (build CSS/JS) |
| **NPM** | ≥ 8.x | Package manager Node.js (ikut Node.js) |
| **MySQL** | ≥ 5.7 / 8.x | Database server |
| **Git** | ≥ 2.x | Version control (opsional, jika clone dari repo) |

> 💡 **Tips:** Untuk pengguna Windows, disarankan menggunakan **XAMPP** (sudah termasuk PHP + MySQL) atau **Laragon** sebagai alternatif yang lebih modern.

---

## Alur Setup Lengkap (Step-by-Step)

### Step 1 — Install Software Prasyarat

#### 1a. Install PHP (≥ 8.0.2)

**Windows (XAMPP):**
1. Download XAMPP dari https://www.apachefriends.org/
2. Pilih versi yang include PHP 8.x
3. Install di `C:\xampp`
4. Tambahkan `C:\xampp\php` ke **Environment Variable PATH**
5. Buka Command Prompt, ketik `php -v` untuk verifikasi

**Windows (Laragon):**
1. Download Laragon dari https://laragon.org/
2. Install dan jalankan
3. Laragon otomatis menambahkan PHP ke PATH

**Verifikasi:**
```bash
php -v
# Output: PHP 8.0.x atau lebih baru
```

#### 1b. Install Composer

1. Download dari https://getcomposer.org/download/
2. Jalankan installer, pastikan memilih path PHP yang benar
3. Composer otomatis menambahkan ke PATH

**Verifikasi:**
```bash
composer -V
# Output: Composer version 2.x
```

#### 1c. Install Node.js & NPM

1. Download dari https://nodejs.org/ (pilih versi LTS)
2. Install — NPM sudah termasuk di dalamnya

**Verifikasi:**
```bash
node -v
# Output: v16.x atau lebih baru

npm -v
# Output: 8.x atau lebih baru
```

#### 1d. Install & Konfigurasi MySQL

**XAMPP:**
1. Buka XAMPP Control Panel
2. Start **MySQL**
3. Buka browser → `http://localhost/phpmyadmin`

**Laragon:**
1. Start Laragon
2. Klik **MySQL** → otomatis berjalan

**Verifikasi:**
```bash
mysql -u root -p
# Atau buka phpMyAdmin di browser
```

---

### Step 2 — Salin Project ke Komputer Baru

**Opsi A — Dari Git Repository:**
```bash
git clone <URL_REPOSITORY> desa-pengrajin-dure
cd desa-pengrajin-dure
```

**Opsi B — Dari File ZIP:**
1. Extract file ZIP project ke folder tujuan, misalnya:
   - Windows: `C:\xampp\htdocs\desa-pengrajin-dure` (XAMPP)
   - Windows: `C:\laragon\www\desa-pengrajin-dure` (Laragon)
2. Buka terminal di folder tersebut:
```bash
cd desa-pengrajin-dure
```

---

### Step 3 — Install Dependency PHP

```bash
composer install
```

> ⏳ Proses ini mengunduh semua package PHP yang diperlukan (Laravel, Sanctum, dll) ke folder `vendor/`

---

### Step 4 — Install Dependency Node.js

```bash
npm install
```

> ⏳ Proses ini mengunduh semua package Node.js (Vite, TailwindCSS, Autoprefixer, dll) ke folder `node_modules/`

---

### Step 5 — Konfigurasi Environment (.env)

```bash
# Salin file .env.example menjadi .env
cp .env.example .env
```

> ⚠️ **Jika file `.env` sudah ada di project (bukan `.env.example`), kamu bisa langsung edit file `.env` tersebut tanpa menyalin.**

Buka file `.env` dan sesuaikan konfigurasi berikut:

```env
# ==========================================
# KONFIGURASI WAJIB — HARUS DISESUAIKAN
# ==========================================

# Nama aplikasi
APP_NAME="Desa Pengrajin Dure"

# Environment (local untuk development)
APP_ENV=local
APP_DEBUG=true

# URL akses website (sesuaikan dengan setup)
# XAMPP: http://localhost/desa-pengrajin-dure/public
# Laragon: http://desa-pengrajin-dure.test
# php artisan serve: http://localhost:8000
APP_URL=http://localhost:8000

# ==========================================
# DATABASE — SESUAIKAN DENGAN SETUP MYSQL
# ==========================================
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desa_pengrajin_dure    # Nama database yang akan dibuat
DB_USERNAME=root                    # Default XAMPP/Laragon: root
DB_PASSWORD=                        # Default XAMPP: kosong | Laragon: kosong
```

---

### Step 6 — Generate Application Key

```bash
php artisan key:generate
```

> Perintah ini menghasilkan `APP_KEY` di file `.env` yang digunakan untuk enkripsi session, CSRF token, dll.

**Verifikasi:** Buka `.env`, pastikan `APP_KEY` sudah terisi, contoh:
```env
APP_KEY=base64:RySmqNnqCZRsKrPBVIDxV2Xbrw+uFErqpd2ozSDLhpY=
```

---

### Step 7 — Buat Database MySQL

Buka phpMyAdmin (`http://localhost/phpmyadmin`) atau MySQL CLI:

```sql
CREATE DATABASE desa_pengrajin_dure CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau via terminal:
```bash
mysql -u root -p -e "CREATE DATABASE desa_pengrajin_dure CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

> Pastikan nama database sama dengan `DB_DATABASE` di file `.env`

---

### Step 8 — Jalankan Migrasi Database

```bash
php artisan migrate
```

> Perintah ini membuat semua tabel: `users`, `products`, `craftsmen`, `galleries`, `contact_messages`, `settings`, dll.

**Verifikasi:**
```bash
php artisan tinker --execute="echo 'Tables created successfully';"
```

---

### Step 9 — Jalankan Database Seeder

```bash
php artisan db:seed
```

> Perintah ini mengisi data awal:
> - **1 akun admin** (email: `admin@desadure.id`, password: `password`)
> - **3 produk contoh**
> - **2 pengrajin contoh**
> - **4 foto galeri contoh**
> - **14 pengaturan website** (hero, kontak, dll)

**Verifikasi:**
```bash
php artisan tinker --execute="echo App\Models\User::count() . ' users, ' . App\Models\Product::count() . ' products, ' . App\Models\Setting::count() . ' settings';"
```

---

### Step 10 — Buat Symbolic Link Storage

```bash
php artisan storage:link
```

> Perintah ini membuat link `public/storage` → `storage/app/public` agar file gambar yang diupload dapat diakses via browser.

---

### Step 11 — Build Frontend Assets

```bash
npm run build
```

> Perintah ini meng-compile TailwindCSS dan JavaScript menggunakan Vite, menghasilkan file di `public/build/`

**Untuk Development (dengan hot-reload):**
```bash
npm run dev
```
> Gunakan `npm run dev` saat mengembangkan agar perubahan CSS/JS otomatis ter-refresh di browser.

---

### Step 12 — Jalankan Server Lokal

**Opsi A — Menggunakan `php artisan serve` (Disarankan):**
```bash
php artisan serve
```
Akses di browser: **http://localhost:8000**

**Opsi B — Menggunakan XAMPP:**
1. Pastikan project berada di `C:\xampp\htdocs\desa-pengrajin-dure`
2. Start Apache di XAMPP Control Panel
3. Akses di browser: **http://localhost/desa-pengrajin-dure/public**

**Opsi C — Menggunakan Laragon:**
1. Pastikan project berada di `C:\laragon\www\desa-pengrajin-dure`
2. Start Laragon
3. Akses di browser: **http://desa-pengrajin-dure.test** (otomatis via Laragon)

---

### Step 13 — Verifikasi Semua Fitur

Buka browser dan akses halaman-halaman berikut:

#### Frontend (Public)
| URL | Halaman | Verifikasi |
|-----|---------|------------|
| `http://localhost:8000` | Beranda | Tampil hero, produk, pengrajin, galeri |
| `http://localhost:8000/catalog` | Katalog | Tampil daftar produk + filter funcion |
| `http://localhost:8000/history` | Sejarah | Tampil timeline sejarah desa |
| `http://localhost:8000/contact` | Kontak | Tampil info kontak + form pesan |

#### Backend (Admin Panel)
| URL | Halaman | Verifikasi |
|-----|---------|------------|
| `http://localhost:8000/admin/login` | Login | Form login tampil |
| `http://localhost:8000/admin/dashboard` | Dashboard | Stat cards, recent products, kategori, pesan terbaru |
| `http://localhost:8000/admin/products` | Produk | CRUD produk berjalan |
| `http://localhost:8000/admin/craftsmen` | Pengrajin | CRUD pengrajin berjalan |
| `http://localhost:8000/admin/gallery` | Galeri | CRUD galeri berjalan |
| `http://localhost:8000/admin/messages` | Pesan | Daftar pesan masuk |
| `http://localhost:8000/admin/profile` | Profil | Ubah nama & password berjalan |
| `http://localhost:8000/admin/settings` | Pengaturan | 14 setting fields tampil & tersimpan |

#### Akun Admin Default
| Field | Nilai |
|-------|-------|
| **Email** | `admin@desadure.id` |
| **Password** | `password` |

#### Test Kirim Pesan
1. Buka `/contact`
2. Isi form (nama, email, subjek, pesan)
3. Klik "Kirim Pesan"
4. Verifikasi notifikasi sukses muncul
5. Login ke admin → buka `/admin/messages` → pesan baru muncul dengan badge merah

---

## Ringkasan Perintah Run (Setelah Setup)

Setelah semua setup selesai, untuk menjalankan project setiap kali, cukup jalankan:

```bash
# Terminal 1 — Start server PHP
php artisan serve

# Terminal 2 — (Opsional, hanya saat development) Start Vite hot-reload
npm run dev
```

> Jika sudah pernah `npm run build`, frontend assets sudah terkompilasi dan tidak perlu `npm run dev` lagi untuk production.

---

## Troubleshooting Umum

### ❌ Error: "Class not found" / "Target class does not exist"
```bash
composer dump-autoload
```

### ❌ Error: "500 Internal Server Error" setelah setup
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### ❌ Error: "No application encryption key"
```bash
php artisan key:generate
```

### ❌ Error: "SQLSTATE[HY000] [1049] Unknown database"
1. Pastikan database sudah dibuat di MySQL
2. Pastikan `DB_DATABASE` di `.env` sesuai dengan nama database
3. Jalankan `php artisan migrate`

### ❌ Error: "SQLSTATE[HY000] [1045] Access denied"
1. Cek `DB_USERNAME` dan `DB_PASSWORD` di `.env`
2. Default XAMPP: `root` tanpa password
3. Default Laragon: `root` tanpa password

### ❌ Gambar tidak muncul di halaman
```bash
php artisan storage:link
```
Pastikan folder `storage/app/public/` berisi folder: `products/`, `craftsmen/`, `gallery/`

### ❌ CSS/Tailwind tidak berubah saat edit
```bash
npm run build
# Atau untuk development:
npm run dev
```

### ❌ Data contoh tidak ada / halaman kosong
```bash
php artisan db:seed
```

### ❌ Migrasi gagal / tabel sudah ada
```bash
# HATI-HATI: ini menghapus semua data!
php artisan migrate:fresh --seed
```

---

## Diagram Alur Setup

```mermaid
flowchart TD
    START([Mulai Setup di Komputer Baru]) --> A[Install Software Prasyarat:\nPHP ≥ 8.0, Composer, Node.js, MySQL]
    A --> B[Salin Project ke Komputer\nclone atau extract ZIP]
    B --> C[composer install\nInstall dependency PHP]
    C --> D[npm install\nInstall dependency Node.js]
    D --> E[Konfigurasi .env\nAPP_NAME, DB_DATABASE, dll]
    E --> F[php artisan key:generate\nGenerate APP_KEY]
    F --> G[Buat Database MySQL\ndesa_pengrajin_dure]
    G --> H[php artisan migrate\nBuat semua tabel]
    H --> I[php artisan db:seed\nIsi data awal]
    I --> J[php artisan storage:link\nLink folder storage]
    J --> K[npm run build\nCompile CSS/JS assets]
    K --> L[php artisan serve\nJalankan server lokal]
    L --> M([Akses http://localhost:8000])

    M --> N{Halaman tampil?}
    N -->|Ya| O{Data contoh ada?}
    N -->|Tidak| P[Troubleshooting:\nclear cache, cek .env, storage:link]
    P --> L

    O -->|Ya| Q([✅ Setup Berhasil!\nWebsite siap digunakan])]
    O -->|Tidak| R[php artisan db:seed\nphp artisan migrate:fresh --seed]
    R --> Q

    style START fill:#f97316,color:#fff
    style Q fill:#10b981,color:#fff
    style P fill:#ef4444,color:#fff
    style R fill:#f59e0b,color:#fff
```

---

## Checklist Setup Cepat

Print atau salin checklist ini untuk memastikan tidak ada langkah yang terlewat:

- [ ] PHP ≥ 8.0.2 terinstall (`php -v`)
- [ ] Composer terinstall (`composer -V`)
- [ ] Node.js ≥ 16.x terinstall (`node -v`)
- [ ] NPM ≥ 8.x terinstall (`npm -v`)
- [ ] MySQL berjalan (phpMyAdmin bisa diakses)
- [ ] Project sudah disalin ke komputer
- [ ] `composer install` berhasil
- [ ] `npm install` berhasil
- [ ] File `.env` sudah dikonfigurasi (APP_NAME, DB_*)
- [ ] `php artisan key:generate` berhasil
- [ ] Database `desa_pengrajin_dure` sudah dibuat di MySQL
- [ ] `php artisan migrate` berhasil (tabel terbuat)
- [ ] `php artisan db:seed` berhasil (data awal terisi)
- [ ] `php artisan storage:link` berhasil
- [ ] `npm run build` berhasil
- [ ] `php artisan serve` berjalan tanpa error
- [ ] Beranda (`/`) tampil dengan data contoh
- [ ] Admin login (`/admin/login`) berhasil dengan admin@desadure.id / password
- [ ] Dashboard admin tampil dengan stat cards
- [ ] Kirim pesan di `/contact` berhasil
- [ ] Pesan masuk muncul di `/admin/messages`
- [ ] Upload gambar di CRUD produk/pengrajin/galeri berhasil