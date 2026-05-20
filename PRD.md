# 📄 Product Requirements Document (PRD)

## Website Desa Pengrajin Genteng Dure

---

**Versi:** 2.0
**Tanggal:** Mei 2026
**Status:** Final
**Tech Stack:** Laravel 10, Blade Templating, TailwindCSS, MySQL

---

## 1. Latar Belakang

Desa Dure dikenal sebagai pusat kerajinan genteng tradisional sejak era **1950-an** dengan lebih dari **150+ keluarga pengrajin** dan **200+ jenis produk**. Potensi besar ini perlu dipublikasikan secara digital agar dapat menjangkau pasar yang lebih luas.

Website ini dibangun sebagai **platform UMKM Desa Dure** dengan tujuan:

- Mempromosikan produk kerajinan genteng ke pasar yang lebih luas
- Melestarikan budaya dan sejarah desa secara digital
- Memudahkan masyarakat luar mengenal dan menghubungi pengrajin
- Menyediakan panel admin bagi pengelola untuk memperbarui konten
- Memfasilitasi komunikasi antara pengunjung dan admin melalui form kontak

---

## 2. Tujuan Produk

| No | Tujuan |
| :--- | :--- |
| 1 | Menampilkan informasi desa dan sejarahnya kepada publik |
| 2 | Menampilkan katalog produk kerajinan genteng yang dapat dicari dan difilter |
| 3 | Memperkenalkan profil pengrajin (craftsmen) kepada pengunjung |
|  | Menampilkan Hasil belajar seelama 1 bulan |
| 4 | Menyediakan galeri foto hasil karya kerajinan |
| 5 | Menyediakan informasi kontak dan lokasi desa |
| 6 | Menerima pesan dari pengunjung melalui form kontak |
| 7 | Memberikan panel admin untuk mengelola seluruh konten website |
| 8 | Menyediakan pengaturan agar admin dapat mengubah konten statis tanpa edit kode |

---

## 3. Aktor / Pengguna Sistem

| Aktor | Deskripsi | Hak Akses |
| :--- | :--- | :--- |
| **Pengunjung Umum** | Masyarakat umum yang mengakses website | Melihat semua halaman frontend, mengirim pesan kontak (Read + Submit) |
| **Admin** | Pengelola website (pihak desa/UMKM) | Login ke panel admin, mengelola semua konten (CRUD), membaca pesan masuk, mengelola profil & pengaturan |

---

## 4. Peta Halaman (Sitemap)

```
Website Desa Pengrajin Dure
│
├── [PUBLIC / FRONTEND]
│   ├── /              → Beranda (Home)
│   ├── /catalog        → Katalog Produk
│   ├── /history        → Sejarah Desa
│   ├── /contact        → Hubungi Kami (view form)
│   └── POST /contact   → Kirim Pesan (submit form)
│
└── [ADMIN / BACKEND]
    ├── /admin/login       → Login Admin
    └── /admin             (protected — wajib login)
        ├── /admin/dashboard    → Dashboard
        ├── /admin/products     → Manajemen Produk (CRUD)
        ├── /admin/craftsmen    → Manajemen Pengrajin (CRUD)
        ├── /admin/gallery      → Manajemen Galeri (CRUD)
        ├── /admin/messages     → Pesan Masuk (Read, Mark Read, Delete)
        ├── /admin/profile      → Profil Admin (Ubah Nama & Password)
        └── /admin/settings     → Pengaturan Website
```

---

## 5. Fitur Frontend (Halaman Publik)

### 5.1 Halaman Beranda (`/`)

**Deskripsi:** Halaman utama yang menjadi wajah website desa.

**Seksi & Konten:**

| Seksi | Konten | Sumber Data |
| :--- | :--- | :--- |
| **Hero Section** | Gambar hero, headline, tagline, tombol CTA (Lihat Produk & Hubungi Kami), highlight fitur (Bahan Alami, Kuat & Tahan Lama, Buatan Lokal) | Settings: `hero_title`, `hero_subtitle`, `hero_cta_primary`, `hero_cta_secondary` |
| **Statistik** | Keluarga Pengrajin, Jenis Produk, Tahun Pengalaman | Settings: `stat_families`, `stat_products`, `stat_years` |
| **Tentang Kami** | Narasi singkat identitas Desa Dure, foto, tahun berdiri | Settings: `about_title` |
| **Koleksi Pilihan** | 3 produk terbaru/terpilih beserta foto, nama, harga, dan tombol WhatsApp | `products` (3 terakhir) |
| **Quote Banner** | Kutipan filosofi pengrajin | Settings: `quote_text` |
| **Sang Maestro** | Profil 2 pengrajin unggulan — foto, nama, peran, kutipan | `craftsmen` (2 terakhir) |
| **Galeri Kreativitas** | Grid masonry foto hasil karya desa | `galleries` (semua) |
| **Footer** | Navigasi, info kontak, copyright | Settings: `contact_address`, `contact_email` |

