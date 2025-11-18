# EduTrack – Platform Kursus Daring Modern

Dokumen ini mendeskripsikan rancangan platform kursus daring yang berfokus pada pengalaman belajar interaktif antara guru dan siswa. Seluruh fitur di bawah memastikan kebutuhan tiap peran terpenuhi serta menghadirkan tampilan UI modern dan logika bisnis yang konsisten.

## 1. Gambaran Umum
- **Tujuan**: Menyediakan proses pembelajaran terpandu lengkap dengan manajemen konten, interaksi guru–siswa, serta pelacakan progres.
- **Segmentasi pengguna**: Admin, Teacher, Student, dan Public User (Guest).
- **Nilai utama**: Workflow CMS terpadu, tampilan clean dengan hierarki visual jelas, penggunaan komponen responsif dan aksesibilitas tinggi.

## 2. Level Pengguna
| Peran | Akses dan Tanggung Jawab |
| --- | --- |
| **Admin** | Mengelola platform secara menyeluruh: CRUD user, course, konten, dan kategori. Memiliki kendali audit trail dan status kursus. |
| **Teacher** | Mengelola konten course, jadwal, materi, serta memantau progres siswa. Bisa mengarsipkan course pribadi. |
| **Student** | Mengikuti course, membaca materi, menandai progres, dan menghubungi teacher. |
| **Public User (Guest)** | Hanya melihat daftar course publik, diarahkan untuk registrasi/login. |

## 3. Modul CMS Utama
### 3.1 User Management (Admin)
- **List Users**: Tabel responsif dengan pencarian, filter peran, pagination.
- **Create User**: Field `username`, `email`, `password`, `role`, `status`. Validasi wajib.
- **Edit User**: Dapat ubah `nama`, `email`, `role`, `status`. Password opsional.
- **Delete User**: Soft delete dengan konfirmasi modal.

### 3.2 Course Management (Admin, Teacher)
- **List Course**: Grid/ table dengan informasi ringkas (nama, teacher, kategori, tanggal mulai, status).
- **Create Course**:
  - Field: `nama`, `deskripsi`, `kategori`, `teacher`, `jadwal`, `status`.
  - Validasi tanggal dan status aktif/nonaktif.
- **Edit Course**: Update detail, jadwal, serta mengatur publikasi.
- **Delete Course**: Soft delete; teacher hanya dapat menghapus course buatan sendiri.

### 3.3 Category Management (Admin)
- CRUD kategori dengan filter warna/icon agar navigasi katalog lebih modern.
- Ketika kategori dihapus, course terkait harus dipetakan ulang.

### 3.4 Content Management (Teacher)
- **List Content**: Outline materi per course (judul, tipe konten, durasi, status).
- **Create/Edit Content**:
  - Field: `judul`, `isi`, `media`, `prasyarat`, `estimasi waktu`.
  - Validasi urutan modul dan lampiran.
- **Delete Content**: Konfirmasi wajib; apabila konten terakhir, course otomatis diberi status "draft".

## 4. Panduan Tampilan & Alur
1. **Login / Register Page**
   - Desain split-screen dengan ilustrasi edukatif.
   - Akses tunggal untuk Admin, Teacher, Student (role ditetapkan saat registrasi).
2. **Dashboard**
   - Kartu ringkasan (jumlah course aktif, siswa baru, progres rata-rata).
   - Menu samping dengan ikon minimalis.
3. **Course Catalog**
   - Kartu course berisi cover, kategori, rating, durasi. Tombol CTA "Ikuti" atau "Hubungi Teacher".
4. **User Profile Page**
   - Bagian data personal dan tab progres belajar.
   - Student melihat riwayat course dan status penyelesaian.
5. **Lesson Pages**
   - Layout dua kolom (navigasi modul + konten).
   - Fitur "Mark as Done", progress tracker, tombol "Lanjutkan" ke materi berikutnya.

## 5. Fitur Lanjutan (Opsional)
1. **Discussion Forum**: Thread per course, dukungan reply bertingkat serta mention @username.
2. **Certificate Issuance**: Generate sertifikat otomatis setelah 100% progres dan nilai minimal tertentu.
3. **Progress Analytics**: Grafik per siswa serta heatmap engagement harian.

## 6. Prinsip Implementasi
- Gunakan komponen UI konsisten (misal, Design System internal atau Tailwind + UI kit).
- Pastikan seluruh input memiliki validasi sisi klien dan server.
- Terapkan arsitektur modular agar logic CMS mudah diuji.
- Sertakan dokumentasi API/endpoint untuk integrasi lanjutan.

Dokumen ini menjadi referensi tunggal untuk memastikan tampilan modern dan logika bisnis platform kursus berjalan sesuai harapan.
