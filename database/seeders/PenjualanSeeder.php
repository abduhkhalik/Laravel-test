<?php

namespace Database\Seeders;

use App\Models\Penjualan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Penjualan::create([
            'produk' => 'Laptop',
            'jumlah' => 2,
            'harga' => 15000000,
            'total' => 30000000
        ]);
    
        Penjualan::create([
            'produk' => 'Smartphone',
            'jumlah' => 5,
            'harga' => 5000000,
            'total' => 25000000
        ]);
    }
}
