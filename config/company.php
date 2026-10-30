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
    'city' => 'Denpasar, Bali',

    // Nama route => label. Item yang route-nya belum terdaftar tidak ditampilkan.
    'nav' => [
        'home' => 'Beranda',
        'about' => 'Tentang Kami',
        'activities' => 'Bidang Usaha',
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

    // Nama ikon (components/activity-icon) untuk tiap aktivitas, urutannya sama dengan 'activities'.
    'activity_icons' => ['rental', 'film', 'stationery', 'printing', 'web', 'book', 'advisory'],

    // ID foto PLACEHOLDER (picsum.photos) untuk tiap aktivitas, urutan sama dengan 'activities'. Ganti dengan foto resmi nanti.
    'activity_images' => [1078, 250, 20, 1073, 60, 24, 201],

    /*
     * Pengelompokan hanya untuk memudahkan penelusuran di halaman Bidang Usaha.
     * Nama kelompok adalah label tampilan (bukan klasifikasi atau perizinan resmi) dan perlu ditinjau.
     * 'items' berisi nomor urut (mulai 1) pada daftar 'activities' di atas.
     */
    'activity_groups' => [
        ['name' => 'Perdagangan Besar', 'items' => [3, 4]],
        ['name' => 'Penerbitan, Media, dan Digital', 'items' => [2, 5, 6]],
        ['name' => 'Jasa Usaha', 'items' => [1, 7]],
    ],
];
