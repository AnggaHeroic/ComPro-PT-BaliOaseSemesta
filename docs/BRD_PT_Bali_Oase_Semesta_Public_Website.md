# BUSINESS REQUIREMENTS DOCUMENT (BRD)
## Website Company Profile — PT. BALI OASE SEMESTA

**Status:** Draft  
**Version:** 1.0  
**Scope:** Public-facing website only  
**Implementation phase:** Public frontend before CMS/admin dashboard

---

## 1. Ringkasan Eksekutif

PT. BALI OASE SEMESTA membutuhkan website company profile untuk memperkenalkan perusahaan, menyampaikan bidang kegiatan usaha, dan menyediakan informasi kontak yang mudah ditemukan. Website akan dibangun pada project Laravel tersendiri.

Pengembangan dilakukan bertahap. Tahap pertama berfokus pada halaman publik. Admin dashboard dan CMS direncanakan sebagai tahap lanjutan dengan kemungkinan penggunaan kembali logic backend dari project Laravel PT. PUTRA MAJU SUKSES yang telah selesai.

## 2. Latar Belakang

Website perlu menyajikan profil dan aktivitas usaha perusahaan secara terstruktur, profesional, responsif, dan mudah dipahami. Informasi perusahaan harus bersumber dari data yang telah diberikan atau dikonfirmasi; informasi yang belum tersedia tidak boleh dibuat-buat.

## 3. Informasi Perusahaan

- **Nama:** PT. BALI OASE SEMESTA
- **Email:** balioasesemesta24@gmail.com
- **Telepon:** 085100426891
- **Alamat:** Jalan Moh. Yamin IX No 19 Kel Sumatra Kelod, Kec. Denpasar Timur, Kota Denpasar, Provinsi Bali.

### 3.1 Aktivitas Usaha yang Diberikan

1. Sewa Guna Usaha Tanpa Hak Opsi Intelektual Properti, Bukan Karya Hak Cipta
2. Reproduksi Media Rekaman Film dan Video
3. Perdagangan Besar Alat Tulis dan Gambar
4. Perdagangan Besar Barang Percetakan dan Penerbitan dalam Berbagai Bentuk
5. Portal Web dan/atau Platform Digital Tanpa Tujuan Komersial
6. Penerbitan Buku
7. Penasihat Investasi Berbentuk Perusahaan

Daftar tersebut adalah deskripsi aktivitas yang diberikan untuk kebutuhan konten. Dokumen ini tidak memverifikasi klasifikasi, perizinan, atau kewenangan usaha.

## 4. Tujuan Bisnis

1. Menyediakan kanal resmi untuk informasi perusahaan.
2. Menyampaikan aktivitas usaha dengan struktur yang jelas.
3. Memudahkan pengunjung menemukan informasi kontak perusahaan.
4. Membentuk pengalaman digital yang profesional dan konsisten di perangkat desktop maupun mobile.
5. Menyiapkan fondasi frontend agar kelak dapat dihubungkan ke CMS tanpa membangun ulang seluruh tampilan.

## 5. Pengguna dan Kebutuhan

### 5.1 Pengunjung Umum
- Ingin mengetahui profil dan aktivitas perusahaan.
- Ingin menemukan alamat dan informasi kontak.
- Mengakses website melalui desktop, tablet, atau ponsel.

### 5.2 Calon Mitra atau Pihak Berkepentingan
- Membutuhkan gambaran yang jelas tentang kegiatan perusahaan.
- Membutuhkan informasi kontak yang akurat untuk komunikasi lanjutan.

## 6. Ruang Lingkup

### 6.1 Termasuk dalam Tahap Pertama
- Halaman Beranda.
- Halaman Tentang Kami.
- Halaman Bidang Usaha.
- Halaman detail aktivitas usaha jika bermanfaat dan memiliki konten yang memadai.
- Halaman Kontak.
- Navigasi, footer, komponen UI bersama, dan tautan komunikasi.
- Tampilan responsif, aksesibilitas dasar, serta metadata SEO dasar.
- Penggunaan Laravel dan stack frontend yang telah tersedia pada project saat ini.

### 6.2 Tidak Termasuk dalam Tahap Pertama
- Admin dashboard dan CMS.
- Login, autentikasi admin, dan manajemen role.
- CRUD melalui dashboard.
- Database CMS atau tabel spekulatif yang belum dibutuhkan.
- Integrasi CRM, transaksi, pembayaran, atau portal pelanggan.
- Klaim legal, lisensi, sertifikasi, pencapaian, klien, sejarah, visi, dan misi yang belum dikonfirmasi.

## 7. Kebutuhan Fungsional

