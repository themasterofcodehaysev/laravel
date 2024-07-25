<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ["title"=>"book 1","description"=>"description 1"],
            ["title"=>"book 2","description"=>"description 2"],
            ["title"=>"book 3","description"=>"description 3"]
        ];
        foreach ($books as $book) {
            \App\Models\Book::create($book);
        }
    }
}
