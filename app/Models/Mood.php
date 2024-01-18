<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'date', 'user_id'];

    protected $table = 'moods';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
