<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Produksi', 'color' => '#ef4444'],
            ['name' => 'Marketing', 'color' => '#3b82f6'],
            ['name' => 'HRD', 'color' => '#10b981'],
            ['name' => 'Finance', 'color' => '#f59e0b'],
            ['name' => 'Umum', 'color' => '#6366f1'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['name' => $tag['name']], $tag);
        }
    }
}
