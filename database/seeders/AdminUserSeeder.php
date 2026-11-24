<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');

        // Tanpa kredensial di .env, tidak ada akun yang dibuat (tidak ada password bawaan).
        if (! $email || ! $password) {
            $this->command?->warn('ADMIN_EMAIL dan ADMIN_PASSWORD belum diisi di .env; akun admin tidak dibuat.');

            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            ['name' => config('admin.name'), 'password' => $password],
        );
    }
}
