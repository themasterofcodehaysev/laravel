<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::all();
        // return response()->json(["data" => $user, "message" => "Users request has been successful"], 200);
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()], 400);
        };
        $user = new User();
        try {
            $user = User::create($request->all());
            return response()->json(["message" => "User create has been successful", "data" => $user]);
        } catch (Exception $error) {
            return response()->json([ "message" => "User create is unsuccessful", "error" => $error], 400);
        };
    }

    public function show(User $user)
    {
        $id = $user->id;
        $user = UserResource::collection(User::where('id', $id)->first());
        return response()->json([ "message" => "Request has been successful","data"=>$user], 200);
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        try {
            $user->updateUser($name, $email, $password);
            return response()->json(["message" => "User update has been successful", "data" => $user], 200);
        } catch (Exception $error) {
            return response()->json([ "message" => "User update has been unsuccessful", "error" => $error], 400);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $id = $user->id;
        try {
            User::destroy($id);
            return response()->json([ "message" => "User is deleted","data" => $user], 200);
        } catch (Exception $error) {
            return response()->json([ "message" => "User delete is unsuccessful", "error" => $error], 400);
        }
    }
    
}
