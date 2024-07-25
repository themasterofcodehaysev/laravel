<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Database\Eloquent\Casts\Json;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
       $post = PostResource::collection($post);
       return response(['success'=>true,'data'=>$post],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->validated());
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $id = $post->id;
        $post = Post::where('id',$id)->first();
        return response()->json(['status'=>'success','data'=>$post],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $id = $post->id;
        $post = Post::where('id',$id)->update($request->validated());
        return response()->json(['status'=>'success','message'=>'Post is updated','data'=>$post],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $id = $post->id;
        $post::destroy($id);
        return response()->json(['status'=>'success','message'=>'Post is deleted','data'=>$post],200);
    }
}
