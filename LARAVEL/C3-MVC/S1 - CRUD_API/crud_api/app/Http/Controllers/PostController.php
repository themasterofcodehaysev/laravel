<?php


namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){
        return PostResource::collection( post::all());
    }
    public function store(){
        return post::create([
            'title'=>request('title'),
            'description'=>request('description')
        ]);
    }
    public function update(post $post){
        $success = $post->update(
            [
                'title'=>request('title'),
                'description'=>request('description')
            ]
        );
        return [
            'success'=>$success
        ];
    }
    public function destroy(post $post){
        $success = $post->delete();
        return [
            'success'=>$success
        ];
    }
}
