<?php

/*
 * Akun admin awal untuk seeder. Nilainya diisi lewat .env (jangan ditulis di sini atau di-commit).
 */
return [
    'name' => env('ADMIN_NAME', 'Administrator'),
    'email' => env('ADMIN_EMAIL'),
    'password' => env('ADMIN_PASSWORD'),
];
