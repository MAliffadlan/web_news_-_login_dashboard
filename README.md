# Sistem Berita dengan Dashboard Admin

Website berita dengan fitur CRUD (Create, Read, Update, Delete) dan dashboard admin modern.

## 📋 Fitur

### User/Pengunjung
- Halaman utama dengan berita terbaru
- Baca berita lengkap
- Arsip berita berdasarkan kategori
- Desain responsive

### Admin Dashboard
- Login & Register admin
- Dashboard dengan statistik
- Kelola berita (Tambah, Edit, Hapus)
- Kelola kategori berita
- Session management

## 🛠️ Teknologi

- **Backend:** PHP (mysqli)
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Server:** Apache (XAMPP)

## 📦 Instalasi

### 1. Persiapan
- Install XAMPP: https://www.apachefriends.org
- Jalankan Apache dan MySQL

### 2. Clone/Download Project
```bash
git clone https://github.com/USERNAME/REPO_NAME.git
```
Atau download ZIP dan extract ke `C:\xampp\htdocs\`

### 3. Setup Database

**Opsi A: Otomatis (Mudah)**
1. Buka browser: `http://localhost/uts_alif_web_login/setup_database.php`
2. Tunggu sampai selesai
3. Klik "Login Sekarang"

**Opsi B: Manual via phpMyAdmin**
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Import file SQL berurutan:
   - `berita_database.sql` (database + tabel berita & kategori)
   - `user_database.sql` (tabel user untuk login)

### 4. Akses Website

**Halaman Utama:**
```
http://localhost/uts_alif_web_login/
```

**Login Admin:**
```
http://localhost/uts_alif_web_login/login.php
```

**Default Login:**
- Username: `admin`
- Password: `admin`

## 📂 Struktur File

```
uts_alif_web_login/
├── index.php              # Halaman utama
├── login.php              # Login admin
├── register.php           # Registrasi admin
├── dashboard.php          # Dashboard admin
├── input_berita.php       # Tambah berita
├── edit_berita.php        # Edit berita
├── delete_berita.php      # Hapus berita
├── berita_lengkap.php     # Detail berita
├── arsip_berita.php       # Arsip berita
├── koneksi.php            # Koneksi database
├── logout.php             # Logout
├── setup_database.php     # Auto install database
├── test_database.php      # Test koneksi database
├── berita_database.sql    # SQL database berita
├── user_database.sql      # SQL tabel user
├── style.css              # Styling
└── DATABASE_README.txt    # Panduan database
```

## 🎨 Screenshot

### Halaman Utama
![Homepage](screenshots/homepage.png)

### Dashboard Admin
![Dashboard](screenshots/dashboard.png)

### Login Page
![Login](screenshots/login.png)

## 🔐 Keamanan

⚠️ **PENTING untuk Production:**
- Ganti password default admin
- Gunakan password hashing (bcrypt/password_hash)
- Validasi dan sanitasi semua input
- Gunakan prepared statements
- Aktifkan HTTPS

## 📝 Cara Penggunaan

### Menambah Berita
1. Login sebagai admin
2. Klik "Tambah Berita" di dashboard
3. Isi form (judul, kategori, headline, isi, pengirim)
4. Klik "Input Berita"

### Edit/Hapus Berita
1. Login sebagai admin
2. Di dashboard, klik tombol "Edit" atau "Hapus" pada berita
3. Untuk edit: ubah data lalu simpan
4. Untuk hapus: konfirmasi penghapusan

### Menambah Admin Baru
1. Buka halaman login
2. Klik "Belum punya akun? Daftar disini"
3. Isi form registrasi
4. Login dengan akun baru

## 🐛 Troubleshooting

### Database Error
→ Pastikan MySQL XAMPP sudah running
→ Jalankan `setup_database.php` untuk install ulang database

### Login Gagal
→ Cek database `pw2` tabel `user` ada atau tidak
→ Cek username/password di database

### Data Tidak Muncul
→ Refresh halaman atau browser
→ Cek koneksi di `koneksi.php`

## 👤 Author

**Alif**
- UTS Pemrograman Web

## 📄 License

Free to use for educational purposes.

## 🙏 Credits

Design template: Nasril (Aril)
