<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin Dure',
            'email' => 'admin@desadure.id',
            'password' => bcrypt('password'),
        ]);

        $products = [
            [
                'name' => 'Vas Dure Klasik',
                'price' => 'Rp 450.000',
                'description' => 'Vas bunga dengan teknik anyaman silang yang elegan. Menggunakan bahan bambu pilihan dengan finishing ramah lingkungan.',
                'image' => 'https://images.unsplash.com/photo-1610701596007-11502861dcfa?q=80&w=800&auto=format&fit=crop',
                'category' => 'Dekorasi',
                'wa' => '6281234567890',
            ],
            [
                'name' => 'Tikar Meditasi Dure',
                'price' => 'Rp 320.000',
                'description' => 'Tikar meditasi sejuk dan awet. Menghadirkan kenyamanan alami untuk rutinitas harian Anda.',
                'image' => 'https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?q=80&w=800&auto=format&fit=crop',
                'category' => 'Lifestyle',
                'wa' => '6281234567890',
            ],
            [
                'name' => 'Lentera Malam Dure',
                'price' => 'Rp 850.000',
                'description' => 'Lampu hias dengan efek bayangan artistik. Memberikan nuansa etnik yang mewah pada kamar tidur atau ruang tamu.',
                'image' => 'https://images.unsplash.com/photo-1513519245088-0e12902e5a38?q=80&w=800&auto=format&fit=crop',
                'category' => 'Penerangan',
                'wa' => '6281234567890',
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        $craftsmen = [
            [
                'name' => 'Bapak Karsa',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop',
                'description' => 'Ahli Anyaman Bambu dengan pengalaman lebih dari 20 tahun.',
                'address' => 'Desa Dure, Jawa Tengah',
                'latitude' => -7.8000000,
                'longitude' => 110.3000000,
                'capacity' => 10,
                'price' => 'Rp 500.000',
                'wa' => '6281234567890',
            ],
            [
                'name' => 'Ibu Murni',
                'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=800&auto=format&fit=crop',
                'description' => 'Kurator Tekstil Alami yang berpairot pada motif tradisional.',
                'address' => 'Desa Dure, Jawa Tengah',
                'latitude' => -7.8050000,
                'longitude' => 110.3050000,
                'capacity' => 8,
                'price' => 'Rp 400.000',
                'wa' => '6281234567890',
            ],
        ];

        foreach ($craftsmen as $craftsman) {
            \App\Models\Craftsman::create($craftsman);
        }

        $galleries = [
            [
                'title' => 'Pemilihan Bahan Baku',
                'category' => 'Proses',
                'url' => 'https://images.unsplash.com/photo-1606760227091-3dd870d97f1d?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'title' => 'Detail Anyaman Halus',
                'category' => 'Produk',
                'url' => 'https://images.unsplash.com/photo-1452860606245-08befc0ff44b?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'title' => 'Workshop Bersama',
                'category' => 'Komunitas',
                'url' => 'https://images.unsplash.com/photo-1523726491678-bf852e717f6a?q=80&w=800&auto=format&fit=crop',
            ],
            [
                'title' => 'Pewarnaan Organik',
                'category' => 'Teknik',
                'url' => 'https://images.unsplash.com/photo-1516962215378-7fa2e137ae93?q=80&w=800&auto=format&fit=crop',
            ],
        ];

        foreach ($galleries as $gallery) {
            \App\Models\Gallery::create($gallery);
        }

        $this->call(SettingSeeder::class);
    }
}