**Alur Pengguna Beranda:**

1. Pengunjung buka website → Landing di `/`
1. Klik **"Lihat Produk"** → Redirect ke `/catalog`
1. Klik **"Hubungi Kami"** → Redirect ke `/contact`
1. Klik **"Lihat Semua"** di seksi produk → Redirect ke `/catalog`
1. Klik **"Kunjungi Kami"** di seksi galeri → Redirect ke `/contact`

### 5.2 Halaman Katalog Produk (`/catalog`)

**Deskripsi:** Halaman daftar semua produk kerajinan yang dapat dicari dan difilter secara dinamis.

**Fitur Utama:**

| Fitur | Detail |
| :--- | :--- |
| **Filter Kategori** | Pill/tab filter berdasarkan kategori produk (dinamis dari database, `distinct category`) |
| **Pencarian Real-time** | Input search dengan debounce 500ms; mencari berdasarkan `name` dan `description` produk |
| **Grid Produk** | Layout grid responsif: 1 kolom (mobile) → 2 kolom (tablet) → 3 kolom (desktop) |
| **Jumlah Produk** | Menampilkan total produk yang ditemukan setelah filter/search |
| **Kartu Produk** | Foto, nama, harga, kategori, tombol order via WhatsApp |
| **Empty State** | Pesan "Tidak Ada Produk" jika hasil pencarian kosong + tombol reset |

**Query Parameter URL:**

- `?category=xxx` → filter berdasarkan kategori
- `?search=xxx` → pencarian berdasarkan nama/deskripsi
- Keduanya bisa dikombinasikan: `?category=xxx&search=yyy`

**Alur Pengguna Katalog:**

1. Buka `/catalog` → Semua produk tampil (urut terbaru)
1. Klik filter kategori → Produk difilter, URL diperbarui
1. Ketik di kolom search → Produk difilter real-time setelah 500ms
1. Klik tombol **WhatsApp** pada kartu produk → Redirect ke WhatsApp chat
1. Jika tidak ada hasil → Tampil empty state + tombol "Lihat Semua Produk"

### 5.3 Halaman Sejarah (`/history`)

**Deskripsi:** Halaman naratif tentang perjalanan dan sejarah Desa Dure sebagai desa pengrajin genteng.

**Konten & Struktur:**

| Seksi | Isi |
| :--- | :--- |
| **Hero Banner** | Foto background, label "Warisan Leluhur", judul "Sejarah Dure" |
| **Intro Quote** | *"Kekuatan sebuah genteng bukan terletak pada satu lembar tanah liat..."* |
| **Timeline (3 bab)** | Garis waktu vertikal dengan 3 titik narasi |
| → Bab 01 | *Tradisi Sejak 1950* — Teknik "Tiga Lapis, Satu Warisan" |
| → Bab 02 | *Semangat Masa Kini* — "Dari Desa untuk Dunia", 150+ keluarga pengrajin |
| → Bab 03 | *Masa Depan* — "Warisan yang Terus Hidup" (dengan animasi ping aktif sebagai titik live) |
| **Statistik** | 70+ Tahun Pengalaman, 150+ Keluarga Pengrajin, 200+ Jenis Produk, Berdiri 1950 |
| **CTA** | Tombol "Lihat Produk" → `/catalog`, Tombol "Hubungi Kami" → `/contact` |

**Alur Pengguna Sejarah:**

1. Pengunjung buka `/history` → Membaca narasi sejarah desa
1. Scroll mengikuti alur timeline dari bab 01 → 02 → 03
1. Klik **"Lihat Produk"** → Redirect ke `/catalog`
1. Klik **"Hubungi Kami"** → Redirect ke `/contact`

---

### 5.4 Halaman Kontak (`/contact`)

**Deskripsi:** Halaman informasi kontak lengkap dan formulir pesan untuk pengunjung.

**Konten & Struktur:**

| Seksi | Isi |
| :--- | :--- |
| **Header** | Judul "Kami Siap Mendengar", deskripsi singkat ajakan kontak |
| **Kartu Kontak (3 kartu)** | Alamat, WhatsApp, Email |
| **Form Kirim Pesan** | Field: Nama Lengkap, Email, Subjek, Pesan |
| **Peta Lokasi** | Placeholder embed Google Maps *(belum diintegrasikan)* |
| **Jam Operasional** | Senin–Sabtu: 08.00–17.00 WIB, Minggu: 09.00–15.00 WIB |

