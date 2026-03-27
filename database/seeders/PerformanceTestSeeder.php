<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class PerformanceTestSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data to avoid confusion (Optional)
        // Application::truncate(); 

        $tags = Tag::all();
        $tagCount = $tags->count();

        echo "Generating 500 applications for performance testing...\n";

        for ($i = 1; $i <= 500; $i++) {
            $app = Application::create([
                'name' => "App Testing $i",
                'description' => "Deskripsi otomatis untuk aplikasi testing nomor ke-$i. Digunakan untuk uji performa launcher RPF.",
                'app_url' => "https://app-$i.example.com",
                'theme_color' => $this->getRandomColor(),
                'sort_order' => $i + 10, // Start after the real apps
                'image_url' => "https://api.dicebear.com/7.x/identicon/svg?seed=app-$i&backgroundColor=ffffff",
            ]);

            // Randomly attach 1-2 tags
            if ($tagCount > 0) {
                $randomTags = $tags->random(rand(1, 2))->pluck('id')->toArray();
                $app->tags()->sync($randomTags);
            }

            if ($i % 50 === 0) {
                echo "Progress: $i / 500...\n";
            }
        }

        Cache::flush();
        echo "Done! 500 applications have been created.\n";
        echo "Run 'php artisan serve' to test the performance.\n";
    }

    private function getRandomColor()
    {
        $colors = ['#f8fafc', '#f1f5f9', '#e2e8f0', '#fef2f2', '#fff7ed', '#f0fdf4', '#eff6ff', '#faf5ff', '#fff1f2'];
        return $colors[array_rand($colors)];
    }
}
