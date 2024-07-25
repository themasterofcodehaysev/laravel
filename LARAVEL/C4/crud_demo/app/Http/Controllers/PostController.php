<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Post = Post::all();
        return response()->json(["data"=>$Post,"message"=>"Post request list is successfully"],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Post = new Post();
        $title = $request->title;
        $description = $request->description;

        $Post->title = $title;
        $Post->description = $description;
        try{

            $Post->save();
            return response()->json(["data"=>$Post,"message"=>"Post create is successfully"],200);
        }catch(Exception $error){
            return response()->json(["message"=>$error->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $id = $post->id;
        $title = $request->title;
        $description = $request->description;

        $post = Post::where('id',$id)->first();
        $post->title = $title;
        $post->description = $description;
        try{

            $post->save();
            return response()->json(["data"=>$post,"message"=>"Update is successfully"],200);
        }catch(Exception $error){
            return response()->json(["message"=>$error->getMessage()],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $id = $post->id;
        $post = Post::where('id',$id)->first();
        try{
            $post->delete();
            return response()->json(["data"=>$post,"message"=>"Delete is successfully"],200);
        }catch(Exception $error){
            return response()->json(["message"=>$error->getMessage()],500);
        }
    }
}