**Detail Kartu Kontak:**

| Kartu | Informasi | Aksi |
| :--- | :--- | :--- |
| **Alamat** | Pusat Kerajinan Terpadu, Jl. Raya Dure No. 45, Kec. Seni, Kabupaten Kultur | - |
| **WhatsApp** | +62 812-3456-7890 | Tombol "Chat Sekarang" → `wa.me/6281234567890` |
| **Email** | info@desadure.id | Balas dalam 1x24 jam |

**Detail Form Kirim Pesan:**

| Field | Tipe | Validasi | Keterangan |
| :--- | :--- | :--- | :--- |
| Nama Lengkap | text | Required, max:255 | Nama pengirim |
| Email | email | Required, format email valid | Email pengirim |
| Subjek | text | Required, max:255 | Subjek pesan |
| Pesan | textarea | Required | Isi pesan |

> ✅ **Catatan:** Form kontak **sudah terhubung ke backend**. Data dikirim via `POST /contact` dan disimpan ke tabel `contact_messages`. Pesan dapat dilihat oleh admin di halaman Pesan Masuk.

**Alur Pengguna Kontak:**

1. Pengunjung buka `/contact` → Melihat info kontak
1. Klik **"Chat Sekarang"** di kartu WhatsApp → Buka WhatsApp
1. Isi form → Klik **"Kirim Pesan"** → Data tersimpan ke database → Tampil notifikasi sukses
1. Admin melihat pesan di panel `/admin/messages`

---

## 6. Fitur Backend / Admin Panel

### 6.1 Autentikasi Admin (`/admin/login`)

**Deskripsi:** Sistem login untuk admin agar dapat mengakses panel pengelolaan konten.

**Field Form Login:**

| Field | Tipe | Validasi |
| :--- | :--- | :--- |
| Email | email | Required, format email valid |
| Password | password | Required |
| Remember Me | checkbox | Opsional — sesi tetap aktif |

**Alur Login Admin:**

```
[Buka /admin/login]
        │
        ▼
[Isi Email + Password → Submit]
        │
        ▼
[Proses Autentikasi (Auth::attempt)]
        │
        ├── [GAGAL] ──► Kembali ke form + error: "Kredensial tidak cocok"
        │
        └── [SUKSES] ──► Regenerate session → Redirect ke /admin/dashboard
```

**Logout:**

- Admin klik tombol logout → POST `/admin/logout`
- Session dihancurkan + token CSRF diperbarui → Redirect ke `/admin/login`

> 🔒 **Keamanan:** Semua route `/admin/*` (kecuali login) dilindungi middleware `auth`. Akses tanpa sesi aktif otomatis di-redirect ke `/admin/login`.

---

### 6.2 Dashboard Admin (`/admin/dashboard`)

**Deskripsi:** Halaman ringkasan utama panel admin setelah login berhasil. Menyediakan overview data dan akses cepat ke seluruh fitur manajemen.

**Widget & Konten:**

| Widget | Data | Link |
| :--- | :--- | :--- |
| **Stat Card: Total Produk** | `COUNT(products)` | → `/admin/products` |
| **Stat Card: Total Pengrajin** | `COUNT(craftsmen)` | → `/admin/craftsmen` |
| **Stat Card: Total Galeri** | `COUNT(galleries)` | → `/admin/gallery` |
| **Stat Card: Pesan Baru** | `COUNT(contact_messages WHERE is_read = false)` + badge merah | → `/admin/messages` |
| **Quick Actions** | Tombol pintas Tambah Produk, Tambah Pengrajin, Tambah Galeri, Lihat Pesan | → masing-masing halaman |
| **Produk Terbaru** | 5 produk terbaru (foto, nama, kategori, harga, waktu relatif) | → `/admin/products` |
| **Kategori Produk** | Distribusi kategori produk dengan progress bar | - |
| **Pesan Masuk Terbaru** | 5 pesan kontak terbaru (nama, subjek, status baca, waktu) | → `/admin/messages` |

**Alur Pengguna Dashboard:**

1. Login sukses → Landing di `/admin/dashboard`
1. Klik stat card → Redirect ke halaman daftar terkait
1. Klik quick action → Redirect ke halaman tujuan
1. Lihat pesan terbaru → Klik pesan → Detail pesan
1. Notifikasi pesan belum dibaca tersedia di sidebar (badge merah) dan header bar (ikon envelope + badge)

