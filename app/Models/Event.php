<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = ['name', 'description', 'deleted','date', 'image', 'user_id'];
    public $timestamps = true;
    protected $table = 'events';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}