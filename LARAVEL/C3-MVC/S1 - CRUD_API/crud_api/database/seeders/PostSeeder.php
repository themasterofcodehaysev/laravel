<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $posts = [
            ["title"=>"post 1","description"=>"description 1"],
            ["title"=>"post 2","description"=>"description 2"],
            ["title"=>"post 3","description"=>"description 3"]
        ];
        foreach ($posts as $post) {
            \App\Models\post::create($post);
        }
    }
}
