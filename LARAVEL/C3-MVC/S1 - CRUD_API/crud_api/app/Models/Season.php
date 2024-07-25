<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['name', 'start_date', 'end_date', 'weather_conditions'];

    public static function getCurrentSeason()
    {
        $today = today();
        return self::where('start_date', '<=', $today)
                   ->where('end_date', '>=', $today)
                   ->first();
    }
}
