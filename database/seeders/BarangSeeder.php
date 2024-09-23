<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang dari kategori Sound Equipment
            ['barang_id' => 1, 'barang_kode' => 'SND001', 'barang_nama' => 'Speakers', 'harga_beli' => 4000000, 'harga_jual' => 5000000, 'kategori_id' => 1],
            ['barang_id' => 2, 'barang_kode' => 'SND002', 'barang_nama' => 'Microphones', 'harga_beli' => 800000, 'harga_jual' => 1000000, 'kategori_id' => 1],
            ['barang_id' => 3, 'barang_kode' => 'SND003', 'barang_nama' => 'Mixer', 'harga_beli' => 6000000, 'harga_jual' => 7500000, 'kategori_id' => 1],
            ['barang_id' => 4, 'barang_kode' => 'SND004', 'barang_nama' => 'Amplifier', 'harga_beli' => 5000000, 'harga_jual' => 6000000, 'kategori_id' => 1],
            ['barang_id' => 5, 'barang_kode' => 'SND005', 'barang_nama' => 'Subwoofers', 'harga_beli' => 7000000, 'harga_jual' => 8000000, 'kategori_id' => 1],

            // Barang dari kategori Lighting
            ['barang_id' => 6, 'barang_kode' => 'LGT001', 'barang_nama' => 'LED Lighting', 'harga_beli' => 3500000, 'harga_jual' => 4500000, 'kategori_id' => 2],
            ['barang_id' => 7, 'barang_kode' => 'LGT002', 'barang_nama' => 'Moving Head Light', 'harga_beli' => 7500000, 'harga_jual' => 9000000, 'kategori_id' => 2],
            ['barang_id' => 8, 'barang_kode' => 'LGT003', 'barang_nama' => 'Laser Light', 'harga_beli' => 8500000, 'harga_jual' => 10000000, 'kategori_id' => 2],
            ['barang_id' => 9, 'barang_kode' => 'LGT004', 'barang_nama' => 'Spotlight', 'harga_beli' => 2500000, 'harga_jual' => 3000000, 'kategori_id' => 2],
            ['barang_id' => 10, 'barang_kode' => 'LGT005', 'barang_nama' => 'Par LED', 'harga_beli' => 1500000, 'harga_jual' => 2000000, 'kategori_id' => 2],

            // Barang dari kategori Stage Equipment
            ['barang_id' => 11, 'barang_kode' => 'STG001', 'barang_nama' => 'Stage Platform', 'harga_beli' => 13000000, 'harga_jual' => 15000000, 'kategori_id' => 3],
            ['barang_id' => 12, 'barang_kode' => 'STG002', 'barang_nama' => 'Backdrop Frame', 'harga_beli' => 4000000, 'harga_jual' => 5000000, 'kategori_id' => 3],
            ['barang_id' => 13, 'barang_kode' => 'STG003', 'barang_nama' => 'Rigging System', 'harga_beli' => 10000000, 'harga_jual' => 12000000, 'kategori_id' => 3],
            ['barang_id' => 14, 'barang_kode' => 'STG004', 'barang_nama' => 'Truss System', 'harga_beli' => 9000000, 'harga_jual' => 10000000, 'kategori_id' => 3],
            ['barang_id' => 15, 'barang_kode' => 'STG005', 'barang_nama' => 'Stage Stairs', 'harga_beli' => 2500000, 'harga_jual' => 3000000, 'kategori_id' => 3],
        ];

        DB::table('m_barang')->insert($data);
    }
}
