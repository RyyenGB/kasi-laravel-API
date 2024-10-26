<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Barang;
use App\Models\Transaksi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Supplier::create([
        //     "id" => 4,
        //     "nama_supplier" => "Andi",
        //     "alamat" => "Jakarta Utara",
        // ]);

        // Supplier::create([
        //     "id" => 5,
        //     "nama_supplier" => "Dimas",
        //     "alamat" => "Jakarta Selatan",
        // ]);

        // Barang::create([
        //     "id_barang" => 2,
        //     "nama_barang" => "Donat Coklat",
        //     "stok" => 10,
        //     "id_supplier" => 4,
        // ]);

        // Barang::create([
        //     "id_barang" => 3,
        //     "nama_barang" => "Donat Keju",
        //     "stok" => 5,
        //     "id_supplier" => 5,
        // ]);

        // Transaksi::create([
        //     "id_barang" => 3,
        //     "stok" => 2,
        //     "ket" => "masuk",
        //     "tanggal" => "2024-10-10",
        // ]);
    }
}
