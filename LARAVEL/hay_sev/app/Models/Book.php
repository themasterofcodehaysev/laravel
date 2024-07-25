<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'genre',
        'published_year',
    ];
    public static function list()
    {
        $data = self::all();
        return $data;
    }
    function updateBook($title,$author,$genre,$published_year){
        
        $id = $this->id;
        $book = User::where('id', $id)->first();
        $book->title = $title;
        $book->author = $author;
        $book->genre = $genre;
        $book->published_year = $published_year;
        try {
            $book->save();
            return $book;
        } catch (Exception $error) {
            return $error;
        };
    
    }
}
