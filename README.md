[Lihat DFD Proyek](./docs/DFD-Penjualan-Barang.pdf)


# CRUD Penjualan dengan Laravel dan jQuery

Proyek ini adalah aplikasi sederhana untuk mengelola data penjualan menggunakan framework **Laravel** di backend dan **jQuery** di frontend. Aplikasi ini menyediakan fungsionalitas **CRUD (Create, Read, Update, Delete)** untuk data penjualan dengan tampilan antarmuka yang dinamis.

## Fitur

- **Tambah Data Penjualan**: Pengguna dapat menambahkan data penjualan baru melalui formulir.
- **Lihat Data Penjualan**: Data penjualan ditampilkan dalam bentuk tabel, dengan kolom untuk produk, jumlah, harga, dan total.
- **Edit Data Penjualan**: Pengguna dapat mengedit data penjualan yang ada.
- **Hapus Data Penjualan**: Pengguna dapat menghapus data penjualan tertentu dari tabel.

## Persyaratan

- PHP >= 7.4
- Composer
- Node.js dan npm
- Laravel 11
- Database (Mysql)

## Instalasi

Ikuti langkah-langkah di bawah ini untuk menginstal proyek ini secara lokal:

1. **Clone repositori** ini:

    ```bash
    git clone https://github.com/username/crud-penjualan.git
    cd crud-penjualan
    ```

2. **Instal dependensi Laravel**:

    ```bash
    composer install
    ```

3. **Instal dependensi front-end**:

    ```bash
    npm install
    npm run dev
    ```

4. **Buat file `.env`** dan konfigurasikan database Anda:

    ```bash
    cp .env.example .env
    ```

5. **Generate key aplikasi**:

    ```bash
    php artisan key:generate
    ```

6. **Migrasi database**:

    ```bash
    php artisan migrate
    ```

7. **Jalankan server lokal**:

    ```bash
    php artisan serve
    ```

Aplikasi sekarang akan berjalan di `http://localhost:8000`.

## Struktur Proyek

- `routes/web.php`: Definisi route untuk aplikasi, termasuk endpoint CRUD.
- `app/Http/Controllers/PenjualanController.php`: Controller untuk menangani logika bisnis CRUD penjualan.
- `resources/views/penjualan.blade.php`: Tampilan utama untuk antarmuka CRUD.
- `public/js/app.js`: File JavaScript untuk AJAX dan jQuery.
  
## Penggunaan

1. **Menambahkan Data Penjualan**
   - Isi formulir dengan nama produk, jumlah, dan harga.
   - Klik tombol **Tambah Penjualan** untuk menambah data baru ke dalam tabel.

2. **Melihat Data Penjualan**
   - Semua data penjualan akan ditampilkan dalam tabel setelah di-load.

3. **Mengedit Data Penjualan**
   - Klik tombol **Edit** di baris data yang ingin Anda ubah.
   - Formulir akan menampilkan data yang dipilih, memungkinkan Anda untuk memperbarui data.
   - Klik tombol **Perbarui Penjualan** untuk menyimpan perubahan.

4. **Menghapus Data Penjualan**
   - Klik tombol **Hapus** pada baris data yang ingin Anda hapus.
   - Data akan dihapus dari tabel dan database.

## Teknologi yang Digunakan

- **Laravel** - Framework backend
- **jQuery** - Library JavaScript untuk manipulasi DOM dan AJAX