---

### 6.3 Manajemen Produk (`/admin/products`)

**Deskripsi:** Halaman untuk mengelola data produk secara penuh (CRUD).

**Tabel Endpoint CRUD:**

| Operasi | Method | Route | Keterangan |
| :--- | :--- | :--- | :--- |
| **List** | GET | `/admin/products` | Daftar semua produk (urut ID desc) |
| **Create Form** | GET | `/admin/products/create` | Tampil form tambah produk |
| **Store** | POST | `/admin/products` | Simpan produk baru ke database |
| **Edit Form** | GET | `/admin/products/{id}/edit` | Tampil form edit produk |
| **Update** | PUT/PATCH | `/admin/products/{id}` | Perbarui data produk |
| **Delete** | DELETE | `/admin/products/{id}` | Hapus produk dari database |

**Field & Validasi Data Produk:**

| Field | Tipe | Validasi | Default | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| `name` | string | Required, max:255 | - | Nama produk |
| `price` | string | Required, max:255 | - | Harga produk (format bebas) |
| `category` | string | Nullable, max:255 | `"Terpopuler"` | Kategori produk |
| `description` | text | Required | - | Deskripsi produk |
| `image` | file | Required (create), Nullable (update) | - | Foto produk |
| `wa` | string | Nullable, max:20 | `"6281234567890"` | Nomor WhatsApp pengrajin |

**Format File Gambar:** JPEG, PNG, JPG, WEBP — Maksimal **2MB**
**Lokasi Simpan:** `storage/app/public/products/`

**Alur CRUD Produk:**

```plaintext
[Daftar Produk /admin/products]
        │
        ├─[Tambah]─► [Form Tambah] ─► [Validasi]
        │                                  ├─[GAGAL] ──► Form + Error
        │                                  └─[SUKSES]──► Simpan DB + Flash "Berhasil ditambahkan"
        │
        ├─[Edit]───► [Form Edit]   ─► [Validasi]
        │            (data terisi)      ├─[GAGAL] ──► Form + Error
        │                              └─[SUKSES]──► Update DB (+ hapus foto lama) + Flash
        │
        └─[Hapus]──► Hapus record + hapus file foto dari storage
                     └─► Flash "Berhasil dihapus"
```

---

### 6.4 Manajemen Pengrajin (`/admin/craftsmen`)

**Deskripsi:** Halaman untuk mengelola data profil pengrajin desa.

**Endpoint CRUD:**

| Operasi | Method | Route | Keterangan |
| :--- | :--- | :--- | :--- |
| **List** | GET | `/admin/craftsmen` | Daftar semua pengrajin (urut ID desc) |
| **Create Form** | GET | `/admin/craftsmen/create` | Form tambah pengrajin |
| **Store** | POST | `/admin/craftsmen` | Simpan pengrajin baru |
| **Edit Form** | GET | `/admin/craftsmen/{id}/edit` | Form edit pengrajin |
| **Update** | PUT/PATCH | `/admin/craftsmen/{id}` | Perbarui data pengrajin |
| **Delete** | DELETE | `/admin/craftsmen/{id}` | Hapus pengrajin |

**Field & Validasi Data Pengrajin:**

| Field | Tipe | Validasi | Keterangan |
| :--- | :--- | :--- | :--- |
| `name` | string | Required, max:255 | Nama pengrajin |
| `role` | string | Required, max:255 | Peran/jabatan (cth: "Pengrajin Senior") |
| `image` | file | Required (create), Nullable (update) | Foto pengrajin |
| `quote` | text | Required | Kutipan / motto pengrajin |

**Lokasi Simpan Foto:** `storage/app/public/craftsmen/`

---

### 6.5 Manajemen Galeri (`/admin/gallery`)

**Deskripsi:** Halaman untuk mengelola koleksi foto galeri hasil karya desa.

**Endpoint CRUD:**

| Operasi | Method | Route | Keterangan |
| :--- | :--- | :--- | :--- |
| **List** | GET | `/admin/gallery` | Daftar semua foto galeri (urut ID desc) |
| **Create Form** | GET | `/admin/gallery/create` | Form tambah foto |
| **Store** | POST | `/admin/gallery` | Simpan foto baru |
| **Edit Form** | GET | `/admin/gallery/{id}/edit` | Form edit foto galeri |
| **Update** | PUT/PATCH | `/admin/gallery/{id}` | Perbarui data galeri |
| **Delete** | DELETE | `/admin/gallery/{id}` | Hapus foto galeri |

**Field & Validasi Data Galeri:**

