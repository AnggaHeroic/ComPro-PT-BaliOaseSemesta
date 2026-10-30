# PRODUCT REQUIREMENTS DOCUMENT (PRD)
## Website Company Profile — PT. BALI OASE SEMESTA

**Status:** Draft  
**Version:** 1.0  
**Platform:** Responsive web  
**Framework:** Laravel (existing project), Blade/Tailwind/Vite if already configured  
**Phase:** Public website only

---

## 1. Product Summary

Produk adalah website publik PT. BALI OASE SEMESTA yang menyajikan profil perusahaan, aktivitas usaha, dan informasi kontak. Website dibangun dalam folder Laravel terpisah dari project PT. PUTRA MAJU SUKSES.

Fase ini tidak mencakup admin dashboard atau CMS. Frontend perlu dibuat dengan struktur yang mudah dipelihara dan masuk akal untuk dihubungkan ke CMS di kemudian hari.

## 2. Product Goals

- Pengunjung dapat memahami identitas dan aktivitas usaha perusahaan.
- Pengunjung dapat menemukan kontak perusahaan dengan cepat.
- Website memiliki tampilan profesional, responsif, dan konsisten.
- Kode mudah dipelihara dan mengikuti struktur project Laravel yang ada.
- Konten tidak bergantung pada klaim atau informasi perusahaan yang belum diverifikasi.

## 3. Non-Goals

- CMS, admin dashboard, login, role management, dan CRUD admin.
- Integrasi database untuk konten jika belum dibutuhkan oleh project saat ini.
- E-commerce, transaksi, pembayaran, CRM, atau portal pelanggan.
- Pembuatan logo resmi atau klaim perusahaan tanpa arahan dan bukti.

## 4. Target Users

### Primary
Pengunjung umum yang ingin mengetahui perusahaan dan aktivitas usahanya.

### Secondary
Calon mitra atau pihak berkepentingan yang ingin mencari informasi kontak dan memahami ruang lingkup usaha.

## 5. Information Architecture

### 5.1 Global Navigation
- Beranda
- Tentang Kami
- Bidang Usaha
- Kontak

Halaman detail aktivitas merupakan opsi dan hanya dibuat jika memberi nilai bagi pengunjung.

### 5.2 Page Requirements

#### A. Beranda (`/`)
Tujuan: memberikan gambaran awal perusahaan dan mengarahkan pengunjung ke informasi penting.

Bagian yang direkomendasikan:
1. Header dan navigasi.
2. Hero dengan pengenalan ringkas dan CTA yang relevan.
3. Ringkasan perusahaan berdasarkan informasi terverifikasi.
4. Ringkasan aktivitas usaha.
5. Bagian keunggulan hanya jika ada fakta yang mendukung; jika tidak, jangan membuat klaim generik yang seolah-olah faktual.
6. CTA menuju halaman Bidang Usaha atau Kontak.
7. Footer berisi navigasi dan kontak.

#### B. Tentang Kami (`/tentang-kami`)
Tujuan: menyajikan informasi perusahaan yang tersedia secara jelas.

Konten:
- Nama perusahaan.
- Deskripsi perusahaan hanya setelah disetujui atau ditulis secara netral berdasarkan aktivitas yang diberikan.
- Visi, misi, sejarah, atau nilai perusahaan hanya jika informasinya tersedia dan dikonfirmasi.

Jika konten belum memadai, buat halaman ringkas yang berguna atau sarankan untuk menunda halaman ini; jangan mengarang sejarah atau visi-misi.

#### C. Bidang Usaha (`/bidang-usaha`)
Tujuan: membantu pengunjung menelusuri aktivitas usaha perusahaan.

Tampilkan tujuh aktivitas yang diberikan:
1. Sewa Guna Usaha Tanpa Hak Opsi Intelektual Properti, Bukan Karya Hak Cipta.
2. Reproduksi Media Rekaman Film dan Video.
3. Perdagangan Besar Alat Tulis dan Gambar.
4. Perdagangan Besar Barang Percetakan dan Penerbitan dalam Berbagai Bentuk.
5. Portal Web dan/atau Platform Digital Tanpa Tujuan Komersial.
6. Penerbitan Buku.
7. Penasihat Investasi Berbentuk Perusahaan.

Persyaratan:
- Tampilkan judul dengan keterbacaan baik.
- Gunakan pengelompokan hanya jika masuk akal dan tidak mengubah makna deskripsi.
- Jangan menambahkan kode KBLI atau klaim perizinan yang belum diverifikasi.
- Deskripsi tambahan harus ditinjau sebelum dipublikasikan.

#### D. Detail Aktivitas (opsional)
Tujuan: memberi penjelasan lebih lanjut untuk aktivitas tertentu.

Buat hanya jika tersedia konten yang memadai. Jika tidak, gunakan halaman daftar aktivitas sebagai tujuan navigasi.

#### E. Kontak (`/kontak`)
Tujuan: memudahkan pengunjung menghubungi perusahaan.

