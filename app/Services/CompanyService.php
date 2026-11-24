<?php

namespace App\Services;

/**
 * Data publik perusahaan. Sumbernya masih config('company'); view tidak boleh membaca config langsung,
 * sehingga kelak sumber data bisa dipindah ke database tanpa mengubah view.
 */
class CompanyService
{
    public function profile(): array
    {
        $company = config('company');

        return $company + [
            'default_description' => $company['name'].', '.$company['city'].'. Profil perusahaan, bidang usaha, dan informasi kontak.',
        ];
    }

    /** Visi, misi, dan nilai perusahaan; bagian yang kosong dibuang agar seksinya tidak tampil. */
    public function about(): array
    {
        return array_filter(config('company.about', []));
    }
}
