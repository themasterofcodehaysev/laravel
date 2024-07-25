<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ["title"=>"users 1","description"=>"description 1"],
            ["title"=>"users 2","description"=>"description 2"],
            ["title"=>"users 3","description"=>"description 3"]
        ];
        foreach ($users as $book) {
            \App\Models\Book::create($users);
        }
    }
}