| Field | Tipe | Validasi | Keterangan |
| :--- | :--- | :--- | :--- |
| `title` | string | Required, max:255 | Judul / caption foto |
| `category` | string | Required, max:255 | Kategori foto |
| `url` | file | Required (create), Nullable (update) | File foto |

**Lokasi Simpan Foto:** `storage/app/public/gallery/`

> 📌 **Catatan Umum CRUD Gambar:** Saat **update**, jika ada file baru diupload, file lama dihapus otomatis dari storage. Saat **delete**, file foto dihapus bersamaan dengan record database.

---

### 6.6 Manajemen Pesan Masuk (`/admin/messages`)

**Deskripsi:** Halaman untuk melihat, memfilter, dan mengelola pesan yang dikirim pengunjung melalui form kontak.

**Endpoint:**

| Operasi | Method | Route | Keterangan |
| :--- | :--- | :--- | :--- |
| **List** | GET | `/admin/messages` | Daftar semua pesan (urut ID desc), mendukung filter `?filter=all\\\|unread\\\|read` |
| **Detail** | GET | `/admin/messages/{id}` | Melihat detail pesan; otomatis menandai sebagai dibaca |
| **Hapus** | DELETE | `/admin/messages/{id}` | Hapus pesan |
| **Tandai Semua Dibaca** | POST | `/admin/messages/mark-all-read` | Menandai semua pesan belum dibaca menjadi dibaca |

**Field & Validasi Data Pesan Kontak:**

| Field | Tipe | Validasi | Keterangan |
| :--- | :--- | :--- | :--- |
| `name` | string | Required, max:255 | Nama pengirim |
| `email` | string | Required, email valid, max:255 | Email pengirim |
| `subject` | string | Required, max:255 | Subjek pesan |
| `message` | text | Required | Isi pesan |
| `is_read` | boolean | - | Status baca (default: `false`) |

**Fitur Halaman Daftar Pesan:**

- Filter tab: **Semua** / **Belum Dibaca** / **Sudah Dibaca**
- Indikator visual: pesan belum dibaca memiliki border oranye & dot indicator
- Tombol **"Tandai Semua Dibaca"** (hanya muncul jika ada pesan belum dibaca)
- Badge jumlah pesan belum dibaca di sidebar dan header bar

**Fitur Halaman Detail Pesan:**

- Menampilkan nama, email, subjek, waktu, dan isi pesan lengkap
- Otomatis menandai pesan sebagai sudah dibaca saat dibuka
- Tombol aksi: **Balas via Email** (mailto), **Balas via WhatsApp**, **Hapus**
- Link kembali ke daftar pesan

**Alur Pengelolaan Pesan:**

```
[Pengunjung mengisi form di /contact]
        │
        ▼
[Data tersimpan ke tabel contact_messages (is_read = false)]
        │
        ▼
[Admin buka /admin/messages]
        │
        ├─[Lihat daftar] → Filter: Semua / Belum Dibaca / Sudah Dibaca
        │
        ├─[Klik pesan] → Detail pesan + otomatis is_read = true
        │
        ├─[Balas] → Email (mailto) atau WhatsApp
        │
        ├─[Hapus] → Hapus pesan dari database
        │
        └─[Tandai Semua Dibaca] → Semua is_read = true
```

---

### 6.7 Profil Admin (`/admin/profile`)

**Deskripsi:** Halaman untuk mengelola informasi akun admin, termasuk mengubah nama dan password.

**Endpoint:**

| Operasi | Method | Route | Keterangan |
| :--- | :--- | :--- | :--- |
| **Halaman Profil** | GET | `/admin/profile` | Tampil halaman profil admin |
| **Ubah Nama** | POST | `/admin/profile/name` | Perbarui nama admin |
| **Ubah Password** | POST | `/admin/profile/password` | Perbarui password admin (dengan verifikasi password lama) |

**Form Ubah Nama:**

| Field | Tipe | Validasi |
| :--- | :--- | :--- |
| `name` | text | Required, max:255 |

**Form Ubah Password:**

| Field | Tipe | Validasi |
| :--- | :--- | :--- |
| `current_password` | password | Required, harus cocok dengan password saat ini |
| `password` | password | Required, min:8, confirmed |
| `password_confirmation` | password | Required, harus cocok dengan `password` |

**Halaman Profil Menampilkan:**

- Form ubah nama
- Form ubah password (dengan validasi password lama)
- Kartu informasi akun (nama, email, tanggal bergabung)

---

### 6.8 Pengaturan Website (`/admin/settings`)

