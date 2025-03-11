<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exames extends Model
{
    use HasFactory;
    protected $fillable = [
        "name" , 
        "type" ,
        "teachers_id" ,
        "courses_id", 
        "duree"  
    ] ;
    public function teacher(){
        return $this->belongsTo(User::class, 'teachers_id', 'id');
    }
    public function course(){
        return $this->belongsTo(Courses::class , "courses_id" , "id") ;
    }
}
