<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Exception;

class BorrowRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'user_id',
        'borrow_date',
        'return_date',
    ];
    public static function list()
    {
        $data = self::all();
        return $data;
    }
    function updateBorrowRecord($book_id,$user_id,$borrow_date,$return_date){
        
        $id = $this->id;
        $borrowRecord = User::where('id', $id)->first();
        $borrowRecord->book_id = $book_id;
        $borrowRecord->user_id = $user_id;
        $borrowRecord->borrow_date = $borrow_date;
        $borrowRecord->return_date = $return_date;
        try {
            $borrowRecord->save();
            return $borrowRecord;
        } catch (Exception $error) {
            return $error;
        };
    
    }


    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function book():BelongsTo{
        return $this->belongsTo(Book::class);
    }
}
