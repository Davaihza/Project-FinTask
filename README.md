# FinTask

FinTask adalah aplikasi web sederhana berbasis Laravel untuk mengelola **Task** (tugas) dan **Financial Records** (catatan keuangan) secara modern, rapi, dan user-friendly.

---

## ✨ Fitur Utama

- **Manajemen Task**
  - Tambah, edit, hapus, dan lihat detail task
  - Upload gambar untuk setiap task
  - Status task: Completed (Yes/No) dengan badge warna cerah
  - Filter dan pencarian task

- **Manajemen Financial Record**
  - Tambah, edit, hapus, dan lihat detail catatan keuangan
  - Upload gambar untuk setiap record
  - Tipe: Income/Expense dengan badge warna cerah
  - Filter dan pencarian record

- **Dashboard Modern**
  - Ringkasan task & keuangan
  - Tabel task dan financial terbaru, bisa klik untuk lihat detail
  - Statistik jumlah task, income, expense, dan balance

- **Profile**
  - Update nama, email, password, dan avatar

- **UI/UX**
  - Sidebar dan tampilan konsisten di semua halaman
  - Responsive & mobile friendly
  - Badge status warna cerah, notifikasi, dan konfirmasi aksi

---

## 📸 Screenshot

![Dashboard Screenshot](public/images/logo_zerotwo_dashboard.png)

---

## 🚀 Cara Install & Jalankan

1. **Clone repo**
   ```sh
   git clone https://github.com/Davaihza/Project-FinTask.git
   cd Project-FinTask
   ```

2. **Install dependency**
   ```sh
   composer install
   npm install
   ```

3. **Copy file env & generate key**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

4. **Atur database di file `.env`**

5. **Migrate & seed database**
   ```sh
   php artisan migrate --seed
   ```

6. **Buat storage link**
   ```sh
   php artisan storage:link
   ```

7. **Jalankan server**
   ```sh
   php artisan serve
   ```

---

## ⚠️ Catatan

- Jangan lupa atur permission folder `storage` dan `bootstrap/cache` jika di server Linux.
- File gambar yang diupload akan tersimpan di `storage/app/public` dan bisa diakses via `public/storage`.

---

## 🤝 Kontribusi

Pull request dan issue sangat diterima untuk pengembangan lebih lanjut!

---

## 📄 Lisensi

MIT License

---

> Dibuat dengan ❤️ oleh [Davaihza](https://github.com/Davaihza)
