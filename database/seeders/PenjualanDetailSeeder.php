<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $barang_id = rand(1, 15);
                $data[] = [
                    'penjualan_id' => $i,
                    'barang_id' => $barang_id,
                    'jumlah' => rand(1, 5),
                    'harga' => DB::table('m_barang')->where('barang_id', $barang_id)->value('harga'),
                ];
            }
         }
        DB::table('t_penjualan_detail')->insert($data);
    }
}
