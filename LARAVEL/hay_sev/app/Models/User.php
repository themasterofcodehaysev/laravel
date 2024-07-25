<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Exception;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public static function list()
    {
        $data = self::all();
        return $data;
    }
  
    function updateUser($name,$email,$password){
        
        $id = $this->id;
        $user = User::where('id', $id)->first();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        try {
            $user->save();
            return $user;
        } catch (Exception $error) {
            return $error;
        };
    
    }
    public function user():HasMany{
        return $this->hasMany(BorrowRecord::class);
    }

}