Data:
- Email: balioasesemesta24@gmail.com
- Telepon: 085100426891
- Alamat: Jalan Moh. Yamin IX No 19 Kel Sumatra Kelod, Kec. Denpasar Timur, Kota Denpasar, Provinsi Bali.

Interaksi:
- Email menggunakan tautan `mailto:` bila sesuai.
- Telepon menggunakan tautan `tel:` bila sesuai.
- Peta atau formulir kontak bersifat opsional dan hanya ditambahkan setelah kebutuhan serta data pendukung dipastikan.

## 6. UX and Visual Requirements

- Corporate, modern, rapi, dan kredibel.
- Hierarki visual dan heading yang konsisten.
- Navigasi mudah ditemukan dan dapat digunakan pada mobile.
- Layout tidak bergantung pada ukuran layar desktop.
- Spacing, warna, radius, dan tipografi konsisten.
- Animasi ringan, tidak menghambat navigasi atau aksesibilitas.
- Status hover, focus, dan active jelas.
- Tidak menggunakan logo atau brand color dari perusahaan referensi.
- Jika brand guideline belum tersedia, usulkan konsep visual untuk persetujuan.

## 7. Technical Requirements

1. Audit project sebelum mengubah kode.
2. Pertahankan versi Laravel/PHP dan dependency yang sudah dipakai kecuali ada alasan teknis yang jelas.
3. Gunakan Blade, Tailwind CSS, dan Vite jika memang sudah dikonfigurasi.
4. Gunakan layout dan komponen Blade untuk elemen berulang.
5. Pisahkan data konten dari markup jika sederhana dan bermanfaat.
6. Jangan membangun skema database CMS spekulatif.
7. Jangan menyalin `.env`, kredensial, atau database project referensi.
8. Jangan melakukan perubahan luas yang tidak terkait kebutuhan halaman publik.

## 8. Content and Data Rules

Informasi perusahaan yang diberikan:
- PT. BALI OASE SEMESTA
- Email: balioasesemesta24@gmail.com
- Telepon: 085100426891
- Alamat: Jalan Moh. Yamin IX No 19 Kel Sumatra Kelod, Kec. Denpasar Timur, Kota Denpasar, Provinsi Bali.

Jangan membuat informasi berikut tanpa konfirmasi:
- Tahun berdiri atau sejarah perusahaan.
- Visi, misi, dan nilai perusahaan.
- Logo resmi, sertifikasi, lisensi, atau izin.
- Klien, mitra, portofolio, dan pencapaian.
- Kode KBLI.
- Klaim mengenai layanan atau izin investasi.
- Akun media sosial atau URL yang belum diberikan.

## 9. Acceptance Criteria

### Functional
- [ ] Pengunjung dapat mengakses halaman Beranda.
- [ ] Pengunjung dapat mengakses Tentang Kami jika halaman tersebut memiliki konten memadai.
- [ ] Pengunjung dapat melihat tujuh aktivitas usaha yang diberikan.
- [ ] Pengunjung dapat menemukan kontak perusahaan.
- [ ] Navigasi dan footer mengarah ke halaman yang benar.
- [ ] Link email dan telepon berfungsi sesuai perangkat.

### UI/UX
- [ ] Layout berfungsi pada desktop, tablet, dan mobile.
- [ ] Heading, spacing, dan komponen konsisten.
- [ ] Focus keyboard dan kontras dasar diperhatikan.
- [ ] Tidak ada gambar rusak atau konten yang terpotong secara signifikan.

### Technical
- [ ] Route publik berjalan.
- [ ] Build frontend berhasil dengan konfigurasi yang ada.
- [ ] Tidak ada error yang diketahui akibat perubahan.
- [ ] Tidak ada perubahan admin/CMS dalam fase ini.
- [ ] Tidak ada informasi perusahaan yang dibuat-buat.

## 10. Suggested Implementation Plan

### Phase 1 — Audit
Periksa struktur project, versi framework, dependency, route, Blade, CSS, dan Vite. Laporkan kondisi awal tanpa mengubah file.

### Phase 2 — Design Proposal
Usulkan:
- Sitemap.
- Urutan section Beranda.
- Konsep visual.
- Palet warna dan tipografi sebagai usulan.
- Komponen reusable.
- Perilaku responsive.

### Phase 3 — Home Page
Implementasikan Beranda dan validasi desain desktop/mobile.

### Phase 4 — Remaining Public Pages
Implementasikan halaman Tentang Kami, Bidang Usaha, dan Kontak sesuai konten yang tersedia.

### Phase 5 — Verification
Periksa route, navigasi, responsivitas, build, aksesibilitas dasar, dan akurasi konten.

### Future Phase — CMS
Dalam fase terpisah, audit project PT. PUTRA MAJU SUKSES dan tentukan logic backend yang dapat digunakan kembali. Jangan mengerjakan fase ini sekarang.

## 11. Deliverables

- Sitemap dan rancangan section.
- Website publik yang diimplementasikan.
- Daftar file yang dibuat/diubah.
- Catatan komponen reusable.
- Hasil build dan pengujian.
- Daftar konten yang masih membutuhkan konfirmasi.
