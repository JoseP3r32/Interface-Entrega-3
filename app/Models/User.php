<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;
     // Agregamos SoftDeletes

    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ['name', 'email', 'email_verified_at', 'email_confirmed', 'actived', 'type', 'code', 'password', 'remember_token', 'deleted'];
    public $timestamps = true;
    protected $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
    // Definimos la propiedad $dates para manejar la columna deleted
    //protected $dates = ['deleted'];

    public function markEmailAsVerified()
    {
        $this->forceFill([
            'email_verified_at' => now(),
        ])->save();
    }
}
