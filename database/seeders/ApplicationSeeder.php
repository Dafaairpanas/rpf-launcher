<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $prodTag = Tag::where('name', 'Produksi')->first();
        $mktTag = Tag::where('name', 'Marketing')->first();
        $hrdTag = Tag::where('name', 'HRD')->first();
        $umumTag = Tag::where('name', 'Umum')->first();

        $apps = [
            [
                'name' => 'Main Dashboard',
                'description' => 'Aplikasi utama untuk monitoring produksi',
                'app_url' => 'https://rpf.example.com',
                'theme_color' => '#DCFCE7',
                'sort_order' => 1,
                'tags' => [$prodTag?->id, $umumTag?->id]
            ],
            [
                'name' => 'RiChat Internal',
                'description' => 'Sistem komunikasi internal karyawan',
                'app_url' => 'https://richat.example.com',
                'theme_color' => '#E9D5FF',
                'sort_order' => 2,
                'tags' => [$umumTag?->id]
            ],
            [
                'name' => 'Absensi Online',
                'description' => 'Sistem absensi dan payroll karyawan',
                'app_url' => 'https://absensi.example.com',
                'theme_color' => '#DBEAFE',
                'sort_order' => 3,
                'tags' => [$hrdTag?->id]
            ],
            [
                'name' => 'CRM Marketing',
                'description' => 'Pengelolaan data customer dan sales',
                'app_url' => 'https://crm.example.com',
                'theme_color' => '#FEF3C7',
                'sort_order' => 4,
                'tags' => [$mktTag?->id]
            ],
        ];

        foreach ($apps as $appData) {
            $tags = $appData['tags'];
            unset($appData['tags']);
            
            $app = Application::firstOrCreate(['name' => $appData['name']], $appData);
            $app->tags()->sync(array_filter($tags));
        }
    }
}