**Deskripsi:** Halaman untuk mengelola konten statis yang ditampilkan di website publik, agar admin dapat memperbarui konten tanpa perlu mengubah kode.

**Endpoint:**

| Operasi | Method | Route | Keterangan |
| :--- | :--- | :--- | :--- |
| **Halaman Pengaturan** | GET | `/admin/settings` | Tampil form pengaturan yang dikelompokkan per grup |
| **Simpan Pengaturan** | PUT | `/admin/settings` | Simpan semua perubahan pengaturan |

**Daftar Pengaturan:**

**Grup "Hero & Beranda":**

| Key | Label | Tipe | Default |
| :--- | :--- | :--- | :--- |
| `hero_title` | Judul Hero | text | "Genteng Berkualitas untuk Bangunan Tahan Lama" |
| `hero_subtitle` | Deskripsi Hero | textarea | "Diproduksi oleh pengrajin berpengalaman..." |
| `hero_cta_primary` | Tombol Utama Hero | text | "Lihat Produk" |
| `hero_cta_secondary` | Tombol Sekunder Hero | text | "Hubungi Kami" |
| `stat_families` | Statistik: Keluarga Pengrajin | text | "150+" |
| `stat_products` | Statistik: Jenis Produk | text | "200+" |
| `stat_years` | Statistik: Tahun Pengalaman | text | "70+" |
| `about_title` | Judul Tentang Kami | text | "Identitas yang Dianyam dengan Hati." |
| `quote_text` | Kutipan Filosofi | textarea | "Kekuatan sebuah genteng bukan terletak..." |

**Grup "Kontak":**

| Key | Label | Tipe | Default |
| :--- | :--- | :--- | :--- |
| `contact_address` | Alamat | textarea | "Pusat Kerajinan Terpadu, Jl. Raya Dure No. 45..." |
| `contact_whatsapp` | Nomor WhatsApp | text | "6281234567890" |
| `contact_email` | Email | text | "info@desadure.id" |
| `contact_hours_weekday` | Jam Operasional (Weekday) | text | "Senin - Sabtu: 08.00 - 17.00 WIB" |
| `contact_hours_weekend` | Jam Operasional (Weekend) | text | "Minggu: 09.00 - 15.00 WIB" |

> 📌 **Catatan:** Pengaturan yang tersimpan di database menggantikan nilai hardcoded di Blade template. Admin dapat mengubah semua konten statis di atas melalui antarmuka web tanpa memerlukan akses ke kode.

---

## 7. Navigasi Admin Panel

### 7.1 Sidebar (Desktop & Mobile)

**Menu Utama:**

| Menu | Ikon | Link | Badge |
| :--- | :--- | :--- | :--- |
| Dashboard | Grid icon | `/admin/dashboard` | - |
| Produk | Shopping bag icon | `/admin/products` | - |
| Pengrajin | Users icon | `/admin/craftsmen` | - |
| Galeri | Image icon | `/admin/gallery` | - |
| Pesan | Envelope icon | `/admin/messages` | Jumlah pesan belum dibaca (merah) |

**Lainnya:**

| Menu | Ikon | Link |
| :--- | :--- | :--- |
| Profil | User icon | `/admin/profile` |
| Pengaturan | Gear icon | `/admin/settings` |
| Lihat Website | Home icon | `/` (new tab) |
| Keluar | Logout icon | POST `/admin/logout` |

### 7.2 Header Bar (Top Bar)

**Elemen di Header:**

| Elemen | Deskripsi |
| :--- | :--- |
| Judul halaman | Nama halaman aktif (yield `title`) |
| Ikon pesan | Link ke `/admin/messages` + badge merah jumlah pesan belum dibaca |
| Ikon website | Link ke `/` (new tab) |
| Avatar | Inisial nama admin, link ke `/admin/profile` |

---

## 8. Struktur Database

### Tabel `users`

| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | bigint PK | Auto increment |
| `name` | string | Nama admin |
| `email` | string UNIQUE | Email login |
| `password` | string | Password (bcrypt hash) |
| `remember_token` | string NULL | Token "ingat saya" |
| `created_at` | timestamp | - |
| `updated_at` | timestamp | - |

### Tabel `products`

| Kolom | Tipe | Default | Keterangan |
| :--- | :--- | :--- | :--- |
| `id` | bigint PK | - | Auto increment |
| `name` | string | - | Nama produk |
| `price` | string | - | Harga produk |
| `category` | string | `"Terpopuler"` | Kategori produk |
| `description` | text | - | Deskripsi produk |
| `image` | string | - | Path relatif foto (`products/xxx.jpg`) |
| `wa` | string | `"6281234567890"` | Nomor WhatsApp pengrajin |
| `created_at` | timestamp | - | - |
| `updated_at` | timestamp | - | - |

