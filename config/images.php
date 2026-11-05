<?php

/*
 * Batas galeri dokumentasi aktivitas usaha. Nilainya meniru project PT. Putra Maju Sukses
 * (config/images.php) agar perilaku admin dan halaman publik sama bila kelak dikelola dari dashboard.
 */
return [
    // Jumlah file maksimum sekali unggah (dipakai dashboard admin kelak).
    'gallery_max_per_upload' => 10,

    // Total foto maksimum per aktivitas usaha; halaman publik memotong daftar di batas ini.
    'gallery_max_per_activity' => 24,

    // Jumlah foto per halaman pada galeri di halaman detail (paginasi dengan tombol panah).
    'gallery_per_page' => 6,
];
