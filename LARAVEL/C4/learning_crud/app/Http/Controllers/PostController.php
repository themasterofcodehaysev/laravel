<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Post = Post::all();
        return response()->json(['data'=>$Post,"message"=>"Request is successfully"],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Post = new Post();
        $Post->title = $request->title;
        $Post->body = $request->body;

        try{
            $Post->save();
            return response()->json(['data'=>$Post,"message"=>"Post create is successfully"],200);
        }catch(Exception $error){
            return response()->json(["message"=>"Post create is unsuccessfully","error"=>$error],400);
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
        $id = $post -> id;
        $title = $request->title;
        $body = $request->body;

        $post = Post::where("id",$id)->first();
        $post -> title = $title;
        $post -> body = $body;
        try{
            $post->save();
            return response()->json(['data'=>$post,"message"=>"The update is successfully"],200);
        }catch(Exception $error){
            return response()->json(["message"=>"The update is unsuccessfully","Error"=>$error],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $id = $post -> id;
        $pst = Post::destroy($id);
        try{
            $post->save();
            return response()->json(['data'=>$post,"message"=>"Delleted is successfully"],200);
        }catch(Exception $error){
            return response()->json(["message"=>"Delleted is unsuccessfully","Error"=>$error],400);
        }
    }
}