### Tabel `craftsmen`

| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | bigint PK | Auto increment |
| `name` | string | Nama pengrajin |
| `role` | string | Peran / jabatan pengrajin |
| `image` | string | Path relatif foto (`craftsmen/xxx.jpg`) |
| `quote` | text | Kutipan / motto pengrajin |
| `created_at` | timestamp | - |
| `updated_at` | timestamp | - |

### Tabel `galleries`

| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | bigint PK | Auto increment |
| `title` | string | Judul / caption foto |
| `category` | string | Kategori foto galeri |
| `url` | string | Path relatif foto (`gallery/xxx.jpg`) |
| `created_at` | timestamp | - |
| `updated_at` | timestamp | - |

### Tabel `contact_messages`

| Kolom | Tipe | Default | Keterangan |
| :--- | :--- | :--- | :--- |
| `id` | bigint PK | - | Auto increment |
| `name` | string | - | Nama pengirim |
| `email` | string | - | Email pengirim |
| `subject` | string | - | Subjek pesan |
| `message` | text | - | Isi pesan |
| `is_read` | boolean | `false` | Status sudah dibaca |
| `created_at` | timestamp | - | - |
| `updated_at` | timestamp | - | - |

### Tabel `settings`

| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | bigint PK | Auto increment |
| `key` | string UNIQUE | Key unik pengaturan (cth: `hero_title`) |
| `value` | text NULL | Nilai pengaturan |
| `type` | string | Tipe input: `text` atau `textarea` |
| `group` | string | Grup pengaturan: `hero`, `contact` |
| `label` | string | Label yang ditampilkan di form |
| `created_at` | timestamp | - |
| `updated_at` | timestamp | - |

### Tabel Sistem Laravel (Auto-generated)

| Tabel | Fungsi |
| :--- | :--- |
| `password_resets` | Token reset password |
| `failed_jobs` | Antrian job yang gagal |
| `personal_access_tokens` | Token API (Sanctum) |

---

## 9. Arsitektur & Struktur File

### Struktur Direktori Utama

```
app/
├── Http/Controllers/
│   ├── Admin/
│   │   ├── AuthController.php          → Login, logout admin
│   │   ├── ContactMessageController.php → CRUD pesan masuk
│   │   ├── CraftsmanController.php      → CRUD pengrajin
│   │   ├── DashboardController.php      → Dashboard overview
│   │   ├── GalleryController.php        → CRUD galeri
│   │   ├── ProductController.php        → CRUD produk
│   │   ├── ProfileController.php        → Ubah nama & password
│   │   └── SettingController.php        → Kelola pengaturan website
│   ├── CatalogController.php            → Katalog frontend
│   ├── ContactController.php            → Form kontak frontend + store
│   ├── HomeController.php               → Beranda frontend
│   └── HistoryController.php            → Sejarah frontend
├── Models/
│   ├── ContactMessage.php               → Model pesan kontak
│   ├── Craftsman.php                    → Model pengrajin
│   ├── Gallery.php                      → Model galeri
│   ├── Product.php                      → Model produk
│   ├── Setting.php                      → Model pengaturan (+ helper get/set)
│   └── User.php                         → Model user admin

resources/views/
├── admin/
│   ├── auth/login.blade.php
│   ├── dashboard.blade.php              → Dashboard dengan stat, recent, kategori
│   ├── craftsmen/{index,create,edit}.blade.php
│   ├── gallery/{index,create,edit}.blade.php
│   ├── layouts/app.blade.php            → Layout admin (sidebar + header)
│   ├── messages/{index,show}.blade.php  → Daftar & detail pesan masuk
│   ├── products/{index,create,edit}.blade.php
│   ├── profile/index.blade.php          → Profil admin (nama + password)
│   └── settings/index.blade.php         → Pengaturan website
├── pages/
│   ├── home.blade.php
│   ├── catalog.blade.php
│   ├── history.blade.php
│   └── contact.blade.php               → Form kontak (POST ke backend)
├── components/
│   ├── navbar.blade.php
│   ├── footer.blade.php
│   └── product-card.blade.php
└── layouts/
    └── app.blade.php

database/
├── migrations/
│   ├── ..._create_users_table.php
│   ├── ..._create_products_table.php
│   ├── ..._create_craftsmen_table.php
│   ├── ..._create_galleries_table.php
│   ├── ..._create_contact_messages_table.php  → ⭐ Baru
│   └── ..._create_settings_table.php           → ⭐ Baru
└── seeders/
    ├── DatabaseSeeder.php
    └── SettingSeeder.php                         → ⭐ Baru (14 settings default)
```

