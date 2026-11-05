<?php

/*
 * Data publik perusahaan. Hanya berisi informasi yang diberikan di BRD/PRD.
 * Dipisahkan dari markup agar kelak mudah dipindahkan ke CMS.
 */
return [
    'name' => 'PT. BALI OASE SEMESTA',
    'short_name' => 'Bali Oase Semesta',

    'email' => 'balioasesemesta24@gmail.com',
    'phone' => '085100426891',
    // Format internasional untuk tautan tel: dan WhatsApp-style rendering.
    'phone_href' => '+6285100426891',
    'address' => 'Jalan Moh. Yamin IX No 19, Kel. Sumatra Kelod, Kec. Denpasar Timur, Kota Denpasar, Provinsi Bali.',
    'maps_url' => 'https://maps.app.goo.gl/Z66zQH5FvfYzCuMq5',
    'city' => 'Denpasar, Bali',

    // Nama route => label. Item yang route-nya belum terdaftar tidak ditampilkan.
    'nav' => [
        'home' => 'Beranda',
        'about' => 'Tentang Kami',
        'activities' => 'Layanan & Jasa',
        'contact' => 'Kontak',
    ],

    // Judul persis seperti yang diberikan (BRD §3.1).
    'activities' => [
        'Sewa Guna Usaha Tanpa Hak Opsi Intelektual Properti, Bukan Karya Hak Cipta',
        'Reproduksi Media Rekaman Film dan Video',
        'Perdagangan Besar Alat Tulis dan Gambar',
        'Perdagangan Besar Barang Percetakan dan Penerbitan dalam Berbagai Bentuk',
        'Portal Web dan/atau Platform Digital Tanpa Tujuan Komersial',
        'Penerbitan Buku',
        'Penasihat Investasi Berbentuk Perusahaan',
    ],

    // Slug URL halaman detail, urutan sama dengan 'activities'. Harus unik dan tidak berubah setelah dipublikasikan.
    'activity_slugs' => [
        'sewa-guna-usaha',
        'reproduksi-media-rekaman',
        'perdagangan-alat-tulis-dan-gambar',
        'perdagangan-barang-percetakan-dan-penerbitan',
        'portal-web-platform-digital',
        'penerbitan-buku',
        'penasihat-investasi',
    ],

    // Nama ikon (components/activity-icon) untuk tiap aktivitas, urutannya sama dengan 'activities'.
    'activity_icons' => ['rental', 'film', 'stationery', 'printing', 'web', 'book', 'advisory'],

    // Deskripsi singkat, urutan sama dengan 'activities'. Hanya memparafrasekan judul (tanpa klaim tambahan); ganti dengan deskripsi resmi bila tersedia.
    'activity_descriptions' => [
        'Kegiatan usaha sewa guna usaha tanpa hak opsi, atas objek yang bukan merupakan karya hak cipta maupun intelektual properti.',
        'Kegiatan usaha reproduksi media rekaman berupa film dan video.',
        'Kegiatan usaha perdagangan besar alat tulis dan alat gambar.',
        'Kegiatan usaha perdagangan besar barang percetakan dan penerbitan dalam berbagai bentuk.',
        'Kegiatan usaha portal web dan/atau platform digital yang tidak bertujuan komersial.',
        'Kegiatan usaha di bidang penerbitan buku.',
        'Kegiatan usaha penasihat investasi yang dijalankan dalam bentuk perusahaan.',
    ],

    // ID foto PLACEHOLDER (picsum.photos) untuk tiap aktivitas, urutan sama dengan 'activities'. Ganti dengan foto resmi nanti.
    'activity_images' => [1078, 250, 20, 1073, 60, 24, 201],

    /*
     * Galeri dokumentasi per aktivitas, kunci = slug di 'activity_slugs'. Berisi ID foto PLACEHOLDER (picsum.photos)
     * sampai foto dokumentasi resmi tersedia; kelak diganti tabel foto per aktivitas. Maksimal per aktivitas: config/images.php.
     */
    'activity_gallery' => [
        'sewa-guna-usaha' => [366, 367, 106, 119, 160, 1050, 1060, 1068],
        'reproduksi-media-rekaman' => [1068, 1070, 1043, 1067, 164, 1031, 366, 367],
        'perdagangan-alat-tulis-dan-gambar' => [160, 1050, 1060, 1068, 1070, 1043, 1067, 164],
        'perdagangan-barang-percetakan-dan-penerbitan' => [1031, 366, 367, 106, 119, 160, 1050, 1060],
        'portal-web-platform-digital' => [1043, 1067, 164, 1031, 366, 367, 106, 119],
        'penerbitan-buku' => [1070, 1043, 1067, 164, 1031, 366, 367, 106],
        'penasihat-investasi' => [119, 160, 1050, 1060, 1068, 1070, 1043, 1067],
    ],

    /*
     * Pengaturan tampilan halaman Layanan & Jasa. Kelak dikelola dari dashboard admin.
     *  - true : sidebar kategori tampil di kiri; klik kategori menampilkan aktivitas di dalamnya.
     *  - false: sidebar disembunyikan; semua kartu aktivitas ditampilkan sekaligus.
     */
    'activity_categories_enabled' => true,

    /*
     * Kategori usaha, urutannya mengikuti urutan tampil. Strukturnya meniru skema tabel kelak (slug, nama, aktivitas).
     * Nama kategori adalah label tampilan (bukan klasifikasi atau perizinan resmi) dan perlu dikonfirmasi perusahaan.
     * 'items' berisi nomor urut (mulai 1) pada daftar 'activities' di atas; satu aktivitas masuk satu kategori.
     */
    'activity_categories' => [
        ['slug' => 'perdagangan-besar', 'name' => 'Perdagangan Besar', 'items' => [3, 4]],
        ['slug' => 'penerbitan-media-digital', 'name' => 'Penerbitan, Media, dan Digital', 'items' => [2, 5, 6]],
        ['slug' => 'jasa-usaha', 'name' => 'Jasa Usaha', 'items' => [1, 7]],
    ],
];
