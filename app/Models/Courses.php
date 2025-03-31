<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "description" ,
        "filename"
    ] ; 
    public function coef(){
        return $this->hasOne(Coef::class , "courses_id" , "id") ;
    }
}
