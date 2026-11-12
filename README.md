# MatchMate — Demo Penilaian Berbobot

Demo Laravel 12/PHP 8.2 dengan Blade, Tailwind CSS, dan Vite untuk mengeksplorasi penilaian lima kriteria serta ranking kandidat contoh.

## Perilaku
- Form nama, URL foto opsional, dan lima nilai 1–5.
- Normalisasi nilai menjadi bobot, identifikasi nilai terbesar/terkecil, dan ranking kandidat statis.
- Hasil dan rekomendasi disimpan dalam session; tidak menggunakan layanan pencarian pasangan atau AI.
- Data kandidat dan avatar eksternal merupakan contoh tampilan.

Kode menggunakan istilah BWM, tetapi implementasi saat ini **normalisasi nilai dan penjumlahan berbobot**, bukan penyelesaian model optimasi formal Best-Worst Method. Nilai consistency_index yang ditampilkan juga indikator sederhana, bukan rasio konsistensi BWM formal.

## Setup lokal
Prasyarat PHP 8.2+, Composer, Node.js 18+, dan PDO SQLite.
1. `composer install` dan `npm ci`.
2. Salin `.env.example` menjadi `.env`.
3. `php artisan key:generate`.
4. `npm run build`.
5. `php artisan serve`.
6. Buka `/penilaian`, kirim form, lalu lihat `/hasil` dan `/rekomendasi`.

Session dan cache default memakai berkas sehingga alur penilaian tidak membutuhkan MySQL. Jika memakai fitur database framework, buat SQLite kosong pada `database/database.sqlite` dan jalankan `php artisan migrate`.

## Verifikasi
```bash
php artisan test
npm run build
```

Repository tidak memuat database, session pengguna, environment lokal, atau dependency.