---

## 10. Daftar Route

### Frontend Routes

| Method | URI | Nama Route | Controller | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| GET | `/` | `home` | HomeController@index | Beranda |
| GET | `/catalog` | `catalog` | CatalogController@index | Katalog produk |
| GET | `/history` | `history` | HistoryController@index | Sejarah desa |
| GET | `/contact` | `contact` | ContactController@index | Form kontak (view) |
| POST | `/contact` | `contact.store` | ContactController@store | Kirim pesan (submit) |

### Admin Routes

| Method | URI | Nama Route | Controller | Keterangan |
| :--- | :--- | :--- | :--- | :--- |
| GET | `/admin/login` | `admin.login` | AuthController@showLoginForm | Form login |
| POST | `/admin/login` | `admin.login.post` | AuthController@login | Proses login |
| POST | `/admin/logout` | `admin.logout` | AuthController@logout | Logout |
| GET | `/admin/dashboard` | `admin.dashboard` | DashboardController@index | Dashboard |
| GET | `/admin/products` | `admin.products.index` | ProductController@index | Daftar produk |
| GET | `/admin/products/create` | `admin.products.create` | ProductController@create | Form tambah produk |
| POST | `/admin/products` | `admin.products.store` | ProductController@store | Simpan produk |
| GET | `/admin/products/{id}/edit` | `admin.products.edit` | ProductController@edit | Form edit produk |
| PUT/PATCH | `/admin/products/{id}` | `admin.products.update` | ProductController@update | Update produk |
| DELETE | `/admin/products/{id}` | `admin.products.destroy` | ProductController@destroy | Hapus produk |
| GET | `/admin/craftsmen` | `admin.craftsmen.index` | CraftsmanController@index | Daftar pengrajin |
| GET | `/admin/craftsmen/create` | `admin.craftsmen.create` | CraftsmanController@create | Form tambah pengrajin |
| POST | `/admin/craftsmen` | `admin.craftsmen.store` | CraftsmanController@store | Simpan pengrajin |
| GET | `/admin/craftsmen/{id}/edit` | `admin.craftsmen.edit` | CraftsmanController@edit | Form edit pengrajin |
| PUT/PATCH | `/admin/craftsmen/{id}` | `admin.craftsmen.update` | CraftsmanController@update | Update pengrajin |
| DELETE | `/admin/craftsmen/{id}` | `admin.craftsmen.destroy` | CraftsmanController@destroy | Hapus pengrajin |
| GET | `/admin/gallery` | `admin.gallery.index` | GalleryController@index | Daftar galeri |
| GET | `/admin/gallery/create` | `admin.gallery.create` | GalleryController@create | Form tambah galeri |
| POST | `/admin/gallery` | `admin.gallery.store` | GalleryController@store | Simpan galeri |
| GET | ```

```

 | ```

```

 | ```

```

 | ```

```

 | ```

```

 | `/admin/gallery/{id}/edit` | `admin.gallery.edit` | GalleryController@edit | Form edit galeri |
| PUT/PATCH | `/admin/gallery/{id}` | `admin.gallery.update` | GalleryController@update | Update galeri |
| DELETE | `/admin/gallery/{id}` | `admin.gallery.destroy` | GalleryController@destroy | Hapus galeri |
| GET | `/admin/messages` | `admin.messages.index` | ContactMessageController@index | Daftar pesan (filter: all/unread/read) |
| GET | `/admin/messages/{id}` | `admin.messages.show` | ContactMessageController@show | Detail pesan + mark read |
| DELETE | `/admin/messages/{id}` | `admin.messages.destroy` | ContactMessageController@destroy | Hapus pesan |
| POST | `/admin/messages/mark-all-read` | `admin.messages.markAllRead` | ContactMessageController@markAllRead | Tandai semua dibaca |
| GET | `/admin/profile` | `admin.profile.index` | ProfileController@index | Halaman profil |
| POST | `/admin/profile/name` | `admin.profile.name` | ProfileController@updateName | Ubah nama |
| POST | `/admin/profile/password` | `admin.profile.password` | ProfileController@updatePassword | Ubah password |
| GET | `/admin/settings` | `admin.settings.index` | SettingController@index | Halaman pengaturan |
| PUT | `/admin/settings` | `admin.settings.update` | SettingController@update | Simpan pengaturan |

> 🔒 Semua route dalam group `/admin/*` (kecuali login) dilindungi middleware `auth`.



