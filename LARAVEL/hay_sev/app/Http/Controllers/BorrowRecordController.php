<?php

namespace App\Http\Controllers;

use App\Models\BorrowRecord;
use Illuminate\Http\Request;
use App\Http\Resources\BorrowRecordResource;
use Illuminate\Support\Facades\Validator;
use Exception;

class BorrowRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowRecord = BorrowRecord::list();
        $borrowRecord = BorrowRecordResource::collection($borrowRecord);
        return response()->json(['success' => true, 'data' => $borrowRecord], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|max:255',
            'user_id' => 'required|max:255',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()], 400);
        }

        $bookId = $request->book_id;
        $userId = $request->user_id;
        $borrowDate = $request->borrow_date;
        $returnDate = $request->return_date;

        try {
            $borrowRecord = BorrowRecord::create([
                'book_id' => $bookId,
                'user_id' => $userId,
                'borrow_date' => $borrowDate,
                'return_date' => $returnDate,
            ]);

            return response()->json(["message" => "Create BorrowRecord has been successful", "data" => $borrowRecord], 201);
        } catch (Exception $error) {
            return response()->json(["message" => "Create BorrowRecord is unsuccessful", "error" => $error->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowRecord $borrowRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BorrowRecord $borrowRecord)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|max:255',
            'user_id' => 'required|max:255',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date',
        ]);
    
        try {
            $borrowRecord->update($validatedData);
            return response()->json(["message" => "BorrowRecord update has been successful", "data" => $borrowRecord], 200);
        } catch (Exception $error) {
            return response()->json(["message" => "BorrowRecord update is unsuccessful", "error" => $error->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowRecord $borrowRecord)
    {

        $id = $borrowRecord->id;
        try {
            BorrowRecord::destroy($id);
            return response()->json(["message" => "BorrowRecord is deleted", "data" => $borrowRecord], 200);
        } catch (Exception $error) {
            return response()->json(["message" => "Borrow delete is unsuccessful", "error" => $error], 400);
        }
    }
 
}
