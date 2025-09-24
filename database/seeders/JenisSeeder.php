<?php

namespace Database\Seeders; 

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = ['Romance', 'Action', 'Fantasy', 'Slice of life', 'Horor'];

        foreach ($jenis as $jenis) {
            Jenis::create([
                'name' => $jenis,
                'slug' => Str::slug($jenis),
            ]);
        }
    }
}