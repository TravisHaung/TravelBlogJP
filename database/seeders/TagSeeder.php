<?php
namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            ['name' => '溫泉', 'slug' => 'onsen'],
            ['name' => '滑雪', 'slug' => 'ski'],
            ['name' => '賞楓', 'slug' => 'autumn-leaves'],
            ['name' => '美食', 'slug' => 'gourmet'],
            ['name' => '親子', 'slug' => 'family'],
            ['name' => '登山', 'slug' => 'hiking'],
            ['name' => '文化體驗', 'slug' => 'culture'],
            ['name' => '自由行', 'slug' => 'free-travel'],
            ['name' => '溫泉旅館', 'slug' => 'ryokan'],
            ['name' => '世界遺產', 'slug' => 'unesco'],
        ];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag['name'],
                'slug' => $tag['slug'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}