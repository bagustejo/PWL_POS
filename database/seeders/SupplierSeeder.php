<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'SoundPro',
                'supplier_alamat' => 'Jl. Raya A. Yani No. 25, Malang',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'Lighting Indonesia',
                'supplier_alamat' => 'Jl. Soekarno Hatta No. 12, Surabaya',
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'Stage Builder Corp.',
                'supplier_alamat' => 'Jl. Veteran No. 8, Jakarta',
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
