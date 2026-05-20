<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['key' => 'hero_title', 'value' => 'Genteng Berkualitas untuk Bangunan Tahan Lama', 'type' => 'text', 'group' => 'hero', 'label' => 'Judul Hero'],
            ['key' => 'hero_subtitle', 'value' => 'Diproduksi oleh pengrajin berpengalaman dengan tanah liat pilihan dan proses alami. Kuat, indah, dan ramah lingkungan.', 'type' => 'textarea', 'group' => 'hero', 'label' => 'Deskripsi Hero'],
            ['key' => 'hero_cta_primary', 'value' => 'Lihat Produk', 'type' => 'text', 'group' => 'hero', 'label' => 'Tombol Utama Hero'],
            ['key' => 'hero_cta_secondary', 'value' => 'Hubungi Kami', 'type' => 'text', 'group' => 'hero', 'label' => 'Tombol Sekunder Hero'],
            ['key' => 'stat_families', 'value' => '150+', 'type' => 'text', 'group' => 'hero', 'label' => 'Statistik: Keluarga Pengrajin'],
            ['key' => 'stat_products', 'value' => '200+', 'type' => 'text', 'group' => 'hero', 'label' => 'Statistik: Jenis Produk'],
            ['key' => 'stat_years', 'value' => '70+', 'type' => 'text', 'group' => 'hero', 'label' => 'Statistik: Tahun Pengalaman'],
            ['key' => 'about_title', 'value' => 'Identitas yang Dianyam dengan Hati.', 'type' => 'text', 'group' => 'hero', 'label' => 'Judul Tentang Kami'],
            ['key' => 'quote_text', 'value' => 'Kekuatan sebuah genteng bukan terletak pada satu lembar tanah liat, melainkan pada bagaimana ribuan lembar tersebut saling melindungi dan menopang satu sama lain.', 'type' => 'textarea', 'group' => 'hero', 'label' => 'Kutipan Filosofi'],
            ['key' => 'contact_address', 'value' => 'Pusat Kerajinan Terpadu, Jl. Raya Dure No. 45, Kec. Seni, Kabupaten Kultur', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Alamat'],
            ['key' => 'contact_whatsapp', 'value' => '6281234567890', 'type' => 'text', 'group' => 'contact', 'label' => 'Nomor WhatsApp'],
            ['key' => 'contact_email', 'value' => 'info@desadure.id', 'type' => 'text', 'group' => 'contact', 'label' => 'Email'],
            ['key' => 'contact_hours_weekday', 'value' => 'Senin - Sabtu: 08.00 - 17.00 WIB', 'type' => 'text', 'group' => 'contact', 'label' => 'Jam Operasional (Weekday)'],
            ['key' => 'contact_hours_weekend', 'value' => 'Minggu: 09.00 - 15.00 WIB', 'type' => 'text', 'group' => 'contact', 'label' => 'Jam Operasional (Weekend)'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}