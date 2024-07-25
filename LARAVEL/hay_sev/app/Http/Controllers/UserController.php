<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = User::list();
        $users = UserResource::collection($users);
        return response()->json(['success' => true, 'data' => $users], 200);
    }
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
    // GET /users/{user_id}/borrowed-books?status=active

public function getUserBorrowedBooks(Request $request, $user_id)
{
    $user = User::find($user_id);
    if (!$user) {
        return response()->json(["message" => "User not found"], 404);
    }

    $status = $request->input('status');
    $borrowedBooks = $user->borrowRecords()
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->with('book')
        ->get()
        ->pluck('book');

    return response()->json(["message" => "User borrowed books", "data" => $borrowedBooks], 200);
}
}
