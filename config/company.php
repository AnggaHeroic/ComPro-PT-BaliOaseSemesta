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

    // Visi, misi, dan nilai: PLACEHOLDER lorem ipsum. Ganti dengan teks resmi perusahaan; seksi disembunyikan bila datanya kosong.
    'about' => [
        'profile' => [
            'label' => 'Profil Perusahaan',
            'title' => 'Lorem ipsum dolor',
            'title_accent' => 'sit amet consectetur',
            'paragraphs' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.',
                'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.',
                'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa quae ab illo inventore.',
            ],
            // ID foto Picsum sebagai placeholder; ganti dengan foto resmi perusahaan.
            'image' => 1031,
            'image_caption' => 'Lorem ipsum dolor sit amet',
            'facts' => [
                ['title' => 'Lorem ipsum', 'text' => 'Dolor sit amet'],
                ['title' => 'Consectetur', 'text' => 'Adipiscing elit'],
                ['title' => 'Sed do eiusmod', 'text' => 'Tempor incididunt'],
                ['title' => 'Ut labore', 'text' => 'Et dolore magna'],
            ],
        ],
        'vision' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'missions' => [
            ['title' => 'Lorem ipsum dolor', 'text' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'],
            ['title' => 'Consectetur adipiscing', 'text' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'],
            ['title' => 'Sed do eiusmod', 'text' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'],
            ['title' => 'Tempor incididunt', 'text' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.'],
        ],
        'values' => [
            ['title' => 'Lorem', 'text' => 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.'],
            ['title' => 'Ipsum', 'text' => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet consectetur.'],
            ['title' => 'Dolor', 'text' => 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit.'],
            ['title' => 'Amet', 'text' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis.'],
        ],
    ],

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
