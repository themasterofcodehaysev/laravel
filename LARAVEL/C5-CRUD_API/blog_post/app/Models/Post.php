<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "body",
        "user_id"
    ];
    function createPost($title,$body,$user_id){
        $post = new Post();
        $post->title = $title;
        $post->body = $body;
        $post->user_id = $user_id;
        try{
            $post->save();
            return $post;
        } catch(Exception $error){
            return $error;
        }
    }
    function updatePost($title,$body){
        
        $id = $this -> id;
        $post = Post::where('id',$id)->first();
        $post->title = $title;
        $post->body = $body;
        try{
            $post->save();
            return $post;
        } catch(Exception $error){
            return $error;
        }
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
