# Laravel Shadcn Admin Dashboard – Leprindo

Sebuah dashboard admin modern, responsif, dan aksesibel yang dibangun dengan **Shadcn UI**, **Laravel**, dan **Vite**. Proyek ini mengintegrasikan komponen UI dari Shadcn dengan kekuatan backend Laravel serta Inertia.js, sehingga memberikan pengalaman pengembangan yang mulus untuk sistem **Leprindo**.

![alt text](public/images/shadcn-admin.png)

Proyek ini terinspirasi dari [Shadcn-admin](https://github.com/satnaing/shadcn-admin) dan telah diadaptasi agar bekerja dengan Laravel dan Inertia.js.

## Fitur

* Mode terang/gelap
* Responsif
* Aksesibel
* Sidebar bawaan
* Pencarian global (Command Search)
* Lebih dari 10 halaman siap pakai
* Komponen kustom tambahan

## Teknologi yang Digunakan

**UI:** [ShadcnUI](https://ui.shadcn.com) (TailwindCSS + RadixUI)
**Backend:** [Laravel](https://laravel.com/) 12.x
**Integrasi Frontend:** [InertiaJs](https://inertiajs.com/)
**Build Tool:** [Vite](https://vitejs.dev/)
**Type Checking:** [TypeScript](https://www.typescriptlang.org/)
**Linting/Formatting:** [Eslint](https://eslint.org/) & [Prettier](https://prettier.io/)
**Ikon:** [Tabler Icons](https://tabler.io/icons)

## Menjalankan Secara Lokal

1. Clone repositori

   ```bash
   git clone git@github.com:binjuhor/leprindo.git
   ```

2. Masuk ke direktori proyek

   ```bash
   cd leprindo
   ```

3. Install dependensi

   * Dependensi JavaScript:

     ```bash
     pnpm install
     ```
   * Dependensi PHP:

     ```bash
     composer install
     ```
   * Migrasi database:

     ```bash
     php artisan migrate
     ```

4. Jalankan server pengembangan

   * Server Vite:

     ```bash
     pnpm run dev
     ```
   * Server Laravel:

     ```bash
     php artisan serve
     ```

5. Buka browser dan akses [http://localhost:8000](http://localhost:8000) untuk melihat dashboard.

## Panduan CI/CD

Proyek ini menggunakan workflow otomatis dengan **GitHub Actions** yang terdapat di folder `.github/workflows/`. Workflow ini mendukung integrasi berkelanjutan (CI) dan deployment berkelanjutan (CD).

### Workflow yang Tersedia

#### 1. Workflow Tes (`test.yml`)

Berjalan otomatis setiap ada push ke branch `main`:

* Setup PHP 8.2 + ekstensi yang dibutuhkan
* Setup environment (`.env` dan app key)
* Install dependensi Composer
* Build frontend (Node.js + Vite)
* Setup database SQLite untuk testing
* Menjalankan tes PHPUnit/Pest

#### 2. Workflow Deploy (`deploy.yml`)

Deployment ke server produksi jika push ke branch `main` berhasil:

* Deploy kode menggunakan rsync
* Build frontend
* Install/Update dependensi Composer
* Menjalankan migrasi database
* Clear & optimasi cache aplikasi
* Restart service Docker

### Secret yang Dibutuhkan

* `PRIVATE_KEY` - SSH private key untuk akses server
* `SSH_HOST` - Hostname/IP server produksi
* `SSH_USER` - Username SSH
* `WORK_DIR` - Path direktori aplikasi di server
* `DOCKER_DIR` - Path direktori Docker compose di server

### Alur Pengembangan Lokal

1. Sebelum commit:

   ```bash
   php artisan test
   pnpm run build
   pnpm run lint
   ```

2. Push ke branch `main`:

   * Workflow tes otomatis dijalankan
   * Jika lulus tes → deployment dimulai
   * Pantau proses di tab GitHub Actions

### Kustomisasi Workflow

* Edit `.github/workflows/test.yml` → konfigurasi tes
* Edit `.github/workflows/deploy.yml` → langkah deployment
* Tambahkan quality checks (code style, analisis statis, security scan) bila diperlukan

## Roadmap

Fitur yang direncanakan:

* **Manajemen Role & Permission**
* **Manajemen Profil Pengguna**
* **Manajemen Post & Halaman**
* **Manajemen Tema & Plugin**
* **Manajemen File & Media**

## Lisensi

Proyek ini bersifat open-source dan dilisensikan di bawah [MIT License](https://choosealicense.com/licenses/mit/).