- **FR-01:** Pengunjung dapat membuka halaman Beranda.
- **FR-02:** Pengunjung dapat membaca informasi Tentang Kami yang telah dikonfirmasi.
- **FR-03:** Pengunjung dapat melihat daftar aktivitas usaha.
- **FR-04:** Pengunjung dapat membuka detail aktivitas jika halaman detail diterapkan.
- **FR-05:** Pengunjung dapat menemukan email, nomor telepon, dan alamat perusahaan.
- **FR-06:** Navigasi utama dan footer menyediakan tautan yang valid ke halaman publik.
- **FR-07:** Tautan email dan telepon menggunakan skema yang sesuai jika ditampilkan sebagai tautan.
- **FR-08:** Konten yang belum tersedia tidak diisi dengan fakta rekaan; bagian tersebut dihilangkan atau dibuat netral.
- **FR-09:** Struktur konten dan komponen dibuat agar data dapat dipindahkan ke CMS pada fase berikutnya dengan perubahan yang terukur.

## 8. Kebutuhan Nonfungsional

- **NFR-01 Responsif:** Tata letak dapat digunakan pada desktop, tablet, dan ponsel.
- **NFR-02 Aksesibilitas:** Kontras, fokus keyboard, label, dan struktur heading diperhatikan.
- **NFR-03 Kinerja:** Hindari dependensi dan animasi yang tidak diperlukan; optimalkan aset gambar.
- **NFR-04 Konsistensi:** Gunakan pola layout, spacing, tipografi, dan komponen yang konsisten.
- **NFR-05 Pemeliharaan:** Ikuti konvensi project Laravel dan gunakan Blade component untuk UI yang berulang.
- **NFR-06 Akurasi:** Informasi perusahaan harus sesuai dengan sumber yang diberikan atau telah dikonfirmasi.
- **NFR-07 Keamanan:** Tidak ada kredensial atau konfigurasi rahasia yang dimasukkan ke source control.

## 9. Arahan Desain

Arah awal adalah website corporate yang modern, rapi, kredibel, dan tidak berlebihan. Desain final harus diputuskan setelah audit project dan peninjauan referensi visual.

Prinsip:
- Hierarki visual yang jelas.
- Hero section yang ringkas dan relevan.
- Aktivitas usaha ditampilkan dengan struktur yang mudah dipindai.
- Komponen kartu dan section dapat digunakan ulang.
- Animasi bersifat ringan dan hanya jika mendukung pengalaman pengguna.
- Tidak menyalin logo, warna, tipografi, atau identitas visual PT. PUTRA MAJU SUKSES.
- Jangan membuat logo resmi baru tanpa arahan.

## 10. Ketergantungan dan Informasi yang Belum Tersedia

Perlu dikonfirmasi atau diputuskan selama tahap desain:
- Logo resmi dan brand guideline.
- Warna dan tipografi merek.
- Referensi website atau preferensi visual.
- Deskripsi resmi perusahaan.
- Tahun berdiri, visi, misi, dan nilai perusahaan jika ingin ditampilkan.
- Foto, ilustrasi, atau aset visual yang memiliki hak penggunaan.
- Tautan media sosial dan lokasi peta, jika akan ditampilkan.

Tidak semua informasi di atas wajib tersedia untuk memulai layout dasar.

## 11. Kriteria Penerimaan

Website tahap pertama dapat diterima jika:
1. Semua halaman publik yang disepakati tersedia dan dapat diakses.
2. Navigasi antarhalaman berfungsi.
3. Informasi kontak dan aktivitas usaha akurat.
4. Layout responsif pada ukuran layar utama.
5. Tidak ada gambar rusak atau tautan internal yang diketahui rusak.
6. Build frontend berhasil menggunakan konfigurasi project.
7. Tidak ada klaim perusahaan yang tidak didukung.
8. Admin dashboard dan CMS tidak dibangun pada tahap ini.
9. Implementasi tidak merusak fungsi project yang sudah ada.

## 12. Risiko dan Mitigasi

- **Informasi perusahaan terbatas:** gunakan konten yang tersedia dan tandai kebutuhan konfirmasi.
- **Desain belum ditetapkan:** minta proposal visual sebelum implementasi penuh.
- **Integrasi CMS di masa depan:** pisahkan konten dari markup sejauh wajar tanpa membangun abstraksi berlebihan.
- **Perbedaan antarproject Laravel:** audit versi dan dependency sebelum mengambil pola dari project referensi.
- **Salah klaim aktivitas atau legalitas:** jangan menambahkan kode KBLI, izin, atau klaim layanan yang tidak diberikan.

## 13. Tahapan Pelaksanaan

1. Audit project Laravel saat ini.
2. Usulkan struktur halaman dan arah desain.
3. Implementasikan Beranda.
4. Implementasikan halaman publik lain yang disepakati.
5. Uji responsivitas, navigasi, build, dan akurasi konten.
6. Dokumentasikan bagian yang nantinya dapat dihubungkan ke CMS.

Admin dashboard dan CMS akan dibahas dalam fase terpisah.
