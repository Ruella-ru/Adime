<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Jenis; // Impor model Jenis
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; // Tetap dibutuhkan untuk Str::slug()

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user dengan role 'admin' dan 'author'
        $adminUser = User::where('role', 'admin')->first();
        $authorUser = User::where('role', 'author')->first();
        // Ambil semua data 'Jenis'
        $jenis = Jenis::all();

        // Hanya jalankan seeder jika user admin/author dan jenis ditemukan
        if ($adminUser && $authorUser && $jenis->count() > 0) {
            // Loop untuk membuat 10 produk dummy
            for ($i = 1; $i <= 10; $i++) {
                // Pilih user secara bergantian antara admin dan author
                $user = ($i % 2 == 0) ? $adminUser : $authorUser;
                // Pilih satu 'jenis' secara acak dari yang tersedia
                $singleJenis = $jenis->random();

                // Buat judul produk yang dinamis
                $title = "Sample Products " . $i . " - " . $singleJenis->nama_jenis;

                // Generate harga acak (antara 1.000,00 hingga 10.000,00) dengan 2 angka di belakang koma
                $randomPrice = rand(100000, 1000000) / 100;
                // Generate diskon acak (antara 0% hingga 50%)
                $randomDiscount = rand(0, 50);

                // Buat record produk baru di database
                Product::create([
                    'user_id' => $user->id,
                    'jenis_id' => $singleJenis->id, // Menggunakan jenis_id dari 'jenis' yang dipilih
                    'title' => $title,
                    'meta_desc' => 'A short description for ' . $title,
                    'slug' => Str::slug($title),
                    'description' => 'This is the detailed description for ' . $title . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    'image' => null, // Anda bisa menambahkan logika untuk gambar dummy jika diperlukan
                    'status' => true, // Default produk diterbitkan
                    'price' => '100000',
                    'discount' => '0', // Contoh: Sebagian produk memiliki diskon, sebagian null
                    'stock' => '10', // Stok produk antara 1 hingga 100
                    'sku' => null, // <-- PERUBAHAN DI SINI: SKU unik, hanya menggunakan nomor loop
                ]);
            }
        } else {
            // Pesan informasi jika seeder tidak dapat berjalan karena data dasar tidak ditemukan
            $this->command->info('Skipping ProductSeeder: Admin/Author users or Jenis not found. Please run UserSeeder and JenisSeeder first.');
        }
    }
}