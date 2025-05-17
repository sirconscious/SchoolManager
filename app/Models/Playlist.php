<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "description",
        "cours_id",
        "video_path" ,
        "level" , 
        "duration"
    ];
    public function cours()
    {
        return $this->belongsTo(Courses::class);
    }
}
