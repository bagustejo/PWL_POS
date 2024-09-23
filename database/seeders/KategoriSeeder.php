<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'SND', 'kategori_nama' => 'Sound System'],
            ['kategori_id' => 2, 'kategori_kode' => 'LGT', 'kategori_nama' => 'Lighting'],
            ['kategori_id' => 3, 'kategori_kode' => 'STG', 'kategori_nama' => 'Stage'],
            ['kategori_id' => 4, 'kategori_kode' => 'MLT', 'kategori_nama' => 'Multimedia'],
            ['kategori_id' => 5, 'kategori_kode' => 'DEC', 'kategori_nama' => 'Decoration'],
        ];

        DB::table('m_kategori')->insert($data);
    }
}
