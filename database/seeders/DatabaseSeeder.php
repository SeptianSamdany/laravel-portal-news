<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Categories
        $categories = collect([
            'Teknologi', 'Bisnis', 'Kesehatan', 'Travel', 'Kuliner', 'Pendidikan', 'Olahraga'
        ])->map(function ($name) {
            return Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        });

        // Articles
        foreach (range(1, 20) as $i) {
            Article::create([
                'title' => "Contoh Artikel $i",
                'slug' => "contoh-artikel-$i",
                'excerpt' => "Ini adalah ringkasan artikel ke-$i.",
                'content' => "Ini adalah isi lengkap artikel ke-$i. Lorem ipsum dolor sit amet...",
                'category_id' => $categories->random()->id,
                'author_id' => 1,
                'status' => 'published',
                'published_at' => now()->subDays(rand(0, 30)),
                'views_count' => rand(10, 500),
                'is_editor_pick' => $i <= 3, // 3 artikel pertama jadi editor pick
                'thumbnail' => 'thumbnails/default.jpg', // pastikan file ada atau ganti sesuai kebutuhan
            ]);
        }
    }
}