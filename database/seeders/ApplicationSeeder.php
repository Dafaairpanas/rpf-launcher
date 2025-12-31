<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $applications = [
            [
                'name' => 'RiChat',
                'image_url' => 'https://api.dicebear.com/7.x/shapes/svg?seed=richat1&backgroundColor=c084fc',
                'description' => 'Untuk komunikasi',
                'app_url' => 'https://richat.example.com',
                'theme_color' => '#E9D5FF',
            ],
            [
                'name' => 'RiChat Noaeaeoae',
                'image_url' => 'https://api.dicebear.com/7.x/shapes/svg?seed=richat2&backgroundColor=60a5fa',
                'description' => 'Untuk komunikasi',
                'app_url' => 'https://richat2.example.com',
                'theme_color' => '#DBEAFE',
            ],
            [
                'name' => 'Rajawali Perkasa Furniture',
                'image_url' => 'https://api.dicebear.com/7.x/shapes/svg?seed=rpf&backgroundColor=4ade80',
                'description' => 'Untuk komunikasi',
                'app_url' => 'https://rpf.example.com',
                'theme_color' => '#DCFCE7',
            ],
            [
                'name' => 'RiChat',
                'image_url' => 'https://api.dicebear.com/7.x/shapes/svg?seed=richat3&backgroundColor=e5e7eb',
                'description' => 'Untuk komunikasi',
                'app_url' => 'https://richat3.example.com',
                'theme_color' => '#F9FAFB',
            ],
        ];

        foreach ($applications as $app) {
            Application::create($app);
        }
    }
}
