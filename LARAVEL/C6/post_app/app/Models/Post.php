<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body'
    ];
    public function createPost($title,$body){
        $post = new Post();
        $post->title = $title;
        $post->body = $body;
        try{
            $post->save();
            return $post;
        }catch(Exception $erorr){
            return $erorr->getMessage();
        }
    }
    public function updatePost($title,$body){
        $id = $this -> id;
        $post = Post::where('id',$id)->first();
        $post->title = $title;
        $post->body = $body;
        try{
            $this->save();
            return $this;
        }catch(Exception $erorr){
            return $erorr->getMessage();
        }
    }
}
