# NewsHub

**NewsHub** adalah aplikasi portal berita berbasis Laravel 12, dilengkapi dengan fitur manajemen artikel, kategori, trending, editor's pick, komentar, dan dashboard admin menggunakan Filament 3.

---

## Fitur Utama

- Manajemen artikel, kategori, tag, dan penulis
- Fitur trending & editor's pick
- Komentar & balasan
- Statistik pembaca & views
- Dashboard admin modern (Filament)
- Pencarian artikel (fulltext)
- Iklan/banner dinamis
- Responsive & modern UI (TailwindCSS)

---

## Persyaratan

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL/MariaDB (atau database lain yang didukung Laravel)
- [Ekstensi PHP yang dibutuhkan Laravel](https://laravel.com/docs/12.x/deployment#server-requirements)

---

## Instalasi

1. **Clone Repository**
    ```bash
    git clone https://github.com/username/laravel-portal-news.git
    cd laravel-portal-news
    ```

2. **Install Dependency PHP**
    ```bash
    composer install
    ```

3. **Install Dependency Frontend**
    ```bash
    npm install
    ```

4. **Copy File Environment**
    ```bash
    cp .env.example .env
    ```

5. **Generate Key**
    ```bash
    php artisan key:generate
    ```

6. **Atur Konfigurasi Database**
    - Edit file `.env` dan sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD sesuai database Anda.

7. **Jalankan Migrasi & Seeder**
    ```bash
    php artisan migrate --seed
    ```

8. **Build Asset Frontend**
    ```bash
    npm run build
    ```
    atau untuk development:
    ```bash
    npm run dev
    ```

9. **Jalankan Server**
    ```bash
    php artisan serve
    ```

10. **Akses Aplikasi**
    - Buka [http://localhost:8000](http://localhost:8000) di browser.

---

## Login Admin Filament

- Akses dashboard admin di: `/admin`
- Default user (jika ada seeder):  
  - **Email:** admin@example.com  
  - **Password:** password

---

## Fitur Tambahan

- **Filament Shield** untuk manajemen role & permission
- **Filament Breezy** untuk manajemen profil user
- **Upload gambar artikel & avatar penulis**
- **Fulltext search** (pastikan sudah migrate index fulltext di tabel `articles`)

---

## Kontribusi

1. Fork repo ini
2. Buat branch fitur: `git checkout -b fitur-baru`
3. Commit perubahan: `git commit -am 'Tambah fitur baru'`
4. Push ke branch: `git push origin fitur-baru`
5. Buat Pull Request

---

## Lisensi

MIT

---

**Dibuat dengan ❤️ menggunakan Laravel & Filament**