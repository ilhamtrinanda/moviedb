<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil salah satu kategori (misalnya kategori pertama)
        $category = Category::first();

        if (!$category) {
            // Jika belum ada kategori, buat dulu contoh kategori
            $category = Category::create([
                'category_name' => 'Action',
                'description' => 'Action movie',
            ]);
        }

        DB::table('movies')->insert([
            [
                'title' => 'Contoh Film Action',
                'slug' => Str::slug('Contoh Film Action'),
                'synopsis' => 'Ini adalah sinopsis contoh film action.',
                'category_id' => $category->id,  
                'year' => 2024,
                'actors' => 'Actor 1, Actor 2',
                'cover_image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
