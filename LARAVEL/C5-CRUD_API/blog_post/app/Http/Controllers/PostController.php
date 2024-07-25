<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()], 400);
        };
        $title = $request->title;
        $body = $request->body;
        $user_id = $request->user_id;
        $post = new Post();
        try {
            $post->createPost($title, $body,$user_id);
            return response()->json(["message" => "Create has been successful","data" => $post ], 200);
        } catch (Exception $error) {
            return response()->json(["message" => "Create has been unsuccessful", "error" => $error], 400);
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $id = $post->id;
        $post = Post::where('id', $id)->first();
        return response()->json(["message" => "Request has been successful","data" => $post ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $title = $request->title;
        $body = $request->body;
        try {
            $post->updatePost($title, $body);
            return response()->json(["message" => "Update is successful","data" => $post ], 200);
        } catch (Exception $error) {
            return response()->json(["message" => "Update is unsuccessful", "error" => $error], 400);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $id = $post->id;
        try {
            Post::destroy($id);
            return response()->json(["message" => "Post is deleted","data" => $post ], 200);
        } catch (Exception $error) {
            return response()->json(["message" => "Deleted is unsuccessful", "error" => $error], 400);
        }
    }
}
